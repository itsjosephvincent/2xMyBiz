<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\AffiliatePartner;
use App\Models\FacebookUser;
use App\Models\User;
use App\Models\UserBusiness;
use App\Models\UserDetails;
use App\Models\UserProfileSocialLink;
use Illuminate\Http\Request;

class AffiliateMarketingController extends Controller
{
    public function myleads()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $userDetails = UserDetails::where('user_id', $userId)->first();
        $userProfiles = UserProfileSocialLink::where('user_id', $userId)->first();
        $userBusiness = UserBusiness::where('user_id', $userId)->first();
        $data = FacebookUser::where('user_id', $userId)->first();
        $affiliates = AffiliatePartner::all();

        return view('settings-pages.2xmyleads-affiliate', [
            'currentUser' => $currentUser,
            'userDetails' => $userDetails,
            'userProfiles' => $userProfiles,
            'userBusiness' => $userBusiness,
            'data' => $data,
            'affiliates' => $affiliates,
        ]);
    }

    public function kartra()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $userDetails = UserDetails::where('user_id', $userId)->first();
        $userProfiles = UserProfileSocialLink::where('user_id', $userId)->first();
        $userBusiness = UserBusiness::where('user_id', $userId)->first();
        $data = FacebookUser::where('user_id', $userId)->first();
        $affiliates = AffiliatePartner::all();

        return view('settings-pages.kartra-affiliate', [
            'currentUser' => $currentUser,
            'userDetails' => $userDetails,
            'userProfiles' => $userProfiles,
            'userBusiness' => $userBusiness,
            'data' => $data,
            'affiliates' => $affiliates,
        ]);
    }

    public function updateMyLeads(Request $request, string $id)
    {
        $userBusiness = UserBusiness::where('user_id', $id)->first();
        if ($userBusiness) {
            $userBusiness->myleads_link = $request->myleads_link;
            $userBusiness->save();

            return redirect()->back();
        } else {
            $user = new UserBusiness();
            $user->user_id = auth()->user()->id;
            $user->myleads_link = $request->myleads_link;
            $user->save();

            return redirect()->back();
        }
    }

    public function updateKartra(Request $request, string $id)
    {
        $userBusiness = UserBusiness::where('user_id', $id)->first();
        if ($userBusiness) {
            $userBusiness->kartra_link = $request->kartra_link;
            $userBusiness->save();

            return redirect()->back();
        } else {
            $user = new UserBusiness();
            $user->user_id = auth()->user()->id;
            $user->kartra_link = $request->kartra_link;
            $user->save();

            return redirect()->back();
        }
    }
}
