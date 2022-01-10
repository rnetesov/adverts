<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Mail\Mailable;

class VerifyMail extends Mailable
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('emails.auth.verify');
    }
}
