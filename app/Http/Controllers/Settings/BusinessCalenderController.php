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

class BusinessCalenderController extends Controller
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
        $data = FacebookUser::where('user_id', $userId)->first();
        $affiliates = AffiliatePartner::all();

        return view('settings-pages.business-calendar', [
            'currentUser' => $currentUser,
            'userDetails' => $userDetails,
            'userProfiles' => $userProfiles,
            'userBusiness' => $userBusiness,
            'data' => $data,
            'affiliates' => $affiliates,
        ]);
    }

    public function update(Request $request, string $id)
    {
        $userBusiness = UserBusiness::where('user_id', $id)->first();
        if ($userBusiness) {
            $userBusiness->business_calendar_link = $request->calendar_link;
            $userBusiness->save();

            return redirect()->route('business-calender');
        } else {
            $user = new UserBusiness();
            $user->user_id = auth()->user()->id;
            $user->business_calendar_link = $request->calendar_link;
            $user->save();

            return redirect()->route('business-calender');
        }
    }

    public function destroy()
    {
        $userId = auth()->user()->id;

        $userBusiness = UserBusiness::where('user_id', $userId)->first();
        $userBusiness->business_calendar_link = null;
        $userBusiness->save();

        return redirect()->route('business-calender');
    }
}
