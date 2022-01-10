<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;


class RegisterController extends Controller
{
    protected $userService;


    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $this->userService->register($request);
        $message = 'You have been successfully registered. To complete registration,follow the link in the letter
                    sent to your email address';
        flash($message)->info();
        return redirect()->route('login');
    }

}
