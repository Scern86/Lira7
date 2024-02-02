<?php

namespace Scern\Lira\Application\Access;

use Scern\Lira\Access\UserContract;
use Scern\Lira\Database\Database;
use Scern\Lira\Model;

readonly class User extends Model implements UserContract
{
    protected UserData $userData;
    public function __construct(Database $database)
    {
        parent::__construct($database);
        $this->userData = $this->loadUserData(2);
    }
    public function isLoggedIn(): bool
    {
        return $this->userData->isLoggedIn();
    }

    public function login(): bool
    {
        return false;
    }

    public function getUserData(): UserData
    {
        return $this->userData;
    }

    public function logout(): void
    {
    }

    protected function loadUserData(int $id): UserData
    {
        try{
            $query = $this->db->prepare("SELECT id,login,name,is_active FROM main_users WHERE id = :id");
            $query->execute(['id'=>$id]);
            $result = $query->fetch(\PDO::FETCH_ASSOC);
            if(empty($result)) throw new \Exception('User not found');
            return new UserData(...$result);
        }catch (\Exception $e){
            return new UserData();
        }
    }
}