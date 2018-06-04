<?php
namespace Models;
use \PDO;
class Type extends Model {

    public function getAll(){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $data['types'] = array();
        try{
            $query = '           
                SELECT*
                FROM '.\Config\Database\DBConfig::$tableType.' 
                ORDER BY '.\Config\Database\DBConfig::$tableType.'.'.\Config\Database\DBConfig\Type::$Type.' ASC
            ';
            $stmt = $this->pdo->prepare($query);
            $result = $stmt->execute();
            $types = $stmt->fetchAll();
            if(count($types) > 0)
                $data['types'] = $types;
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

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

    public function setTypeForMovie($idMovie, $idTypes){
        $data = array();
        if(is_null($idMovie) || is_null($idTypes)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        if(is_numeric($idTypes)){
            $type = $this->addTypeForMovie($idMovie, $idTypes);
            if(isset($type['error']))
                $data['error'] = $type['error'];
            if(isset($type['message']))
                $data['message'] = $type['message'];
        }
        elseif (is_array($idTypes)){
            foreach ($idTypes as $idType){
                $type = $this->addTypeForMovie($idMovie, $idType);
                if(isset($type['error'])) {
                    $data['error'] = $type['error'];
                    return $data;
                }
                if(isset($type['message']))
                    $data['message'] = $type['message'];
            }
        }
        return $data;
    }

}