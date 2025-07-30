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
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Throwable;

class BusinessLogoController extends Controller
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

        return view('settings-pages.business-logo', [
            'currentUser' => $currentUser,
            'userDetails' => $userDetails,
            'userProfiles' => $userProfiles,
            'userBusiness' => $userBusiness,
            'data' => $data,
            'affiliates' => $affiliates,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Specify your image validation rules here
        ]);

        $userId = auth()->user()->id;

        if ($request->file('logo')) {
            $userBusiness = UserBusiness::where('user_id', $userId)->first();
            if ($userBusiness) {
                $media = Media::where('model_id', $userBusiness->id)
                    ->where('model_type', 'App\Models\UserBusiness')
                    ->where('collection_name', 'business_logo')
                    ->first();
                if ($media) {
                    $media->forceDelete($media->id);
                }
                $userBusiness->addMediaFromRequest('logo')->toMediaCollection('business_logo');
                $userBusiness->business_logo = $userBusiness->getMedia('business_logo')->last()->getUrl();
                $userBusiness->save();
            } else {
                $user = new UserBusiness();
                $user->user_id = auth()->user()->id;
                $user->save();

                $getUser = UserBusiness::findOrFail($user->id);
                $media = Media::where('model_id', $getUser->id)
                    ->where('model_type', 'App\Models\UserBusiness')
                    ->where('collection_name', 'business_logo')
                    ->first();
                if ($media) {
                    $media->forceDelete($media->id);
                }
                $getUser->addMediaFromRequest('logo')->toMediaCollection('business_logo');
                $getUser->business_logo = $getUser->getMedia('business_logo')->last()->getUrl();
                $getUser->save();
            }

            Alert::success('Success', 'Logo successfully uploaded.');

            return redirect()->route('business-logo');
        }
    }
}
