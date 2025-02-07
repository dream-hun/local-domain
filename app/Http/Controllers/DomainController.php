<?php

namespace App\Http\Controllers;

use App\Models\DomainPricing;
use App\Services\EppService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DomainController extends Controller
{
    private EppService $eppService;

    public function __construct(EppService $eppService)
    {
        $this->eppService = $eppService;
    }

    public function index()
    {
        $tlds = DomainPricing::select(['tld', 'registration_price', 'renewal_price'])->get();

        return view('domains.search', compact('tlds'));
    }

    /**
     * Process a domain availability search.
     *
     * @return JsonResponse|RedirectResponse|View
     */
    public function search(Request $request)
    {
        try {
            $validated = $request->validate([
                'domain' => ['required', 'string', 'min:3', 'regex:/^[a-zA-Z0-9-]+$/'],
                'extension' => ['required', 'string'],
            ]);

            $domainText = $validated['domain'];
            $extension = $validated['extension'];

            $domainResults = $this->eppService->checkDomainAvailability($domainText, $extension);
            $domains = DomainPricing::orderBy('tld')->get();
            $popularDomains = DomainPricing::inRandomOrder()->limit(5)->get();

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $domainResults,
                ]);
            }

            return view('domains.search', [
                'searchResults' => $domainResults,
                'domains' => $domains,
                'popularDomains' => $popularDomains,
                'searchedDomain' => $domainText,
                'searchedExtension' => $extension,
            ]);

        } catch (Exception $e) {
            Log::error('EPP Error: '.$e->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to process domain check',
                    'error' => $e->getMessage(),
                ], 500);
            }

            return back()->withInput()->with('error', 'Failed to process domain check: '.$e->getMessage());
        }
    }
}
