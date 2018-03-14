<?php
namespace Models;
use \PDO;
class Movie extends Model {

    public function getAll(){

        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $data['movies'] = array();
        try{
            $query = '
                    SELECT * FROM `'.\Config\Database\DBConfig::$tableMovie.'`
            ';
            $query .= 'ORDER BY `'.\Config\Database\DBConfig\Movie::$Title.'` ASC';
            $stmt = $this->pdo->query($query);
            $movies = $stmt->fetchAll();
            $stmt->closeCursor();

            if($movies && !empty($movies))
                $data['movies'] = $movies;
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getOne($id){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($id === null || empty($id)){
            $data['error'] = \Config\Database\DBErrorName::$nomatch;
            return $data;
        }
        $data = array();
        $data['movies'] = array();
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM `'.\Config\Database\DBConfig::$tableMovie.'` 
                WHERE  `'.\Config\Database\DBConfig\Movie::$IdMovie.'`=:id');
            $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
            $result = $stmt->execute();
            $movies = $stmt->fetchAll();
            $stmt->closeCursor();
            if($movies && !empty($movies))
                $data['movie'] = $movies[0];
            else
                $data['error'] = \Config\Database\DBErrorName::$nomatch;
        }
        catch(\PDOException $e){
            var_dump($e);
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getGenreForMovie($id){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($id === null || empty($id)){
            $data['error'] = \Config\Database\DBErrorName::$nomatch;
            return $data;
        }
        $data = array();
        $data['genres'] = array();
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM `'.\Config\Database\DBConfig::$tableMovie.'` 
                INNER JOIN `'.\Config\Database\DBConfig::$tableMovieGenre.'` 
                ON `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'` 
                 = `'.\Config\Database\DBConfig::$tableMovieGenre.'`.`'.\Config\Database\DBConfig\MovieGenre::$IdMovie.'`
                 INNER JOIN `'.\Config\Database\DBConfig::$tableGenre.'` 
                ON `'.\Config\Database\DBConfig::$tableGenre.'`.`'.\Config\Database\DBConfig\Genre::$IdGenre.'` 
                 = `'.\Config\Database\DBConfig::$tableMovieGenre.'`.`'.\Config\Database\DBConfig\MovieGenre::$IdGenre.'`
                WHERE  `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'`=:id');
            $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
            $result = $stmt->execute();
            $genres = $stmt->fetchAll();
            $stmt->closeCursor();
            if($genres && !empty($genres))
                $data['genres'] = $genres;
            else
                $data['error'] = \Config\Database\DBErrorName::$nomatch;
        }
        catch(\PDOException $e){
            var_dump($e);
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getActorForMovie($id){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($id === null || empty($id)){
            $data['error'] = \Config\Database\DBErrorName::$nomatch;
            return $data;
        }
        $data = array();
        $data['actors'] = array();
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM `'.\Config\Database\DBConfig::$tableMovie.'` 
                INNER JOIN `'.\Config\Database\DBConfig::$tableCast.'` 
                ON `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'` 
                 = `'.\Config\Database\DBConfig::$tableCast.'`.`'.\Config\Database\DBConfig\Cast::$IdMovie.'`
                INNER JOIN `'.\Config\Database\DBConfig::$tableActor.'` 
                ON `'.\Config\Database\DBConfig::$tableActor.'`.`'.\Config\Database\DBConfig\Actor::$IdActor.'` 
                 = `'.\Config\Database\DBConfig::$tableCast.'`.`'.\Config\Database\DBConfig\Cast::$IdActor.'`
                WHERE  `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'`=:id');
            $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
            $result = $stmt->execute();
            $actors = $stmt->fetchAll();
            $stmt->closeCursor();
            if($actors && !empty($actors))
                $data['actors'] = $actors;
            else
                $data['error'] = \Config\Database\DBErrorName::$nomatch;
        }
        catch(\PDOException $e){
            var_dump($e);
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getProductionForMovie($id){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($id === null || empty($id)){
            $data['error'] = \Config\Database\DBErrorName::$nomatch;
            return $data;
        }
        $data = array();
        $data['productions'] = array();
        try{
            $stmt = $this->pdo->prepare('SELECT * FROM `'.\Config\Database\DBConfig::$tableMovie.'` 
                INNER JOIN `'.\Config\Database\DBConfig::$tableMovieProduction.'` 
                ON `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'` 
                 = `'.\Config\Database\DBConfig::$tableMovieProduction.'`.`'.\Config\Database\DBConfig\MovieProduction::$IdMovie.'`
                INNER JOIN `'.\Config\Database\DBConfig::$tableProduction.'` 
                ON `'.\Config\Database\DBConfig::$tableProduction.'`.`'.\Config\Database\DBConfig\Production::$IdProduction.'` 
                 = `'.\Config\Database\DBConfig::$tableMovieProduction.'`.`'.\Config\Database\DBConfig\MovieProduction::$IdProduction.'`
                WHERE  `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'`=:id');
            $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
            $result = $stmt->execute();
            $productions = $stmt->fetchAll();
            $stmt->closeCursor();
            if($productions && !empty($productions))
                $data['productions'] = $productions;
            else
                $data['error'] = \Config\Database\DBErrorName::$nomatch;
        }
        catch(\PDOException $e){
            var_dump($e);
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }
}