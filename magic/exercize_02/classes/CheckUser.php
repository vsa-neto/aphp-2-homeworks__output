<?php

declare(strict_types=1);

class CheckUser
{
    use AppUserAuthentication, MobileUserAuthentication {
        AppUserAuthentication::authenticate insteadof MobileUserAuthentication;

        AppUserAuthentication::authenticate as authenticate;
        MobileUserAuthentication::authenticate as mAuthenticate;
    }

    // Метод авторизации
    public function login($login, $password)
    {

        echo "Попытка входа с логином: $login\n";

        // авторизация для App.
        $result = $this->authenticate($login, $password);
        if ($result) return $result;

        // авторизация для Mob.
        $result = $this->mAuthenticate($login, $password);
        if ($result) return $result;

        return "Авторизация не удалась: Неверный логин или пароль";
    }
}
