<?php

namespace App\Http\Controllers\Google;

use App\Http\Controllers\Controller;
use App\Models\FacebookUser;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;

class PageSpeedInsightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = auth()->user();
        $data = FacebookUser::where('user_id', $currentUser->id)->first();
        $leads = Lead::whereNotNull('website')->where('user_id', $currentUser->id)->get();

        return view('seo.seo-list', [
            'leads' => $leads,
            'data' => $data,
            'currentUser' => $currentUser,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = auth()->user();
        $lead = Lead::findOrFail($id);
        $data = FacebookUser::where('user_id', $user->id)->first();

        $response = Http::timeout(60)
            ->get('https://pagespeedonline.googleapis.com/pagespeedonline/v5/runPagespeed?url=' . $lead->website . '/&category=SEO&category=BEST_PRACTICES&category=PERFORMANCE&category=ACCESSIBILITY&category=PWA&strategy=DESKTOP&key=' . env('GOOGLE_API_KEY'));

        $responseJson = $response->json();

        if (isset($responseJson['lighthouseResult'])) {
            return view('seo.seo-audit', [
                'lead' => $lead,
                'data' => $data,
                'currentUser' => $user,
                'performance' => $responseJson['lighthouseResult']['categories']['performance']['score'] * 100,
                'bestpractices' => $responseJson['lighthouseResult']['categories']['best-practices']['score'] * 100,
                'seo' => $responseJson['lighthouseResult']['categories']['seo']['score'] * 100,
                'access' => $responseJson['lighthouseResult']['categories']['accessibility']['score'] * 100,
                'pwa' => $responseJson['lighthouseResult']['categories']['pwa']['score'] * 100,
                'fcp' => $responseJson['lighthouseResult']['audits']['first-contentful-paint'],
                'lcp' => $responseJson['lighthouseResult']['audits']['largest-contentful-paint'],
                'tbt' => $responseJson['lighthouseResult']['audits']['total-blocking-time'],
                'cls' => $responseJson['lighthouseResult']['audits']['cumulative-layout-shift'],
                'si' => $responseJson['lighthouseResult']['audits']['speed-index'],
                'audits' => $response['lighthouseResult']['audits'],
                'bestresults' => $responseJson['lighthouseResult']['categories']['best-practices']['auditRefs'],
                'accresults' => $responseJson['lighthouseResult']['categories']['accessibility']['auditRefs'],
                'seoresults' => $responseJson['lighthouseResult']['categories']['seo']['auditRefs'],
                'pwaresults' => $responseJson['lighthouseResult']['categories']['pwa']['auditRefs'],
            ]);
        } else {
            Alert::info('Please be advised', "The lead's website is not secure for SEO Audit.");

            return redirect()->back();
        }
    }
}
