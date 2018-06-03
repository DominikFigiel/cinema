<?php
namespace Models;
use \PDO;
use \Models\Reservation;
use \Models\CinemaHallPlaces;
class Showing extends Model {

    public function getAll($date = null , $type = null , $admin = false, $cinemaHall = null){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($date == null)
            $date = date('Y-m-d H:i:s', time());
        if($date != null){
            //Jeśli data nie jest datą, tylko liczbą, to pobieramy dzisiejszą datę i dodajemy liczbę jako dni
            if(is_numeric($date)){
                if(count($date) > 5 && $admin == false)
                    $date = 5;
                elseif (count($date) < 0)
                    $date = 0;
                $date = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s', time()). ' + '.$date.' days'));
            }

            //Ustawienie pierwszej daty
            $date1 = date_create($date);
            date_time_set($date1, 00, 00, 00);
            $date1 = date_format($date1 , 'Y-m-d H:i:s');

            //Ustawienie drugiej daty
            $date2 = date_create($date);
            date_time_set($date2, 23, 59 ,59);
            $date2 = date_format($date2 , 'Y-m-d H:i:s');
        }
        //$type = '3D';
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
                    INNER JOIN `'.\Config\Database\DBConfig::$tableCinemaHall.'`
                    ON `'.\Config\Database\DBConfig::$tableCinemaHall.'`.`'.\Config\Database\DBConfig\CinemaHall::$IdCinemaHall.'`
                    = `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdCinemaHall.'`
            ';
            if($type != null || $date != null || $cinemaHall != null) {
                if($type != null && $date != null && $cinemaHall != null){
                    $query .= '
                        WHERE `' . \Config\Database\DBConfig::$tableType . '`.`' . \Config\Database\DBConfig\Type::$Type . '` = :type
                        AND `'.\Config\Database\DBConfig::$tableCinemaHall.'`.`'.\Config\Database\DBConfig\CinemaHall::$Name.'` = :cinemaHall
                        AND `' . \Config\Database\DBConfig::$tableShowing . '`.`' . \Config\Database\DBConfig\Showing::$DateTime . '` 
                        BETWEEN :date1 AND :date2
                    ';
                }
                else if($type != null && $cinemaHall != null){
                    $query .= '
                        WHERE `' . \Config\Database\DBConfig::$tableType . '`.`' . \Config\Database\DBConfig\Type::$Type . '` = :type
                        AND `'.\Config\Database\DBConfig::$tableCinemaHall.'`.`'.\Config\Database\DBConfig\CinemaHall::$Name.'` = :cinemaHall
                    ';
                }
                else if($date != null && $cinemaHall != null){
                    $query .= '
                        WHERE `'.\Config\Database\DBConfig::$tableCinemaHall.'`.`'.\Config\Database\DBConfig\CinemaHall::$Name.'` = :cinemaHall
                        AND `' . \Config\Database\DBConfig::$tableShowing . '`.`' . \Config\Database\DBConfig\Showing::$DateTime . '` 
                        BETWEEN :date1 AND :date2
                    ';
                }
                else if ($type != null && $date != null) {
                    $query .= '
                        WHERE `' . \Config\Database\DBConfig::$tableType . '`.`' . \Config\Database\DBConfig\Type::$Type . '` = :type
                        AND `' . \Config\Database\DBConfig::$tableShowing . '`.`' . \Config\Database\DBConfig\Showing::$DateTime . '` 
                        BETWEEN :date1 AND :date2
                    ';
                }
                else if ($date != null){
                    $query .= '
                        WHERE `' . \Config\Database\DBConfig::$tableShowing . '`.`' . \Config\Database\DBConfig\Showing::$DateTime . '` 
                        BETWEEN :date1 AND :date2
                    ';
                }
                else if($type != null){
                    $query .= '
                        WHERE `' . \Config\Database\DBConfig::$tableType . '`.`' . \Config\Database\DBConfig\Type::$Type . '` = :type
                    ';
                }
                else if($cinemaHall != null){
                    $query .= '
                        WHERE `'.\Config\Database\DBConfig::$tableCinemaHall.'`.`'.\Config\Database\DBConfig\CinemaHall::$Name.'` = :cinemaHall
                    ';
                }
            }

            $query .= "ORDER BY `".\Config\Database\DBConfig::$tableMovie."`.`".\Config\Database\DBConfig\Movie::$Title."` ,
                                `".\Config\Database\DBConfig::$tableType."`.`".\Config\Database\DBConfig\Type::$Type."` ,
                                `".\Config\Database\DBConfig::$tableShowing."`.`".\Config\Database\DBConfig\Showing::$DateTime."` ASC";
            $stmt = $this->pdo->prepare($query);
            if($type != null){
                $stmt->bindValue(':type' , $type , PDO::PARAM_STR);
            }
            if($date !== null){
                $stmt->bindValue(':date1' , $date1 , PDO::PARAM_STR);
                $stmt->bindValue(':date2' , $date2 , PDO::PARAM_STR);
            }
            if($cinemaHall != null)
                $stmt->bindValue(':cinemaHall' , $cinemaHall , PDO::PARAM_STR);
            $stmt->execute();
            $showings = $stmt->fetchAll();
            $stmt->closeCursor();

            $isBusy = new CinemaHallPlaces();

            $data['showings'] = array();
            if($showings && !empty($showings)) {
                foreach ($showings as $showing){
                    if(!isset($data['showings'][$showing[\Config\Database\DBConfig\Movie::$IdMovie]][$showing[\Config\Database\DBConfig\Type::$Type]][$showing[\Config\Database\DBConfig\Showing::$Dubbing]]))
                        $data['showings'][$showing[\Config\Database\DBConfig\Movie::$IdMovie]][$showing[\Config\Database\DBConfig\Type::$Type]][$showing[\Config\Database\DBConfig\Showing::$Dubbing]] = $showing;
                    $data['showings'][$showing[\Config\Database\DBConfig\Movie::$IdMovie]][$showing[\Config\Database\DBConfig\Type::$Type]][$showing[\Config\Database\DBConfig\Showing::$Dubbing]]['hours'][$showing[\Config\Database\DBConfig\Showing::$IdShowing]]['hour'] = $showing[\Config\Database\DBConfig\Showing::$DateTime];
                    $boolean = $isBusy->isAllBusy($showing[\Config\Database\DBConfig\Showing::$IdShowing]);
                    if(!isset($boolean['error']))
                        $data['showings'][$showing[\Config\Database\DBConfig\Movie::$IdMovie]][$showing[\Config\Database\DBConfig\Type::$Type]][$showing[\Config\Database\DBConfig\Showing::$Dubbing]]['hours'][$showing[\Config\Database\DBConfig\Showing::$IdShowing]]['busy'] = $boolean['isAllBusy'];
                    else{
                        $data['showings'][$showing[\Config\Database\DBConfig\Movie::$IdMovie]][$showing[\Config\Database\DBConfig\Type::$Type]][$showing[\Config\Database\DBConfig\Showing::$Dubbing]]['hours'][$showing[\Config\Database\DBConfig\Showing::$IdShowing]]['busy'] = null;
                    }
                }
            }
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getAllAdmin($date = null , $type = null , $admin = false, $cinemaHall = null){
        $data = array();
        $showingsAll = $this->getAll($date , $type , $admin, $cinemaHall);
        if(isset($showingsAll['error']))
            $data['error'] = $showingsAll['error'];
        if(isset($showingsAll['message']))
            $data['message'] = $showingsAll['message'];
        $data['showings'] = $showingsAll['showings'];

        /*$showingsReserved = new Reservation();
        $showingsReserved = $showingsReserved->getReservationForShowing();
        if(isset($showingsReserved['error']))
            $data['error'] = $showingsReserved['error'];
        if(isset($showingsReserved['message']))
            $data['message'] = $showingsReserved['message'];
        if(isset($showingsReserved['reservationForShowing'])) {
            $showingsReserved = $showingsReserved['reservationForShowing'];
            foreach ($data['showings'] as $showing){
                $tmpShowing = $data['showings'][$showing[\Config\Database\DBConfig\Movie::$IdMovie]][$showing[\Config\Database\DBConfig\Type::$Type]][$showing[\Config\Database\DBConfig\Showing::$Dubbing]];
                foreach ($showingsReserved as $showingReserved){
                    if((int)$tmpShowing[\Config\Database\DBConfig\Showing::$IdShowing] == (int)$showingReserved[\Config\Database\DBConfig\Reservation::$IdShowing]){
                        $showing[$showing[\Config\Database\DBConfig\Movie::$IdMovie]][$showing[\Config\Database\DBConfig\Type::$Type]][$showing[\Config\Database\DBConfig\Showing::$Dubbing]]['reservation'] = true;
                    }
                }
            }
        }*/
        return $data;
    }

    public function getOne($id){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        if(is_null($id)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data['showing'] = array();
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
                    INNER JOIN `'.\Config\Database\DBConfig::$tableCinemaHall.'`
                    ON `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdCinemaHall.'`
                    = `'.\Config\Database\DBConfig::$tableCinemaHall.'`.`'.\Config\Database\DBConfig\CinemaHall::$IdCinemaHall.'`
                    WHERE `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdShowing.'` = :id
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id' , $id , PDO::PARAM_INT);
            $stmt->execute();
            $showing = $stmt->fetchAll();
            $stmt->closeCursor();
            if(count($showing) > 0)
                $data['showing'] = $showing[0];
            else
                $data['error'] = "Nie ma seansu o zadanym ID.";
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function freeHoursForAdd($date , $idCinemaHall, $idShowing){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        if(is_null($idShowing) || is_null($idCinemaHall)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        if(is_null($date))
            $date = date('Y-m-d h:i:s', time());
        if($date !== null){
            //Jeśli data nie jest datą, tylko liczbą, to pobieramy dzisiejszą datę i dodajemy liczbę jako dni
            if(is_numeric($date)){
                if(count($date) < 0)
                    $date = 0;
                $date = date('Y-m-d h:i:s', strtotime( date('Y-m-d h:i:s', time()). ' + '.$date.' days'));
            }

            //Ustawienie pierwszej daty
            $date1 = date_create($date);
            date_time_set($date1, 00, 00, 00, 00);
            $date1 = date_format($date1 , 'Y-m-d H:i:s');

            //Ustawienie drugiej daty
            $date2 = date_create($date);
            date_time_set($date2, 23, 59 ,59, 59);
            $date2 = date_format($date2 , 'Y-m-d H:i:s');
        }
        $data['hours'] = array();
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
                    INNER JOIN `'.\Config\Database\DBConfig::$tableCinemaHall.'`
                    ON `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdCinemaHall.'`
                    = `'.\Config\Database\DBConfig::$tableCinemaHall.'`.`'.\Config\Database\DBConfig\CinemaHall::$IdCinemaHall.'`
                    WHERE `'.\Config\Database\DBConfig::$tableCinemaHall.'`.`'.\Config\Database\DBConfig\CinemaHall::$IdCinemaHall.'` = :idCinemaHall
                    AND `' . \Config\Database\DBConfig::$tableShowing . '`.`' . \Config\Database\DBConfig\Showing::$DateTime . '` BETWEEN :date1 AND :date2
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idCinemaHall' , $idCinemaHall , PDO::PARAM_INT);
            $stmt->bindValue(':date1' , $date1 , PDO::PARAM_STR);
            $stmt->bindValue(':date2' , $date2 , PDO::PARAM_STR);
            $stmt->execute();
            $hours = $stmt->fetchAll();
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getCinemaHalls(){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $data['cinemaHalls'] = array();
        try{
            $query = '
                    SELECT * 
                    FROM `'.\Config\Database\DBConfig::$tableCinemaHall.'`
                    ORDER BY `'.\Config\Database\DBConfig::$tableCinemaHall.'`.`'.\Config\Database\DBConfig\CinemaHall::$Name.'` ASC
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $cinemaHalls = $stmt->fetchAll();
            $data['cinemaHalls'] = $cinemaHalls;
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getMovies(){
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
                    ORDER BY `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$Title.'` ASC
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $movies = $stmt->fetchAll();
            $data['movies'] = $movies;
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getMoviesForAdd(){
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
                    WHERE EXISTS (SELECT *
                                  FROM `'.\Config\Database\DBConfig::$tableMovieType.'`
                                  WHERE `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdMovie.'` = 
                                            `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'`)
                    ORDER BY `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$Title.'` ASC
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $movies = $stmt->fetchAll();
            $data['movies'] = $movies;
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getType(){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $data['types'] = array();
        try{
            $query = '
                    SELECT * 
                    FROM `'.\Config\Database\DBConfig::$tableType.'`
                    
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $types = $stmt->fetchAll();
            $data['types'] = $types;
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function deleteShowing($idShowing){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($idShowing === null){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        try{
            $query = '
                DELETE FROM `'.\Config\Database\DBConfig::$tableShowing.'`
                WHERE `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdShowing.'` = :idShowing
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idShowing' , $idShowing , PDO::PARAM_INT);
            $result = $stmt->execute();
            if($result == true){
                $data['message'] = "Udało się usunąć.";
            }
            else
                $data['error'] = "Nie udało się usunąć.";
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getTypesForMovie($idMovie){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($idMovie === null){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        $data['types'] = array();
        try{
            $query = '
                    SELECT * 
                    FROM `'.\Config\Database\DBConfig::$tableMovieType.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableMovie.'`
                    ON `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdMovie.'`
                    = `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableType.'`
                    ON `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdType.'`
                    = `'.\Config\Database\DBConfig::$tableType.'`.`'.\Config\Database\DBConfig\Type::$IdType.'`
                    WHERE `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'` = :idMovie
                    
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovie' , $idMovie , PDO::PARAM_INT);
            $stmt->execute();
            $types = $stmt->fetchAll();
            $data['types'] = $types;
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function checkContainsTypeForMovie($idMovie, $idType){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($idMovie === null || $idType === null){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        try{
            $query = '
                    SELECT * 
                    FROM `'.\Config\Database\DBConfig::$tableMovieType.'`
                    WHERE `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdMovie.'` = :idMovie
                        AND `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdType.'` = :idType
                    
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovie' , $idMovie , PDO::PARAM_INT);
            $stmt->bindValue(':idType' , $idType , PDO::PARAM_INT);
            $stmt->execute();
            $types = $stmt->fetchAll();
            if(count($types) > 0)
                $data['check'] = true;
            else
                $data['check'] = false;
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getIdMovieType($idMovie, $idType){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($idMovie === null || $idType === null){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        try{
            $query = '
                    SELECT * 
                    FROM `'.\Config\Database\DBConfig::$tableMovieType.'`
                    WHERE `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdMovie.'` = :idMovie
                        AND `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdType.'` = :idType
                    
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovie' , $idMovie , PDO::PARAM_INT);
            $stmt->bindValue(':idType' , $idType , PDO::PARAM_INT);
            $stmt->execute();
            $idMovieType = $stmt->fetchAll();
            if(count($idMovieType) > 0)
                $data['idMovieType'] = $idMovieType[0][\Config\Database\DBConfig\MovieType::$IdMovieType];
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function addShowing($idMovieType, $idCinemaHall, $dubbing, $dateTime, $idLanguageVersion = 1){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($idMovieType === null || $idCinemaHall === null || $dateTime === null || $dubbing === null || $idLanguageVersion === null){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        try{
            $query = '           
                INSERT INTO '.\Config\Database\DBConfig::$tableShowing.' ('.\Config\Database\DBConfig\Showing::$IdMovieType.', 
                                                                           '.\Config\Database\DBConfig\Showing::$IdCinemaHall.', 
                                                                            '.\Config\Database\DBConfig\Showing::$DateTime.', 
                                                                            '.\Config\Database\DBConfig\Showing::$Dubbing.',
                                                                            '.\Config\Database\DBConfig\Showing::$IdLanguageVersion.')
                VALUES (:idMovieType, :idCinemaHall, :dateTime, :dubbing, :idLanguageVersion)
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovieType' , $idMovieType , PDO::PARAM_INT);
            $stmt->bindValue(':idCinemaHall' , $idCinemaHall , PDO::PARAM_INT);
            $stmt->bindValue(':dateTime' , $dateTime , PDO::PARAM_STR);
            $stmt->bindValue(':dubbing' , $dubbing , PDO::PARAM_BOOL);
            $stmt->bindValue(':idLanguageVersion' , $idLanguageVersion , PDO::PARAM_INT);
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

    public function editShowing($idShowing, $idMovieType, $idCinemaHall, $dateTime, $dubbing, $idLanguageVersion = 1){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($idShowing === null || $idMovieType === null || $idCinemaHall === null || $dateTime === null || $dubbing === null || $idLanguageVersion === null){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        try{
            $query = '           
                UPDATE `'.\Config\Database\DBConfig::$tableShowing.'`
                SET
                    `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdMovieType.'` = :idMovieType,
                    `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdCinemaHall.'` = :idCinemaHall,
                    `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$DateTime.'` = :dateTime,
                    `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$Dubbing.'` = :dubbing,
                    `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdLanguageVersion.'` = :idLanguageVersion
                WHERE `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdShowing.'` = :idShowing
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idMovieType' , $idMovieType , PDO::PARAM_INT);
            $stmt->bindValue(':idCinemaHall' , $idCinemaHall , PDO::PARAM_INT);
            $stmt->bindValue(':dateTime' , $dateTime , PDO::PARAM_STR);
            $stmt->bindValue(':dubbing' , $dubbing , PDO::PARAM_BOOL);
            $stmt->bindValue(':idLanguageVersion' , $idLanguageVersion , PDO::PARAM_INT);
            $stmt->bindValue(':idShowing' , $idShowing , PDO::PARAM_INT);
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
            $data['error'] = \Config\Database\DBErrorName::$query."\n".$query."\n".$idMovieType;
        }
        return $data;
    }

}