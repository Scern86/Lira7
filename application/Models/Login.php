<?php

namespace Scern\Lira\Application\Models;

use Scern\Lira\Model;

class Login extends Model
{
    protected string $table = 'main_login';
    public function __construct(protected $database)
    {
    }

    public function isLoggedIn(string $ssid,string $ip_address): bool
    {
        try{
            $today = new \DateTime();
            $yesterday = $today->modify('-1 day')->format('Y-m-d H:i:s');
            $query = $this->database->prepare("SELECT * FROM {$this->table} WHERE created > :created AND ssid = :ssid AND ip_address = :ip_address AND is_active = true");
            $query->execute(['created'=>$yesterday,'ssid' => $ssid,'ip_address'=>$ip_address]);
            $result = $query->fetch(\PDO::FETCH_ASSOC);
            return !empty($result);
        }catch (\Exception $e){
            //var_dump($e);
            return false;
        }
    }

    public function logIn(string $ssid,string $ip_address,int $id_user): bool
    {
        try{
            $query = $this->database->prepare("INSERT INTO {$this->table} (created,ssid,ip_address,id_user,is_active) VALUES (:created,:ssid,:ip_address,:id_user,true)");
            return $query->execute(['created'=>date('Y-m-d H:i:s'),'ssid' => $ssid,'ip_address'=>$ip_address,'id_user'=>$id_user]);
        }catch (\Exception $e){
            //var_dump($e);
            return false;
        }
    }
    public function logOut(string $ssid,string $ip_address): void
    {
        try{
            $query = $this->database->prepare("UPDATE {$this->table} SET is_active = false WHERE ssid = :ssid AND ip_address = :ip_address");
            $query->execute(['ssid' => $ssid,'ip_address'=>$ip_address]);
        }catch (\Exception $e){
            //var_dump($e);
        }
    }
}