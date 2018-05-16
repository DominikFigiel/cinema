<?php
namespace Models;
use \PDO;
class Type extends Model {

    public function deleteTypesForMovie($idMovie){
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
                DELETE FROM '.\Config\Database\DBConfig::$tableMovieType.' 
                WHERE '.\Config\Database\DBConfig::$tableMovieType.'.'.\Config\Database\DBConfig\MovieType::$IdMovie.' = :idMovie
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