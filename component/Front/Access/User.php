<?php

namespace Scern\Lira\Component\Front\Access;

use Scern\Lira\Application\Access\Login;
use Scern\Lira\Application\Access\LoginData;
use Scern\Lira\Database\Database;

class User extends \Scern\Lira\Application\Access\User
{
    protected Login $login;
    protected LoginData $loginData;

    public function __construct(Database $database, protected string $ssid, protected string $ipAddress, protected string $component)
    {
        $this->login = new Login($database, $ssid, $ipAddress, $component);
        $this->loginData = $this->login->getData();
        parent::__construct($database, $this->loginData->id_user);
    }

    public function login(string $login = '', string $password = ''): bool
    {
        return $this->verifyLogin($login, $password);
    }

    public function logout(): void
    {
        $this->login->logout();
    }

    protected function verifyLogin(string $login, string $password): bool
    {
        $user = $this->getByLogin($login);
        if (!is_null($user)) {
            if (password_verify($password, $user['password'])) {
                $this->login->login($user['id'], $this->ssid, $this->ipAddress, $this->component);
                return true;
            }
        }
        return false;
    }


    protected function getByLogin(string $login): ?array
    {
        try {
            $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE login = :login AND is_active = :is_active");
            $query->execute(['login' => $login, 'is_active' => true]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            //var_dump($e);
            return null;
        }
    }
}