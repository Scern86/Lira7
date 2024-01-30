<?php

namespace Scern\Lira\Component\Admin;

use Scern\Lira\Access\AccessManager;
use Scern\Lira\Application\Models\Login;
use Scern\Lira\Component\Admin\Models\Action;
use Scern\Lira\Component\Admin\Models\Role;
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

        // Load list rules from DB
        $roleMdl = new Role($this->databaseManager->get('database'));
        $roles = $roleMdl->getRolesByUserId(1);
        $rules = [];
        if(!empty($roles)){
            $actionsMdl = new Action($this->databaseManager->get('database'));
            foreach ($roles as $role){
                $actions = $actionsMdl->getActionsByRoleId($role['id']);
                if(!empty($actions)){
                    foreach ($actions as $action){
                        $rules[$action['action']] = $action['is_allowed'];
                    }
                }
            }
        }

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