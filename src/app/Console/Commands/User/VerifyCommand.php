<?php

namespace App\Console\Commands\User;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Console\Command;

class VerifyCommand extends Command
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }

    protected $signature = 'user:verify {email}';

    protected $description = 'Verify user email address';

    public function handle()
    {
        $email = $this->argument('email');

        try {
            $user = User::findByEmail($email);
            $this->userService->verify($user->id);
            $this->info('User was success verified');
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
        }
    }
}
