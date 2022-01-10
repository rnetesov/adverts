<?php

namespace App\Services;

use App\Mail\VerifyMail;
use App\Models\User;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Http\Request;

class UserService
{
    protected $mailer;
    protected $dispatcher;

    public function __construct(Mailer $mailer, Dispatcher $dispatcher)
    {
        $this->mailer = $mailer;
        $this->dispatcher = $dispatcher;
    }

    public function register(Request $request)
    {
        $user = User::register(
            $request['name'],
            $request['email'],
            $request['password']
        );
        $this->sendEmailNotification($user);
    }

    public function new(Request $request)
    {
        return User::new($request['name'], $request['email']);
    }

    public function verify(int $id)
    {
        $user = User::findOrFail($id);
        $user->verify();
    }

    public function sendEmailNotification(User $user)
    {
        $this->mailer
            ->to($user->email)
            ->send(new VerifyMail($user));
    }
}
