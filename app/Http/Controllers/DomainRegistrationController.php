<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Domain;
use App\Services\Epp\EppService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DomainRegistrationController extends Controller
{
    private EppService $eppService;

    public function __construct(EppService $eppService)
    {
        $this->eppService = $eppService;
    }

    public function index(Request $request)
    {
        $domain = $request->input('domain');
        $tld = $request->input('tld');

        if (! $domain || ! $tld) {
            return redirect()->route('domains.search');
        }

        return view('domains.register', compact('domain', 'tld'));
    }

    /**
     * Process domain registration
     */
    public function register(Request $request)
    {
        Log::info('Domain registration request:', $request->all());

        $request->validate([
            'domain' => 'required|string',
            'tld' => 'required|string|in:rw,co.rw,org.rw',
            'registrant_name' => 'required|string|max:255',
            'registrant_email' => 'required|email',
            'registrant_phone' => 'required|string|max:20',
            'registrant_address' => 'required|string|max:255',
            'technical_name' => 'required|string|max:255',
            'technical_email' => 'required|email',
            'technical_phone' => 'required|string|max:20',
            'technical_address' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            // Create registrant contact
            $registrantContact = Contact::create([
                'contact_id' => 'REG-'.uniqid(),
                'type' => 'registrant',
                'names' => $request->input('registrant_name'),
                'org' => $request->input('registrant_name'),
                'street1' => $request->input('registrant_address'),
                'street2' => '',
                'street3' => '',
                'city' => 'Kigali',
                'sp' => 'Kigali',
                'pc' => '00000',
                'cc' => 'RW',
                'voice' => $request->input('registrant_phone'),
                'fax' => '',
                'email' => $request->input('registrant_email'),
            ]);

            // Create EPP registrant contact
            $registrantResult = $this->eppService->createContact($registrantContact->toArray());
            if (! $registrantResult['success']) {
                throw new Exception('Failed to create registrant contact: '.$registrantResult['message']);
            }

            // Create technical contact
            $technicalContact = Contact::create([
                'contact_id' => 'TECH-'.uniqid(),
                'type' => 'technical',
                'names' => $request->input('technical_name'),
                'org' => $request->input('technical_name'),
                'street1' => $request->input('technical_address'),
                'street2' => '',
                'street3' => '',
                'city' => 'Kigali',
                'sp' => 'Kigali',
                'pc' => '00000',
                'cc' => 'RW',
                'voice' => $request->input('technical_phone'),
                'fax' => '',
                'email' => $request->input('technical_email'),
            ]);

            // Create EPP technical contact
            $technicalResult = $this->eppService->createContact($technicalContact->toArray());
            if (! $technicalResult['success']) {
                throw new Exception('Failed to create technical contact: '.$technicalResult['message']);
            }

            // Create domain record
            $domain = Domain::create([
                'name' => $request->input('domain'),
                'tld' => $request->input('tld'),
                'status' => 'pending',
                'registrant_contact_id' => $registrantContact->id,
                'technical_contact_id' => $technicalContact->id,
            ]);

            // TODO: Add domain creation once the createDomain method is implemented
            // $domainResult = $this->eppService->createDomain([
            //     'domain' => $domain->name,
            //     'tld' => $domain->tld,
            //     'registrant' => $registrantContact->contact_id,
            //     'technical' => $technicalContact->contact_id
            // ]);

            DB::commit();

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Domain registration request has been submitted successfully.',
                    'domain' => $domain->full_domain,
                    'registrant_id' => $registrantContact->contact_id,
                    'technical_id' => $technicalContact->contact_id,
                ]);
            }

            return redirect()
                ->route('domains.search')
                ->with('success', 'Domain registration request has been submitted successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Domain registration error:', ['error' => $e->getMessage()]);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Unable to process domain registration. Please try again later.',
                ], 500);
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Unable to process domain registration. Please try again later.']);
        }
    }
}
