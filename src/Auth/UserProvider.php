<?php

namespace Amber\Framework\Auth;

use App\Models\User;

class UserProvider extends User implements UserProviderContract
{
    protected $table = 'users';

    public function hasUserBy(string $key, $value)
    {
        return $this->where($key, $value)->count() > 0;
    }

    public function getUserBy(string $key, $value)
    {
        return $this->where($key, $value)->first();
    }

    public function hasUserById(integer $value)
    {
        return $this->hasUserBy('id', $value)->count() > 0;
    }

    public function getUserById(integer $id)
    {
        return $this->getUserBy('id', $id);
    }

    public function hasUserByEmail(string $email)
    {
        return $this->hasUserBy('email', $email)->count() > 0;
    }

    public function getUserByEmail(string $email)
    {
        return $this->getUserBy('email', $email);
    }

    public function hasUserByToken(string $token)
    {
        return $this->hasUserBy('remember_token', $token);
    }

    public function getUserByToken(string $token)
    {
        return $this->getUserBy('remember_token', $token);
    }
}
