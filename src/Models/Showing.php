<?php
namespace Models;
use \PDO;
class Showing extends Model {

    public function getAll(){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $showings = $this->getAllShowing();
        if(isset($showings['error'])){
            $data['error'] = $showings['error'];
            return $data;
        }
        if(isset($showings['showings']))
            $data['showings'] = $showings['showings'];
        else{
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        /*foreach ($data['showings'] as $showing){
            $types = $this->getTypesForShowing($showing[\Config\Database\DBConfig\Showing::$IdShowing]);
            if(isset($types['error'])){
                $data['error'] = $types['error'];
                return $data;
            }
            if(!isset($types['types'])){
                $data['error'] = \Config\Database\DBErrorName::$empty;
                return $data;
            }
            $data['showings'][$showing[\Config\Database\DBConfig\Showing::$IdShowing]]['types'] = $types['types'];
        }*/
        return $data;
    }

    public function getTypesForShowing($id){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($id === null){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        $data['types'] = array();
        try{
            $query = '
                    SELECT * 
                    FROM `'.\Config\Database\DBConfig::$tableShowing.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableMovieType.'`
                    ON `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdMovieType.'`
                    = `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdMovieType.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableType.'`
                    ON `'.\Config\Database\DBConfig::$tableType.'`.`'.\Config\Database\DBConfig\Type::$IdType.'`
                    = `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdType.'`
                    WHERE `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdShowing.'` = :id
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
            $stmt->execute();
            $types = $stmt->fetchAll();
            $stmt->closeCursor();

            if($types && !empty($types))
                $data['types'] = $types;
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getAllShowing(){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $data['showings'] = array();
        try{
            $query = '
                    SELECT * 
                    FROM `'.\Config\Database\DBConfig::$tableShowing.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableLanguageVersion.'`
                    ON `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdLanguageVersion.'`
                    = `'.\Config\Database\DBConfig::$tableLanguageVersion.'`.`'.\Config\Database\DBConfig\LanguageVersion::$IdLanguageVersion.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableMovieType.'`
                    ON `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdMovieType.'`
                    = `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdMovieType.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableType.'`
                    ON `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdType.'`
                    = `'.\Config\Database\DBConfig::$tableType.'`.`'.\Config\Database\DBConfig\Type::$IdType.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableMovie.'`
                    ON `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'`
                    = `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdMovie.'`
            ';
            $stmt = $this->pdo->query($query);
            $showings = $stmt->fetchAll();
            $stmt->closeCursor();
            $data['showings'] = array();
            if($showings && !empty($showings)) {
                //$data['showings'] = $showings;
                foreach ($showings as $showing){
                    $data['showings'][$showing[\Config\Database\DBConfig\Showing::$IdShowing]] = $showing;
                }
            }
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

}