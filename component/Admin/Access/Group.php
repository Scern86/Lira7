<?php

namespace Scern\Lira\Component\Admin\Access;

use Scern\Lira\Access\Permissions;
use Scern\Lira\Database\Database;
use Scern\Lira\Model;

class Group extends Model
{
    protected string $table = 'access_groups';
    protected string $table_user_group_ref = 'access_user_group_ref';
    protected Permissions $permissions;

    public function __construct(Database $database,int $idUser)
    {
        parent::__construct($database);
        $this->permissions = $this->loadData($idUser);
    }
    public function getData(): Permissions
    {
        return $this->permissions;
    }

    protected function loadData(int $idUser): Permissions
    {
        try{
            $query = $this->db->prepare("SELECT g.* FROM {$this->table_user_group_ref} AS ref,{$this->table} AS g 
         WHERE g.id = ref.id_group AND ref.id_user = :id_user");
            $query->execute(['id_user' => $idUser]);
            $group =  $query->fetch(\PDO::FETCH_ASSOC);
            if(empty($group)) throw new \Exception('The user is not a member of any group');
            $actionsModel = new GroupActions($this->database);
            $group['actions'] = $actionsModel->getActionsByIdGroup($group['id']);
            return new GroupData(...$group);
        }catch (\Throwable $e){
            //var_dump($e);
            return new GroupData();
        }
    }
}