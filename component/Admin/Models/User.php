<?php

namespace Scern\Lira\Component\Admin\Models;

use Scern\Lira\Model;

class User extends Model
{
    protected string $table = 'main_users';

    public function __construct(protected $database)
    {
    }

    public function isValidCredentials(string $login,string $password): bool
    {
        try{
            $user = $this->getUserByLogin($login);
            if(is_null($user)) return false;
            return password_verify($password,$user['password']);
        }catch (\Exception $e){
            //var_dump($e);
            return false;
        }
    }

    public function getUserByLogin(string $login): ?array
    {
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table} WHERE login = :login");
            $query->execute(['login' => $login]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return null;
        }
    }
    public function getUserById(int $id): ?array
    {
        try{
            $query = $this->database->prepare("SELECT * FROM {$this->table} WHERE id = :id");
            $query->execute(['id' => $id]);
            return $query->fetch(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return null;
        }
    }
}