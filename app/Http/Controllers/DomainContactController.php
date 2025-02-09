<?php

namespace App\Http\Controllers;

use DOMDocument;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Net_EPP_Client;

class DomainContactController extends Controller
{
    private array $params;

    public function __construct()
    {
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

    public function index()
    {
        return view('domains.contact');
    }

    /**
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $client = $this->getEppConnection();
        $xml = '<?xml version="1.0" encoding="UTF-8" standalone="no"?>
                <epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
                    <command>
                        <create>
                            <contact:create
                                xmlns:contact="urn:ietf:params:xml:ns:contact-1.0">
                                <contact:id>'.$request->input('contact_id').'</contact:id>
                                <contact:postalInfo type="int">
                                    <contact:name>'.$request->input('names').'</contact:name>
                                    <contact:org>'.$request->input('org').'</contact:org>
                                    <contact:addr>
                                        <contact:street>'.$request->input('street1').'</contact:street>
                                        <contact:street>'.$request->input('street2').'</contact:street>
                                        <contact:street>'.$request->input('street3').'</contact:street>
                                        <contact:city>'.$request->input('city').'</contact:city>
                                        <contact:sp>'.$request->input('sp').'</contact:sp>
                                        <contact:pc>'.$request->input('pc').'</contact:pc>
                                        <contact:cc>'.$request->input('cc').'</contact:cc>
                                    </contact:addr>
                                </contact:postalInfo>
                                <contact:voice x="1234">'.$request->input('voice').'</contact:voice>
                                <contact:fax>'.$request->input('fax').'</contact:fax>
                                <contact:email>'.$request->input('email').'</contact:email>
                                <contact:authInfo>
                                    <contact:pw>'.uniqid().'</contact:pw>
                                </contact:authInfo>
                                <contact:disclose flag="0">
                                    <contact:voice/>
                                    <contact:email/>
                                </contact:disclose>
                            </contact:create>
                        </create>
                        <clTRID>'.mt_rand().mt_rand().'</clTRID>
                    </command>
                </epp>';

        $response = $client->request($xml);

        // Process the response
        $xml_response = new DOMDocument('1.0');
        $xml_response->loadXML($response);

        // Check the response status
        $response_code = $xml_response->getElementsByTagName('result')->item(0)->getAttribute('code');

        // Log the request and response
        $log_path = storage_path('logs/epp');
        if (! file_exists($log_path)) {
            mkdir($log_path, 0755, true);
        }

        Storage::append('epp/response.xml', $xml_response->saveXML());
        Storage::append('epp/request.xml', $xml);

        if ($response_code == '1000') {
            return redirect()->back()->with('success', 'Contact created successfully!');
        }

        return redirect()->back()->with('error', 'Failed to create contact. Please try again.');
    }

    /**
     * Get EPP Client connection
     *
     * @return Net_EPP_Client
     *
     * @throws Exception
     */
    private function getEppConnection()
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
                ],
            ]);

            stream_context_set_option($context, 'ssl', 'local_cert', $this->params['Certificate']);
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
     * Build login XML
     *
     * @return string
     */
    private function buildLoginXml()
    {
        return '
        <epp xmlns="urn:ietf:params:xml:ns:epp-1.0">
            <command>
                <login>
                    <clID>'.$this->params['Username'].'</clID>
                    <pw>'.$this->params['Password'].'</pw>
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
        </epp>';
    }
}
