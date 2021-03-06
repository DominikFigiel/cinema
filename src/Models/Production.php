<?php
namespace Models;
use \PDO;
class Production extends Model {
    public function getAll(){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $data['productions'] = array();
        try{
            $query = '
                    SELECT * FROM `'.\Config\Database\DBConfig::$tableProduction.'`
            ';
            $query .= 'ORDER BY `'.\Config\Database\DBConfig\Production::$Country.'` ASC';
            $stmt = $this->pdo->query($query);
            $productions = $stmt->fetchAll();
            $stmt->closeCursor();
            if($productions && !empty($productions))
                $data['productions'] = $productions;
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }
    public function addProduction($name){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($name)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        try{
            $query = '           
                INSERT INTO '.\Config\Database\DBConfig::$tableProduction.' ('.\Config\Database\DBConfig\Production::$Country.')
                VALUES (:country)
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':country' , $name , PDO::PARAM_STR);
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
    public function addProductionForMovie($idMovie, $idProduction){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($idMovie) || is_null($idProduction)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        //var_dump($idProduction);
        //if(!is_numeric($idProduction))
            //$idProduction = intval($idProduction);
        try{
            $query = '           
                INSERT INTO '.\Config\Database\DBConfig::$tableMovieProduction.' ('.\Config\Database\DBConfig\MovieProduction::$IdMovie.',
                                                                                    '.\Config\Database\DBConfig\MovieProduction::$IdProduction.')
                VALUES (:idMovie, :idProduction)
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovie' , $idMovie , PDO::PARAM_INT);
            $stmt->bindValue(':idProduction' , $idProduction , PDO::PARAM_STR);
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
    public function deleteProductionsForMovie($idMovie){
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
                DELETE FROM '.\Config\Database\DBConfig::$tableMovieProduction.' 
                WHERE '.\Config\Database\DBConfig::$tableMovieProduction.'.'.\Config\Database\DBConfig\MovieProduction::$IdMovie.' = :idMovie
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
    public function addProductionsForMovie($idMovie, $idProductions){
        $data = array();
        if(is_null($idMovie) || is_null($idProductions)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        if(is_array($idProductions)){
            foreach ($idProductions as $idProduction){
                $productionForMovie = $this->addProductionForMovie($idMovie, $idProduction);
                if (isset($productionForMovie['error'])) {
                    $data['error'] = $productionForMovie['error'];
                    return $data;
                }
            }
        }
        else{
            $productionForMovie = $this->addProductionForMovie($idMovie, $idProductions);
            if(isset($productionForMovie['error']))
                $data['error'] = $productionForMovie['error'];
        }
        return $data;
    }
    public function editProductionForMovie($idMovieProduction, $idProduction){
        $data = array();
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($idMovieProduction) || is_null($idProduction)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        try{
            $query = '           
                UPDATE '.\Config\Database\DBConfig::$tableMovieProduction.' 
                SET '.\Config\Database\DBConfig\MovieProduction::$IdProduction.' = :idProduction
                WHERE '.\Config\Database\DBConfig::$tableMovieProduction.'.'.\Config\Database\DBConfig\MovieProduction::$IdMovieProduction.' = :idMovieProduction
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovieProduction' , $idMovieProduction , PDO::PARAM_INT);
            $stmt->bindValue(':idProduction' , $idProduction , PDO::PARAM_INT);
            $result = $stmt->execute();
            if($result === true){
                $data['message'] = "Udało sie edytować.";
            }
            else{
                $data['error'] = "Nie udało się edytować.";
            }
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }
    public function editProductionsForMovie($idMovie, $idProductions){
        $data = array();
        if(is_null($idMovie) || is_null($idProductions)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $ids = $this->getProductionsMovieIdForMovieId($idMovie);
        if (is_array($idProductions)){
            if (count($idProductions) <= count($ids)){
                foreach ($ids as $id){
                    $this -> editProductionForMovie($id, $idProductions);
                }
            }
        }
        elseif (is_numeric($idProductions)){
        }
        return $data;
    }
    private function getProductionsMovieIdForMovieId($idMovie){
        $data = array();
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($idMovie)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        try{
            $query = '           
                SELECT '.\Config\Database\DBConfig::$tableMovieProduction.'.'.\Config\Database\DBConfig\MovieProduction::$IdMovieProduction.' 
                WHERE '.\Config\Database\DBConfig::$tableMovieProduction.'.'.\Config\Database\DBConfig\MovieProduction::$IdMovie.' = :idMovie
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovie' , $idMovie , PDO::PARAM_INT);
            $result = $stmt->execute();
            $ids =$stmt->fetchAll();
            $data['ids'] = array();
            foreach ($ids as $id){
                $data['ids'][] = $id[\Config\Database\DBConfig\MovieProduction::$IdProduction];
            }
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }
}