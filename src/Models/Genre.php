<?php
namespace Models;
use \PDO;
class Genre extends Model {

    public function getAll(){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $data['genres'] = array();
        try{
            $query = '
                    SELECT * FROM `'.\Config\Database\DBConfig::$tableGenre.'`
            ';
            $query .= 'ORDER BY `'.\Config\Database\DBConfig\Genre::$GenreName.'` ASC';
            $stmt = $this->pdo->query($query);
            $genres = $stmt->fetchAll();
            $stmt->closeCursor();

            if($genres && !empty($genres))
                $data['genres'] = $genres;
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function addGenre($name){
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
                INSERT INTO '.\Config\Database\DBConfig::$tableGenre.' ('.\Config\Database\DBConfig\Genre::$GenreName.')
                VALUES (:nameGenre)
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':nameGenre' , $name , PDO::PARAM_STR);
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

    public function addGenreForMovie($idMovie, $idGenre){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($idMovie) || is_null($idGenre)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        try{
            $query = '           
                INSERT INTO '.\Config\Database\DBConfig::$tableMovieGenre.' ('.\Config\Database\DBConfig\MovieProduction::$IdMovie.',
                                                                                    '.\Config\Database\DBConfig\MovieGenre::$IdGenre.')
                VALUES (:idMovie, :idGenre)
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovie' , $idMovie , PDO::PARAM_INT);
            $stmt->bindValue(':idGenre' , $idGenre , PDO::PARAM_INT);
            $result = $stmt->execute();
            if($result === true){
                $data['message'] = "Udało sie dodać gatunek.";
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

    public function deleteGenresForMovie($idMovie){
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
                DELETE FROM '.\Config\Database\DBConfig::$tableMovieGenre.'
                WHERE '.\Config\Database\DBConfig::$tableMovieGenre.'.'.\Config\Database\DBConfig\MovieProduction::$IdMovie.' = :idMovie
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovie' , $idMovie , PDO::PARAM_INT);
            $result = $stmt->execute();
            if($result === true){
                $data['message'] = "Udało sie usunąć gatunek.";
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

    public function addGenresForMovie($idMovie, $idGenres){
        $data = array();
        if(is_null($idMovie) || is_null($idGenres)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $idGenres = array($idGenres);
        if(is_array($idGenres) && count($idGenres) > 1){
            foreach ($idGenres as $idGenre){
                if(!is_numeric($idGenre))
                    $idGenre = (int)$idGenre;
                $genreForMovie = $this->addGenreForMovie($idMovie, $idGenre);
                if (isset($genreForMovie['error'])){
                    $data['error'] = $genreForMovie['error'];
                    return $data;
                }
            }
        }
        else{
            //if(!is_numeric($idGenres))
                //$idGenres = (int)$idGenres;
            $genreForMovie = $this->addGenreForMovie($idMovie, $idGenres);
            if(isset($genreForMovie['error']))
                $data['error'] = $genreForMovie['error'];
        }
        return $data;
    }

}