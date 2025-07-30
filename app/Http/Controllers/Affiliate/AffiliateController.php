<?php

namespace App\Http\Controllers\Affiliate;

use App\Http\Controllers\Controller;
use App\Models\AffiliatePartner;
use App\Models\FacebookUser;
use App\Models\User;
use App\Models\UserAffiliatePartner;
use App\Models\UserProfileSocialLink;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AffiliateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = auth()->user()->id;

        $data = FacebookUser::where('user_id', $userId)->first();
        $currentUser = User::findOrFail($userId);
        $affiliates = AffiliatePartner::paginate(10);

        return view('affiliate.affiliate-list', [
            'data' => $data,
            'currentUser' => $currentUser,
            'affiliates' => $affiliates
        ]);
    }

    public function store(Request $request)
    {
        $affiliate = new AffiliatePartner();
        $affiliate->name = $request->name;
        $affiliate->sale_tagline = $request->tagline;
        $affiliate->link = $request->link;
        $affiliate->save();

        Alert::success('Success', 'Affiliate partner successfully added');

        return redirect()->back();
    }

    public function destroy($id)
    {
        AffiliatePartner::findOrFail($id)->delete();

        Alert::success('Success', 'Affiliate partner successfully removed');

        return redirect()->back();
    }

    public function show($id)
    {
        $userId = auth()->user()->id;
        $data = FacebookUser::where('user_id', $userId)->first();
        $currentUser = User::findOrFail($userId);
        $userProfiles = UserProfileSocialLink::where('user_id', $userId)->first();
        $affiliate = AffiliatePartner::findOrFail($id);
        $affiliates = AffiliatePartner::all();

        $userAffiliate = UserAffiliatePartner::where('user_id', $userId)
            ->where('affiliate_id', $affiliate->id)
            ->first();

        return view('settings-pages.affiliate-partners', [
            'affiliate' => $affiliate,
            'affiliates' => $affiliates,
            'data' => $data,
            'currentUser' => $currentUser,
            'userProfiles' => $userProfiles,
            'userAffiliate' => $userAffiliate
        ]);
    }

    public function addUserAffiliate(Request $request)
    {
        $userId = auth()->user()->id;

        UserAffiliatePartner::updateOrCreate(
            [
                'user_id' => $userId,
                'affiliate_id' => $request->affiliate_id
            ],
            [
                'link' => $request->link
            ]
        );

        return redirect()->back();
    }
}
