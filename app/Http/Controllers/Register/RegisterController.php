<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function free()
    {
        return view('landing-page.free');
    }

    public function freelancer()
    {
        return view('landing-page.freelancer');
    }

    public function pro()
    {
        return view('landing-page.pro');
    }

    public function agency()
    {
        return view('landing-page.agency');
    }

    public function storeFree(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole('Free');
        $user->givePermissionTo(['manage_leads']);

        return redirect()->route('dashboard');
    }

    public function storeFreelancer(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole('Freelancer');
        $user->givePermissionTo(['manage_leads', 'manage_deals']);

        return redirect()->route('dashboard');
    }

    public function storePro(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole('Pro');
        $user->givePermissionTo(['manage_leads', 'manage_deals']);

        return redirect()->route('dashboard');
    }

    public function storeAgency(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $user->assignRole('Agency');
        $user->givePermissionTo(['manage_leads', 'manage_deals']);

        return redirect()->route('dashboard');
    }
}
