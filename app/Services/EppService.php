<?php

namespace App\Services;

use DOMDocument;
use DOMXPath;
use Exception;
use Net_EPP_Client;

class EppService
{
    protected array $params;

    public function __construct()
    {
        // If possible, use Composer autoloading for the EPP library.
        // Otherwise, include the files once here:
        require_once base_path('app/Services/Epp/client/Net/EPP/Client.php');
        require_once base_path('app/Services/Epp/client/Net/EPP/Protocol.php');

        $this->params = [
            'Username' => config('epp.username'),
            'Password' => config('epp.password'),
            'Server' => config('epp.server'),
            'Port' => config('epp.port'),
            'Certificate' => config('epp.certificate'),
            'SSL' => config('epp.ssl', 'on'),
        ];
    }

    /**
     * Checks the availability of a domain across multiple TLDs.
     *
     * @throws Exception
     */
    public function checkDomainAvailability(string $domainText, string $extension): array
    {
        $client = $this->getEppConnection();
        $domainString = $this->buildDomainString($domainText, $extension);
        $response = $this->performDomainCheck($client, $domainString);

        return $this->processDomainCheckResponse($response);
    }

    /**
     * Establish the EPP connection and perform login.
     *
     * @throws Exception
     */
    protected function getEppConnection(): Net_EPP_Client
    {
        $useSSL = ($this->params['SSL'] === 'on');
        $context = null;

        if ($useSSL && ! empty($this->params['Certificate'])) {
            if (! file_exists($this->params['Certificate'])) {
                throw new Exception('Certificate file does not exist.');
            }

            $context = stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'local_cert' => $this->params['Certificate'],
                ],
            ]);
        }

        $client = new Net_EPP_Client;
        $client->connect(
            $this->params['Server'],
            $this->params['Port'],
            60,
            $useSSL,
            $context
        );

        // Perform login
        $loginXml = $this->buildLoginXml();
        $response = $client->request($loginXml);
        $this->logEppTransaction('login', $loginXml, $response);

        return $client;
    }

    /**
     * Builds the XML fragment containing the domain names to check.
     */
    protected function buildDomainString(string $domainText, string $extension): string
    {
        // Build the primary domain name.
        $domainString = "<domain:name>{$domainText}.{$extension}</domain:name>";

        // Add additional TLDs (adjust these as needed).
        $additionalTlds = ['co.rw', 'org.rw'];
        foreach ($additionalTlds as $tld) {
            if ($tld !== $extension) {
                $domainString .= "<domain:name>{$domainText}.{$tld}</domain:name>";
            }
        }

        return $domainString;
    }

    /**
     * Sends the domain check XML request.
     *
     * @throws Exception
     */
    protected function performDomainCheck(Net_EPP_Client $client, string $domainString): string
    {
        // Generate a unique transaction id.
        $clTRID = uniqid();

        $xml = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
    <command>
        <check>
            <domain:check xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
                {$domainString}
            </domain:check>
        </check>
        <clTRID>{$clTRID}</clTRID>
    </command>
</epp>
XML;

        $response = $client->request($xml);
        $this->logEppTransaction('domain-check', $xml, $response);

        return $response;
    }

    /**
     * Processes the XML response from the domain check.
     *
     * @throws Exception
     */
    protected function processDomainCheckResponse(string $response): array
    {
        $xmlResponse = new DOMDocument('1.0');
        $xmlResponse->loadXML($response);

        $resultElement = $xmlResponse->getElementsByTagName('result')->item(0);
        if (! $resultElement) {
            throw new Exception('Invalid response: No result element found.');
        }

        $responseCode = $resultElement->getAttribute('code');
        $msgElement = $xmlResponse->getElementsByTagName('msg')->item(0);
        $message = $msgElement ? $msgElement->nodeValue : 'Unknown error';

        if ($responseCode !== '1000') {
            throw new Exception("EPP Error: {$message}");
        }

        $domainStatuses = [];
        $domXPath = new DOMXPath($xmlResponse);
        $domXPath->registerNamespace('domain', 'urn:ietf:params:xml:ns:domain-1.0');
        $domainElements = $domXPath->query('//domain:chkData/domain:cd/domain:name');

        foreach ($domainElements as $index => $element) {
            $domainStatuses[] = [
                'domain_name' => $element->textContent,
                'is_available' => $element->getAttribute('avail') === '1',
                'is_primary' => $index === 0,
                'selling_cost' => 'Not yet implemented',
            ];
        }

        return $domainStatuses;
    }

    /**
     * Builds the XML used for the login request.
     */
    protected function buildLoginXml(): string
    {
        return <<<XML
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
    <command>
        <login>
            <clID>{$this->params['Username']}</clID>
            <pw>{$this->params['Password']}</pw>
            <options>
                <version>1.0</version>
                <lang>en</lang>
            </options>
            <svcs>
                <objURI>urn:ietf:params:xml:ns:domain-1.0</objURI>
                <objURI>urn:ietf:params:xml:ns:contact-1.0</objURI>
            </svcs>
        </login>
    </command>
</epp>
XML;
    }

    /**
     * Logs both the request and response of EPP transactions.
     */
    protected function logEppTransaction(string $type, string $request, string $response): void
    {
        $logPath = storage_path('logs/epp');
        if (! file_exists($logPath)) {
            mkdir($logPath, 0755, true);
        }
        $timestamp = now()->format('Y-m-d_H-i-s');
        file_put_contents("{$logPath}/{$type}-request-{$timestamp}.xml", $request);
        file_put_contents("{$logPath}/{$type}-response-{$timestamp}.xml", $response);
    }
}
