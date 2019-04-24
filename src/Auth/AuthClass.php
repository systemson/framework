<?php

namespace Amber\Framework\Auth;

class AuthClass
{
    private $user;

    public function __construct($user = null)
    {
        if (!is_null($user)) {
            $this->setUser($user);
        }
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function check()
    {
        return !is_null($this->user);
    }

    public function __call(string $method, $args)
    {
        if ($this->check()) {
            return $this->user[$method] ?? null;
        }
    }
}
