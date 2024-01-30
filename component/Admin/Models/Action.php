<?php

namespace Scern\Lira\Component\Admin\Models;

use Scern\Lira\Model;

class Action extends Model
{
    protected string $table = 'access_actions';

    protected string $table_reference = 'role_action_ref';

    public function __construct(protected $database)
    {
    }
    public function getActionsByRoleId(int $roleId): ?array
    {
        try{
            $query = $this->database->prepare("SELECT a.action,ref.is_allowed FROM {$this->table} AS a,{$this->table_reference} AS ref WHERE a.id=ref.id_action AND ref.id_role = :id_role");
            $query->execute(['id_role' => $roleId]);
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        }catch (\Exception $e){
            //var_dump($e);
            return null;
        }
    }
}