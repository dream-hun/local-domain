<?php

namespace App\Services\Epp;

use DOMDocument;
use DOMXPath;
use Exception;
use Net_EPP_Client;

class EppService
{
    private Net_EPP_Client $client;

    private array $config;

    private string $debugPath;

    /**
     * @throws Exception
     */
    public function __construct(?array $config = null)
    {
        $this->debugPath = dirname(__FILE__).'/debug/';

        // Default configuration
        $defaultConfig = [
            'username' => config('epp.username', 'bluhub_rwf'),
            'password' => config('epp.password', 'CVQTsh8R64CCdt6G'),
            'server' => config('epp.server', 'registry.ricta.org.rw'),
            'port' => config('epp.port', '700'),
            'certificate' => config('epp.certificate', dirname(__FILE__).'/certificates/test.pem'),
            'ssl' => config('epp.ssl', true),
        ];

        $this->config = $config ?? $defaultConfig;

        // Create certificates directory if it doesn't exist
        $certDir = dirname($this->config['certificate']);
        if (! is_dir($certDir)) {
            mkdir($certDir, 0755, true);
        }

        // If certificate doesn't exist, try to copy from the original location
        if (! file_exists($this->config['certificate'])) {
            $originalCert = dirname(__FILE__).'/test.pem';
            if (file_exists($originalCert)) {
                copy($originalCert, $this->config['certificate']);
            }
        }

        $this->connect();
    }

    /**
     * Connect to the EPP server and perform login
     *
     * @throws Exception
     */
    private function connect(): void
    {
        require_once 'Net/EPP/Client.php';
        require_once 'Net/EPP/Protocol.php';

        try {
            $context = null;
            if ($this->config['ssl']) {
                if (! file_exists($this->config['certificate'])) {
                    throw new Exception('Certificate file does not exist.');
                }

                $context = stream_context_create([
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'local_cert' => $this->config['certificate'],
                    ],
                ]);
            }

            $this->client = new Net_EPP_Client;
            $this->client->connect(
                $this->config['server'],
                $this->config['port'],
                60,
                $this->config['ssl'],
                $context
            );

            $this->login();
        } catch (Exception $e) {
            throw new Exception('EPP Connection failed: '.$e->getMessage());
        }
    }

    /**
     * Perform EPP login
     *
     * @throws Exception
     */
    private function login(): void
    {
        $xml = sprintf(
            '<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
                <command>
                    <login>
                        <clID>%s</clID>
                        <pw>%s</pw>
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
            </epp>',
            $this->config['username'],
            $this->config['password']
        );

        $response = $this->client->request($xml);
        $this->logRequest('login-request.xml', $xml);
        $this->logResponse('login-response.xml', $response);
    }

    /**
     * Check domain availability
     *
     * @throws Exception
     */
    public function checkDomain(string $domainName, string $extension, array $additionalTlds = []): array
    {
        $domainString = "<domain:name>{$domainName}.{$extension}</domain:name>";

        foreach ($additionalTlds as $tld) {
            if ($tld !== $extension) {
                $domainString .= "<domain:name>{$domainName}{$tld}</domain:name>";
            }
        }

        $xml = sprintf(
            '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
            <epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
                <command>
                    <check>
                        <domain:check xmlns:domain="urn:ietf:params:xml:ns:domain-1.0">
                            %s
                        </domain:check>
                    </check>
                    <clTRID>%s</clTRID>
                </command>
            </epp>',
            $domainString,
            uniqid(mt_rand())
        );

        $response = $this->client->request($xml);
        $this->logRequest('domain-check-request.xml', $xml);
        $this->logResponse('domain-check-response.xml', $response);

        return $this->processDomainCheckResponse($response);
    }

    /**
     * Process domain check response
     */
    private function processDomainCheckResponse(string $response): array
    {
        $xmlResponse = new DOMDocument('1.0');
        $xmlResponse->loadXML($response);

        $responseCode = $xmlResponse->getElementsByTagName('result')->item(0)->getAttribute('code');
        $message = $xmlResponse->getElementsByTagName('msg')->item(0)->nodeValue;

        if ($responseCode !== '1000') {
            return [
                'success' => false,
                'message' => $message,
                'domains' => [],
            ];
        }

        $domXPath = new DOMXPath($xmlResponse);
        $domXPath->registerNamespace('domain', 'urn:ietf:params:xml:ns:domain-1.0');
        $domains = $domXPath->query('//domain:chkData/domain:cd/domain:name');

        $results = [];
        foreach ($domains as $index => $domain) {
            $results[] = [
                'domain_name' => $domain->textContent,
                'is_available' => $domain->getAttribute('avail') === '1',
                'is_primary' => $index === 0,
                'price' => null, // Implement pricing logic here if needed
            ];
        }

        return [
            'success' => true,
            'message' => $message,
            'domains' => $results,
        ];
    }

    /**
     * Log EPP requests
     */
    private function logRequest(string $filename, string $content): void
    {
        if (! is_dir($this->debugPath)) {
            mkdir($this->debugPath, 0755, true);
        }
        file_put_contents($this->debugPath.$filename, $content, FILE_APPEND);
    }

    /**
     * Log EPP responses
     */
    private function logResponse(string $filename, string $content): void
    {
        if (! is_dir($this->debugPath)) {
            mkdir($this->debugPath, 0755, true);
        }
        file_put_contents($this->debugPath.$filename, $content, FILE_APPEND);
    }

    /**
     * Create a new contact in the EPP system
     *
     * @param  array  $contact  Contact information array containing:
     *                          - contact_id: Unique contact identifier
     *                          - names: Contact name
     *                          - org: Organization name
     *                          - street1: Street address line 1
     *                          - street2: Street address line 2
     *                          - street3: Street address line 3
     *                          - city: City
     *                          - sp: State/Province
     *                          - pc: Postal code
     *                          - cc: Country code
     *                          - voice: Phone number
     *                          - fax: Fax number
     *                          - email: Email address
     * @return array Response array containing:
     *               - success: boolean indicating success/failure
     *               - message: Response message
     *               - code: Response code
     *
     * @throws Exception
     */
    public function createContact(array $contact): array
    {
        $xml = sprintf('<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
    <command>
        <create>
            <contact:create xmlns:contact="urn:ietf:params:xml:ns:contact-1.0">
                <contact:id>%s</contact:id>
                <contact:postalInfo type="int">
                    <contact:name>%s</contact:name>
                    <contact:org>%s</contact:org>
                    <contact:addr>
                        <contact:street>%s</contact:street>
                        <contact:street>%s</contact:street>
                        <contact:street>%s</contact:street>
                        <contact:city>%s</contact:city>
                        <contact:sp>%s</contact:sp>
                        <contact:pc>%s</contact:pc>
                        <contact:cc>%s</contact:cc>
                    </contact:addr>
                </contact:postalInfo>
                <contact:voice x="1234">%s</contact:voice>
                <contact:fax>%s</contact:fax>
                <contact:email>%s</contact:email>
                <contact:authInfo>
                    <contact:pw>%s</contact:pw>
                </contact:authInfo>
                <contact:disclose flag="0">
                    <contact:voice/>
                    <contact:email/>
                </contact:disclose>
            </contact:create>
        </create>
        <clTRID>%s</clTRID>
    </command>
</epp>',
            $contact['contact_id'],
            $contact['names'],
            $contact['org'],
            $contact['street1'],
            $contact['street2'],
            $contact['street3'],
            $contact['city'],
            $contact['sp'],
            $contact['pc'],
            $contact['cc'],
            $contact['voice'],
            $contact['fax'],
            $contact['email'],
            uniqid(), // Generate unique password
            uniqid(mt_rand()) // Generate unique client transaction ID
        );

        try {
            $response = $this->client->request($xml);
            $this->logRequest('contact-create-request.xml', $xml);
            $this->logResponse('contact-create-response.xml', $response);

            $xmlResponse = new DOMDocument('1.0');
            $xmlResponse->loadXML($response);

            $responseCode = $xmlResponse->getElementsByTagName('result')->item(0)->getAttribute('code');
            $message = $xmlResponse->getElementsByTagName('msg')->item(0)->nodeValue;

            return [
                'success' => $responseCode === '1000',
                'message' => $message,
                'code' => $responseCode,
            ];
        } catch (Exception $e) {
            throw new Exception('Failed to create contact: '.$e->getMessage());
        }
    }

    /**
     * Close the EPP connection
     */
    public function __destruct()
    {
        if (isset($this->client)) {
            $this->client->disconnect();
        }
    }
}
