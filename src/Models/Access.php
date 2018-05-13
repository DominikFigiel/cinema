<?php
namespace Models;
use \PDO;
class Access extends Model {

    public function login($login, $password){
        $data = array();

        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }

        if($login === null || $login === "" || $password === null || $password === ""){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }

        $admins = array();

        try	{
            $stmt = $this->pdo->prepare('
                    SELECT * FROM `'.\Config\Database\DBConfig::$tableAdmin.'`
                    WHERE `'.\Config\Database\DBConfig::$tableAdmin.'`.`'.\Config\Database\DBConfig\Admin::$login.'` = :login
				');
            $stmt->bindValue(':login', $login, PDO::PARAM_STR);
            $result = $stmt->execute();
            if($result){
                $admins = $stmt->fetchAll();
                if(count($admins) <=0){
                    $data['error'] = \Config\Database\DBErrorName::$wrongdata;
                    return $data;
                }
            }
            else{
                $data['error'] = \Config\Database\DBErrorName::$wrongdata;
                return $data;
            }
            $stmt->closeCursor();
        }
        catch(\PDOException $e)	{
            $data['error'] = \Config\Database\DBErrorName::$query;
        }

        $admin = $admins[0];
        if($login === $admin[\Config\Database\DBConfig\Admin::$login] && $password == $admin[\Config\Database\DBConfig\Admin::$password])
        {
            \Tools\Access::login($login , $admins[\Config\Database\DBConfig\Admin::$firstName], $admins[\Config\Database\DBConfig\Admin::$lastName]);
            return $data;
        }
        $data['error'] = \Config\Database\DBErrorName::$wrongdata;
        return $data;
    }

    public function logout(){
        \Tools\Access::logout();
    }

}