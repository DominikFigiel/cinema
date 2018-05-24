<?php
namespace Models;
use \PDO;
use \Models\Genre;
use \Models\Production;
use \Models\Actor;
use \Models\Type;
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
            $stmt->execute();
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

    //-------------------- Admin functions ------------------------------------

    public function adminGetAll(){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $data['movies'] = array();
        try{
            $query = '
                    SELECT * 
                    FROM `'.\Config\Database\DBConfig::$tableMovie.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableMovieGenre.'`
                    ON `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'`
                    = `'.\Config\Database\DBConfig::$tableMovieGenre.'`.`'.\Config\Database\DBConfig\MovieGenre::$IdMovie.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableGenre.'`
                    ON `'.\Config\Database\DBConfig::$tableGenre.'`.`'.\Config\Database\DBConfig\Genre::$IdGenre.'`
                    = `'.\Config\Database\DBConfig::$tableMovieGenre.'`.`'.\Config\Database\DBConfig\MovieGenre::$IdGenre.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableMovieProduction.'`
                    ON `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'`
                    = `'.\Config\Database\DBConfig::$tableMovieProduction.'`.`'.\Config\Database\DBConfig\MovieProduction::$IdMovie.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableProduction.'`
                    ON `'.\Config\Database\DBConfig::$tableProduction.'`.`'.\Config\Database\DBConfig\Production::$IdProduction.'`
                    = `'.\Config\Database\DBConfig::$tableMovieProduction.'`.`'.\Config\Database\DBConfig\MovieProduction::$IdProduction.'`
            ';
            $query .= 'ORDER BY `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$Title.'` , 
                                `'.\Config\Database\DBConfig::$tableProduction.'`.`'.\Config\Database\DBConfig\Production::$Country.'`,
                                `'.\Config\Database\DBConfig::$tableGenre.'`.`'.\Config\Database\DBConfig\Genre::$GenreName.'` ASC';
            $stmt = $this->pdo->query($query);
            $movies = $stmt->fetchAll();
            $stmt->closeCursor();

            if($movies && !empty($movies)) {
                $data['movies'] = array();
                foreach ($movies as $movie){
                    if(!isset($data['movies'][$movie[\Config\Database\DBConfig\Movie::$IdMovie]]))
                        $data['movies'][$movie[\Config\Database\DBConfig\Movie::$IdMovie]] = $movie;
                    if(!isset( $data['movies'][$movie[\Config\Database\DBConfig\Movie::$IdMovie]]['genres'][$movie[\Config\Database\DBConfig\Genre::$GenreName]])) {
                        $data['movies'][$movie[\Config\Database\DBConfig\Movie::$IdMovie]]['genres'][$movie[\Config\Database\DBConfig\Genre::$GenreName]] = null;
                        $data['movies'][$movie[\Config\Database\DBConfig\Movie::$IdMovie]]['genres'][$movie[\Config\Database\DBConfig\Genre::$GenreName]] = count($data['movies'][$movie[\Config\Database\DBConfig\Movie::$IdMovie]]['genres']);
                    }
                    if(!isset($data['movies'][$movie[\Config\Database\DBConfig\Movie::$IdMovie]]['productions'][$movie[\Config\Database\DBConfig\Production::$Country]])) {
                        $data['movies'][$movie[\Config\Database\DBConfig\Movie::$IdMovie]]['productions'][$movie[\Config\Database\DBConfig\Production::$Country]] = null;
                        $data['movies'][$movie[\Config\Database\DBConfig\Movie::$IdMovie]]['productions'][$movie[\Config\Database\DBConfig\Production::$Country]] = count($data['movies'][$movie[\Config\Database\DBConfig\Movie::$IdMovie]]['productions']);
                    }
                }
            }
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function addMovie($title, $releaseDate, $age, $durationTime, $description, $idGenres, $idProductions, $cover = null){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($title) || is_null($releaseDate) || is_null($age) || is_null($durationTime)
            || is_null($description) || is_null($idGenres) || is_null($idProductions)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        $movie = $this->addOnlyMovie($title, $releaseDate, $age, $durationTime, $description, $cover);
        if(isset($movie['error'])) {
            $data['error'] = $movie['error'];
            return $data;
        }
        if(isset($movie['message'])) {
            $data['message'] = $movie['message'];
        }

        if(isset($movie['idMovie'])) {
            $data['idMovie'] = $movie['idMovie'];
            $productions = new \Models\Production();
            $productions = $productions->addProductionsForMovie($movie['idMovie'] , $idProductions);
            if (isset($productions['error'])) {
                $data['error'] = $productions['error'];
                return $data;
            }
            if(isset($productions['message'])) {
                $data['message'] = $productions['message'];
            }

            $genres = new \Models\Genre();
            $genres = $genres->addGenresForMovie($movie['idMovie'], $idGenres);
            if (isset($genres['error'])) {
                $data['error'] = $genres['error'];
                return $data;
            }
            if(isset($genres['message'])) {
                $data['message'] = $genres['message'];
            }
        }

        return $data;
    }

    public function deleteMovie($idMovie){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($idMovie)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();

        $type = new \Models\Type();
        $type = $type->deleteTypesForMovie($idMovie);
        if(isset($type['error'])) {
            $data['error'] = $type['error'];
            return $data;
        }
        if(isset($type['messages']))
            $data['messages'] = $type['messages'];

        $actor = new \Models\Actor();
        $actor = $actor->deleteActorsForMovie($idMovie);
        if(isset($actor['error'])) {
            $data['error'] = $actor['error'];
            return $data;
        }
        if(isset($actor['messages']))
            $data['messages'] = $actor['messages'];

        $production = new \Models\Production();
        $production = $production->deleteProductionsForMovie($idMovie);
        if(isset($production['error'])) {
            $data['error'] = $production['error'];
            return $data;
        }
        if(isset($production['messages']))
            $data['messages'] = $production['messages'];

        $genre = new \Models\Genre();
        $genre = $genre->deleteGenresForMovie($idMovie);
        if(isset($genre['error'])) {
            $data['error'] = $genre['error'];
            return $data;
        }
        if(isset($genre['messages']))
            $data['messages'] = $genre['messages'];

        $movie = $this->deleteOnlyMovie($idMovie);
        if(isset($movie['error'])) {
            $data['error'] = $movie['error'];
            return $data;
        }
        if(isset($movie['messages']))
            $data['messages'] = $movie['messages'];

        $deleteCover = $this->deleteCoverForMovie(((string)$idMovie).".jpg");
        if(isset($deleteCover['message'])){
            $data['message'] = $deleteCover['message'];
        }
        if(isset($deleteCover['error']))
            $data['error'] = $deleteCover['error'];

        return $data;
    }

    private function addOnlyMovie($title, $releaseDate, $age, $durationTime, $description, $cover = null){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($title) || is_null($releaseDate) || is_null($age) || is_null($durationTime)
            || is_null($description)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        try{
            $query = '           
                INSERT INTO '.\Config\Database\DBConfig::$tableMovie.' ('.\Config\Database\DBConfig\Movie::$Title.',
                                                                        '.\Config\Database\DBConfig\Movie::$ReleaseDate.',
                                                                        '.\Config\Database\DBConfig\Movie::$Age.',
                                                                        '.\Config\Database\DBConfig\Movie::$DurationTime.',
                                                                        '.\Config\Database\DBConfig\Movie::$Cover.',
                                                                        '.\Config\Database\DBConfig\Movie::$Description.')
                VALUES (:title, :releaseDate, :age, :durationTime, :cover, :description)
            ';

            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':title' , $title , PDO::PARAM_STR);
            $stmt->bindValue(':releaseDate' , $releaseDate , PDO::PARAM_STR);
            $stmt->bindValue(':age' , $age , PDO::PARAM_INT);
            $stmt->bindValue(':durationTime' , $durationTime , PDO::PARAM_INT);
            $stmt->bindValue(':cover' , 'Cover' , PDO::PARAM_STR);
            $stmt->bindValue(':description' , $description , PDO::PARAM_STR);
            $result = $stmt->execute();
            if($result === true){
                $data['message'] = "Udało sie dodać film.";
                $data['idMovie'] = $this->pdo->lastInsertId();

                $imagePath = "resources/images/covers/";
                if($cover != null) {
                    $info = pathinfo($cover['imageName']);
                    $ext = strtolower($info['extension']);
                    if (is_uploaded_file($cover['imageTemp'])) {
                        if (move_uploaded_file($cover['imageTemp'], $imagePath . ((string)$data['idMovie']) . "." . $ext)) {
                            //$data['message'] = "Sussecfully uploaded your image.";
                            $this->updateCoverNameOnMovie($data['idMovie'], $data['idMovie']);
                        } else {
                            //$data['message'] = "Failed to move your image.";
                        }
                    } else {
                        //$data['message'] = "Failed to upload your image.";
                    }
                }
                else if($cover == null && file_exists($imagePath."tmp.jpg")){
                    rename($imagePath."tmp.jpg", $imagePath.$data['idMovie'].".jpg");
                    $this->updateCoverNameOnMovie($data['idMovie'], $data['idMovie']);
                }
            }
            else{
                $data['error'] = "Nie udało się dodać.";
            }
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query." TUTAJ 3";
        }
        return $data;
    }

    private function updateCoverNameOnMovie($idMovie, $coverName){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($idMovie) || is_null($coverName)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        try {
            $query = '           
                UPDATE '.\Config\Database\DBConfig::$tableMovie.'
                SET '.\Config\Database\DBConfig\Movie::$Cover.' = :coverName
                WHERE '.\Config\Database\DBConfig::$tableMovie.'.'.\Config\Database\DBConfig\Movie::$IdMovie.' = :idMovie
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovie' , $idMovie , PDO::PARAM_INT);
            $stmt->bindValue(':coverName' , $coverName , PDO::PARAM_STR);
            $result = $stmt->execute();
            if($result === true) {
                $data['message'] = "Udało sie zaktualizować nazwę okladki.";
            }
            else{
                $data['error'] = "Nie udało się zaktualizować nazwy okladki.";
            }
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query." TUTAJ 3";
        }
        return $data;
    }

    private function deleteOnlyMovie($idMovie){
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
                DELETE FROM '.\Config\Database\DBConfig::$tableMovie.' 
                WHERE '.\Config\Database\DBConfig::$tableMovie.'.'.\Config\Database\DBConfig\Movie::$IdMovie.' = :idMovie
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovie' , $idMovie , PDO::PARAM_INT);
            $result = $stmt->execute();
            if($result === true){
                $data['message'] = "Udało sie usunąć.";
                $data['idMovie'] =$this->pdo->lastInsertId();
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

    private function deleteCoverForMovie($name){
        if(is_null($name)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        $imagePath = "resources/images/covers/";
        if(file_exists($imagePath."".$name)) {
            if (unlink($imagePath . "" . $name))
                $data['message'] = "Udało się usunąć okladke.";
            else
                $data['error'] = "Nie udalo sie usunac okladaki.";
        }
        else
            $data['error'] = "Nie udalo sie usunac okladaki.";
        return $data;
    }
}