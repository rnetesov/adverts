<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserService;

class VerificationController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function verify(string $code)
    {
        try {
            $user = User::findByVerifyCode($code);
            $this->userService->verify($user->id);
            flash('Your email was success verified')->success();
            return redirect()->route('login');
        } catch (\DomainException $e) {
            flash($e->getMessage())->error();
            return redirect()->route('login');
        }
    }
}
