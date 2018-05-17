<?php
namespace Models;
use \PDO;
class Actor extends Model {

    public function getAll(){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $data['actors'] = array();
        try{
            $query = '
                    SELECT * FROM `'.\Config\Database\DBConfig::$tableActor.'`
            ';
            $query .= 'ORDER BY `'.\Config\Database\DBConfig::$tableActor.'`.`'.\Config\Database\DBConfig\Actor::$FirstName.'`,
                         `'.\Config\Database\DBConfig::$tableActor.'`.`'.\Config\Database\DBConfig\Actor::$LastName.'` ASC';
            $stmt = $this->pdo->query($query);
            $actors = $stmt->fetchAll();
            $stmt->closeCursor();

            if($actors && !empty($actors))
                $data['actors'] = $actors;
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function addActor($firstName, $lastName, $birthDate){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($firstName) || is_null($lastName) || is_null($birthDate)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        try{
            $query = '           
                INSERT INTO '.\Config\Database\DBConfig::$tableActor.' ('.\Config\Database\DBConfig\Actor::$FirstName.',
                                                                          '.\Config\Database\DBConfig\Actor::$LastName.',
                                                                          '.\Config\Database\DBConfig\Actor::$BirthDate.')
                VALUES (:firstName, :lastName, :birthDate)
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':firstName' , $firstName , PDO::PARAM_STR);
            $stmt->bindValue(':lastName' , $lastName , PDO::PARAM_STR);
            $stmt->bindValue(':birthDate' , $birthDate , PDO::PARAM_STR);
            $result = $stmt->execute();
            if($result === true){
                $data['message'] = "Udało sie dodać.";
            }
            else{
                $data['error'] = "Nie udało się dodać.";
            }
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function deleteActorsForMovie($idMovie){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($idMovie)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        try{
            $query = '           
                DELETE FROM '.\Config\Database\DBConfig::$tableCast.' 
                WHERE '.\Config\Database\DBConfig::$tableCast.'.'.\Config\Database\DBConfig\Cast::$IdMovie.' = :idMovie
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovie' , $idMovie , PDO::PARAM_INT);
            $result = $stmt->execute();
            if($result === true){
                $data['message'] = "Udało sie usunąć.";
            }
            else{
                $data['error'] = "Nie udało się usunąć.";
            }
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

}