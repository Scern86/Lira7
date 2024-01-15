<?php

namespace Scern\Lira\Application\Models;

use Scern\Lira\Model;

class Role extends Model
{
    protected string $table = 'access_roles';
    protected string $user_role_ref_table = 'user_role_ref';
    public function __construct(protected $database)
    {
    }

    public function getRolesByUserId(int $userId): array
    {
        try{
            $query = $this->database->prepare("SELECT r.* FROM {$this->table} AS r,{$this->user_role_ref_table} AS ref WHERE r.id=ref.id_role AND ref.id_user = :id_user");
            $query->execute(['id_user' => $userId]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return [];
        }
    }
}