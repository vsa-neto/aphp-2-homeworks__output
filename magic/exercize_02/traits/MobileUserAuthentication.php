<?php

declare(strict_types=1);

trait MobileUserAuthentication
{

    private string $mLogin = "user_M1";
    private int $mPassword = 1234;

    public function authenticate(string $login, int $password): string | bool
    {
        if ($this->mLogin === $login && $this->mPassword === $password) {
            return "пользователь с логином: '$login' авторизован как пользователь [ мобильного приложения ]";
        } else {
            return false;
        }
    }
}
