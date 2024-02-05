<?php

namespace Scern\Lira\Component\Admin\Access;

use Scern\Lira\Access\Permissions;
use Scern\Lira\Database\Database;
use Scern\Lira\Model;

class GroupActions extends Model
{
    protected string $table = 'access_actions';
    protected string $table_group_action_ref = 'access_group_action_ref';

    public function __construct(Database $database)
    {
        parent::__construct($database);
    }

    public function getActionsByIdGroup(int $idGroup): array
    {
        try{
            $query = $this->db->prepare("SELECT a.method,ref.is_allowed FROM {$this->table} AS a,{$this->table_group_action_ref} AS ref 
         WHERE a.id = ref.id_action AND ref.id_group = :id_group");
            $query->execute(['id_group' => $idGroup]);
            $actions =  $query->fetchAll(\PDO::FETCH_KEY_PAIR);
            if(!is_array($actions)) throw new \Exception('This group haven`t any actions');
            return $actions;
        }catch (\Throwable $e){
            //var_dump($e);
            return [];
        }
    }
}