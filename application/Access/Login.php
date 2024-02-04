<?php

namespace Scern\Lira\Application\Access;

use Scern\Lira\Database\Database;
use Scern\Lira\Model;

class Login extends Model
{
    protected string $table = 'main_login';
    protected LoginData $loginData;

    public function __construct(Database $database, string $ssid, string $ipAddress, string $component)
    {
        parent::__construct($database);
        $this->loginData = $this->loadData($ssid, $ipAddress, $component);
    }

    public function getData(): LoginData
    {
        return $this->loginData;
    }

    public function login(int $userId,string $ssid,string $ipAddress,string $component): void
    {
        try{
            $query = $this->db->prepare("INSERT INTO {$this->table} 
        (ssid,ip_address,id_user,is_active,component) 
    VALUES(:ssid,:ip_address,:id_user,:is_active,:component)");
            $query->execute(
                [
                    'ssid'=>$ssid,
                    'ip_address'=>$ipAddress,
                    'id_user'=>$userId,
                    'is_active'=>true,
                    'component'=>$component,
                ]
            );
        }catch (\Throwable $e){
            var_dump($e);
        }
    }

    public function logout(): void
    {
        try{
            $query = $this->db->prepare("UPDATE {$this->table} SET is_active = false WHERE id = :id");
            $query->execute(
                [
                    'id'=>$this->loginData->id,
                ]
            );
        }catch (\Throwable $e){
            var_dump($e);
        }
    }

    protected function loadData(string $ssid, string $ipAddress, string $component): LoginData
    {
        try {
            $today = new \DateTime();
            $yesterday = $today->modify('-1 day')->format('Y-m-d H:i:s');
            $query = $this->db->prepare("SELECT * FROM {$this->table} 
         WHERE created > :created AND ssid = :ssid AND ip_address = :ip_address 
           AND component = :component AND is_active = :is_active");
            $query->execute(
                [
                    'created' => $yesterday,
                    'ssid' => $ssid,
                    'ip_address' => $ipAddress,
                    'is_active' => true,
                    'component' => $component
                ]
            );
            $result = $query->fetch(\PDO::FETCH_ASSOC);
            if (empty($result)) throw new \Exception('That user was not logged in yet');
            return new LoginData(...$result);
        } catch (\Throwable $e) {
            //var_dump($e);
            return new LoginData();
        }
    }
}