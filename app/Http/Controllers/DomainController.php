<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Domain;
use App\Models\DomainPricing;
use App\Services\Epp\EppService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DomainController extends Controller
{
    private EppService $eppService;

    public function __construct(EppService $eppService)
    {
        $this->eppService = $eppService;
    }

    /**
     * Show the domain search form
     */
    public function index()
    {
        $tlds = DomainPricing::select(['tld', 'register_price', 'renew_price', 'transfer_price'])->get();

        return view('domains.search', compact('tlds'));
    }

    /**
     * Check domain availability
     */
    public function check(Request $request)
    {
        Log::info('Domain check request:', $request->all());

        $request->validate([
            'domain' => 'required|string|min:3|max:63|regex:/^[a-zA-Z0-9][a-zA-Z0-9-]*[a-zA-Z0-9]$/',
            'tld' => 'required|string|in:rw,co.rw,org.rw',
        ]);

        $domain = strtolower($request->input('domain'));
        $tld = $request->input('tld');

        try {
            $results = $this->eppService->checkDomain($domain, $tld);

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'results' => $results,
                ]);
            }

            return view('domains.search', [
                'results' => $results,
                'searchedDomain' => $domain,
                'searchedTld' => $tld,
                'tlds' => DomainPricing::select(['tld', 'register_price', 'renew_price', 'transfer_price'])->get(),
            ]);

        } catch (Exception $e) {
            Log::error('Domain check error:', ['error' => $e->getMessage()]);
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Unable to check domain availability. Please try again later.',
                ], 500);
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Unable to check domain availability. Please try again later.']);
        }
    }



}
