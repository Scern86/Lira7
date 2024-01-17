<?php

namespace Scern\Lira\Component\Admin;

use Scern\Lira\Access\AccessManager;
use Scern\Lira\Application\Models\Login;
use Scern\Lira\Extensions\Database\DatabaseManager;
use Scern\Lira\State\StateStrategy;

class User extends \Scern\Lira\User
{
    public function __construct(AccessManager $accessManager, StateStrategy $stateManager,protected DatabaseManager $databaseManager, protected string $remoteIpAddress)
    {
        $stateManager->init();
        $loginModel = new Login($databaseManager->get('database'));

        $isActiveSession = !isset($stateManager->isAdmin);
        if(!$isActiveSession) {
            if($loginModel->isLoggedIn($stateManager->stateId,$this->remoteIpAddress)) $isGuest = false;
            else $isGuest = true;
        }
        else $isGuest = true;
        // TODO Load list rules from DB
        $rules = [
            'Scern\Lira\Component\Admin\Article\Article::_add'=>true,
            'Scern\Lira\Component\Admin\Article\Article::_edit'=>true,
            'Scern\Lira\Component\Admin\Article\Article::_list'=>true,
        ];
        parent::__construct($accessManager,$stateManager,$isGuest);
        $this->accessManager->addRules($rules);
    }

    public function login(string $login, string $password): bool
    {
        $userModel = new \Scern\Lira\Component\Admin\Models\User($this->databaseManager->get('database'));
        if($userModel->isValidCredentials($login,$password)) {
            $user = $userModel->getUserByLogin($login);
            $this->stateManager->save('isAdmin',true);
            $loginModel = new Login($this->databaseManager->get('database'));
            $loginModel->logIn($this->stateManager->stateId,$this->remoteIpAddress,$user['id']);
            return true;
        }
        return false;
    }

    public function logout(): void
    {
        $loginModel = new Login($this->databaseManager->get('database'));
        $loginModel->logOut($this->stateManager->stateId,$this->remoteIpAddress);
        $this->stateManager->clear();
    }

    public function isMethodAllowed(string $method): bool
    {
        if($this->isGuest) return false;
        return parent::isMethodAllowed($method);
    }
}