<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required',
        ]);
        $captcha = AppHelper::instance()->VerifyRecaptcha(
            $request['g-recaptcha-response']
        );
        if ($captcha) {
            if (
                Auth::attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ])
            ) {
                $request->session()->regenerate();
                return redirect()->intended('/admin');
            }
        }
        return back()->with([
            'danger' => 'Login failed',
            'pesan' => 'Check your login information',
        ]);
    }
}
