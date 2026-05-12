<?php

declare(strict_types=1);

trait AppUserAuthentication
{
    private string $login = "user_A1";
    private int $password = 5678;

    public function authenticate($login, $password): string | bool
    {
        if ($this->login === $login && $this->password === $password) {
            return "пользователь с логином: '$login' авторизован как пользователь [ приложения ]";
        } else {
            return false;
        }
    }
}
