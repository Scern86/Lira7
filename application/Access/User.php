<?php

namespace Scern\Lira\Application\Access;

use Scern\Lira\Access\UserContract;
use Scern\Lira\Database\Database;
use Scern\Lira\Model;

class User extends Model implements UserContract
{
    protected UserData $userData;

    protected string $table = 'main_users';
    public function __construct(Database $database,int $userId)
    {
        parent::__construct($database);
        $this->userData = $this->loadUserData($userId);
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
            $query = $this->db->prepare("SELECT id,login,name,is_active FROM {$this->table} WHERE id = :id");
            $query->execute(['id'=>$id]);
            $result = $query->fetch(\PDO::FETCH_ASSOC);
            if(empty($result)) throw new \Exception('User not found');
            return new UserData(...$result);
        }catch (\Throwable $e){
            //var_dump($e);
            return new UserData();
        }
    }

    public function isMethodAllowed(string $method): bool
    {
        return false;
    }
}