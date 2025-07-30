<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\AffiliatePartner;
use App\Models\Country;
use App\Models\FacebookUser;
use App\Models\User;
use App\Models\UserBusiness;
use App\Models\UserDetails;
use App\Models\UserProfileSocialLink;
use Illuminate\Http\Request;

class BusinessInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $currentUser = User::findOrFail($userId);
        $userDetails = UserDetails::where('user_id', $userId)->first();
        $userProfiles = UserProfileSocialLink::where('user_id', $userId)->first();
        $userBusiness = UserBusiness::where('user_id', $userId)->first();
        $countries = Country::all();
        $data = FacebookUser::where('user_id', $userId)->first();
        $affiliates = AffiliatePartner::all();

        return view('settings-pages.business-information', [
            'currentUser' => $currentUser,
            'userDetails' => $userDetails,
            'userProfiles' => $userProfiles,
            'countries' => $countries,
            'userBusiness' => $userBusiness,
            'data' => $data,
            'affiliates' => $affiliates,
        ]);
    }

    public function update(Request $request, string $id)
    {
        UserBusiness::updateOrCreate(
            [
                'user_id' => $id
            ],
            [
                'business_name' => $request->business_name,
                'business_address' => $request->business_address,
                'business_email' => $request->business_email,
                'business_phone' => $request->business_phone,
                'business_website' => $request->business_website,
                'about_us' => $request->about_us,
                'audit_message' => $request->audit_message
            ]
        );

        return redirect()->route('business-information');
    }
}
