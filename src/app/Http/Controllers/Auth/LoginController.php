<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $authentication = Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ], $request->filled('remember'));

        if (!$authentication) {
            throw ValidationException::withMessages(['email' => trans('auth.failed')]);
        }

        $request->session()->regenerate();
        $user = Auth::user();

        if ($user->isWait()) {
            Auth::logout();
            flash('You need to confirm your account. Please check your email.')->error();
            return redirect()->route('login');
        }

        return redirect()->route('cabinet.home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login');
    }

}
