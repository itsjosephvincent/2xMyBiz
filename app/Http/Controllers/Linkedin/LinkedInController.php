<?php

namespace App\Http\Controllers\LinkedIn;

use App\Http\Controllers\Controller;
use App\Models\LinkedInUser;
use Illuminate\Http\Request;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Http;

class LinkedInController extends Controller
{
    public function provider()
    {
        $state = bin2hex(random_bytes(16));

        $queryParams = http_build_query([
            'response_type' => 'code',
            'client_id' => env('LINKEDIN_CLIENT_ID'),
            'redirect_uri' => env('LINKEDIN_REDIRECT'),
            'state' => $state,
            'scope' => 'r_liteprofile r_emailaddress w_member_social',
        ]);

        $authorizationUrl = 'https://www.linkedin.com/oauth/v2/authorization?' . $queryParams;

        return redirect()->away($authorizationUrl);
    }

    public function callback(Request $request)
    {
        $code = $request->input('code');

        $response = Http::asForm()->post('https://www.linkedin.com/oauth/v2/accessToken', [
            'grant_type' => 'authorization_code',
            'client_id' => env('LINKEDIN_CLIENT_ID'),
            'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
            'code' => $code,
            'redirect_uri' => env('LINKEDIN_REDIRECT'),
        ]);

        $data = json_decode($response);

        $user = Http::withHeaders([
            'Authorization' => 'Bearer ' . $data->access_token,
        ])->get('https://api.linkedin.com/v2/me');

        $userData = json_decode($user);

        $now = new DateTime();
        $interval = new DateInterval('PT' . $data->expires_in . 'S');
        $futureDate = $now->add($interval);

        LinkedInUser::updateOrCreate(
            [
                'user_id' => auth()->user()->id
            ],
            [
                'linkedin_id' =>  $userData->id,
                'first_name' => $userData->localizedFirstName,
                'last_name' => $userData->localizedLastName,
                'token' => $data->access_token,
                'token_expiry' => $futureDate->format('Y-m-d'),
            ]
        );

        return redirect()->route('integrations');
    }
}
