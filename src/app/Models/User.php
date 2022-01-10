<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasFactory;

    const STATUS_WAIT = 'waiting';
    const STATUS_ACTIVE = 'active';

    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'verify_code',
        'role'
    ];

    public static function register($name, $email, $password, $role = User::ROLE_USER): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => \Hash::make($password),
            'verify_code' => Str::random(30),
            'status' => User::STATUS_WAIT,
            'role' => $role
        ]);
    }

    public static function new($name, $email)
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => \Hash::make('password'),
            'status' => User::STATUS_ACTIVE,
            'role' => User::ROLE_USER
        ]);
    }

    public static function findByVerifyCode($code): User
    {
        $user = User::where('verify_code', $code)->first();
        if (is_null($user)) {
            throw new \DomainException('Verify code not found');
        }
        return $user;
    }

    public static function findByEmail($email): User
    {
        $user = User::where('email', $email)->first();
        if (is_null($user)) {
            throw new \DomainException('User Not Found');
        }
        return $user;
    }

    public function isActive(): bool
    {
        return $this->status === self::STATUS_ACTIVE;
    }

    public function isWait(): bool
    {
        return $this->status === self::STATUS_WAIT;
    }

    public function verify()
    {
        if (!$this->isWait()) {
            throw new \DomainException('The user has already been verified');
        }
        $this->status = self::STATUS_ACTIVE;
        $this->verify_code = null;
        $this->save();
    }

    public function isAdmin()
    {
        return $this->role == self::ROLE_ADMIN;
    }

    public function isUser()
    {
        return $this->role == self::ROLE_USER;
    }
}
