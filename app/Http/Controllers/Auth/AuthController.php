<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Helpdesk;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return view('index');
    }

    public function forgotPasswordPage()
    {
        return view('landing-page.forgot-password');
    }

    public function createTicket(Request $request)
    {
        $help = new Helpdesk();
        $help->inquiry = $request->inquiry;
        $help->email = $request->email;
        $help->fullname = $request->fullname;
        $help->message = $request->message;
        $help->save();

        return redirect()->back()->with('message', 'Inquiry successfully sent.');
    }


    public function resetPassword(Request $request)
    {
        if ($request->password == '') {
            return 'Password is required';
        } else if ($request->password_confirmation == '') {
            return 'Password confirmation is required';
        } else if ($request->password == '' && $request->password_confirmation == '') {
            return 'Password and Password confirmation is required.';
        } else if ($request->password != $request->password_confirmation) {
            return 'Passwords do not match.';
        }

        if ($request->password == $request->password_confirmation) {
            $user = User::findOrFail($request->secrettoken);
            $user->password = Hash::make($request->password);
            $user->save();

            return 'Password successfully changed.';
        }
    }

    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = User::findOrFail(auth()->user()->id);
            $user->last_login = Carbon::now();
            $user->save();

            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', 'Invalid login credentials.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
