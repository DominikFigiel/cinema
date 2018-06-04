<?php
namespace Models;
use \PDO;
class Reservation extends Model {

    public function reservation($idShowing, $fistName, $lastName, $email, $mobilePhone, $places){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        if(is_null($idShowing) || is_null($fistName) || is_null($lastName) || is_null($email) || is_null($mobilePhone) || is_null($places)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }

        $places = explode(",",$places);

        $user = $this->userAdd($fistName, $lastName, $email, $mobilePhone);
        if(isset($user['error']))
            $data['error'] = $user['error'];

        $reservation = $this->reservationAdd($user['idUser'] , $idShowing);
        if(isset($reservation['error']))
            $data['error'] = $reservation['error'];

        if(is_array($places)){
            foreach ($places as $place){
                $reservationPlace = $this->reservationPlaceAdd($reservation['idReservation'], $place);
                if(isset($reservationPlace['error']))
                    $data['error'] = $data['error'] + " " + $reservationPlace['error'];
            }
        }
        else {
            $reservationPlace = $this->reservationPlaceAdd($reservation['idReservation'], $places);
            if (isset($reservationPlace['error']))
                $data['error'] = $reservationPlace['error'];
        }

        return $data;
    }

    private function userAdd($fistName, $lastName, $email, $mobilePhone){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        if(is_null($fistName) || is_null($lastName) || is_null($email) || is_null($mobilePhone)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        try {
            $query = '
                INSERT INTO `'.\Config\Database\DBConfig::$tableUser.'` 
                (`'.\Config\Database\DBConfig\User::$FirstName.'`,`'.\Config\Database\DBConfig\User::$LastName.'`, 
                `'.\Config\Database\DBConfig\User::$Email.'`, `'.\Config\Database\DBConfig\User::$MobilePhone.'`)
                VALUES (:firstName, :lastName, :email, :mobilePhone)
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':firstName', $fistName, PDO::PARAM_STR);
            $stmt->bindValue(':lastName', $lastName, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':mobilePhone', $mobilePhone, PDO::PARAM_STR);
            $result = $stmt->execute();
            $stmt->closeCursor();
            if(!$result)
                $data['error'] = "Nie udało się dodać.";
            else
                $data['idUser'] = $this->pdo->lastInsertId();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    private function reservationAdd($idUser, $idShowing){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        if(is_null($idUser) || is_null($idShowing)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        try {
            $query = '
                INSERT INTO `'.\Config\Database\DBConfig::$tableReservation.'` 
                (`'.\Config\Database\DBConfig\Reservation::$IdUser.'`,`'.\Config\Database\DBConfig\Reservation::$IdShowing.'`)
                VALUES (:idUser, :idShowing)
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idUser', $idUser, PDO::PARAM_INT);
            $stmt->bindValue(':idShowing', $idShowing, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            if(!$result)
                $data['error'] = "Nie udało się dodać.";
            else
                $data['idReservation'] = $this->pdo->lastInsertId();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    private function reservationPlaceAdd($idReservation, $idPlace){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        if(is_null($idReservation) || is_null($idPlace)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        try {
            $query = '
                INSERT INTO `'.\Config\Database\DBConfig::$tableReservationPlace.'` 
                (`'.\Config\Database\DBConfig\ReservationPlace::$IdReservation.'`,
                `'.\Config\Database\DBConfig\ReservationPlace::$IdPlace.'`)
                VALUES (:idReservation, :idPlace)
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idReservation', $idReservation, PDO::PARAM_INT);
            $stmt->bindValue(':idPlace', $idPlace, PDO::PARAM_INT);
            $result = $stmt->execute();
            $stmt->closeCursor();
            if(!$result)
                $data['error'] = "Nie udało się dodać.";
            else
                $data['idReservationPlace'] = $this->pdo->lastInsertId();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getReservationForShowing(){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $data['reservationForShowing'] = array();
        try {
            $query = '
                SELECT * 
                FROM `'.\Config\Database\DBConfig::$tableReservation.'`
                ORDER BY `'.\Config\Database\DBConfig::$tableReservation.'`.`'.\Config\Database\DBConfig\Reservation::$IdShowing.'` ASC
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $data['reservationForShowing'] =  $stmt->fetchAll();
            $stmt->closeCursor();
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getAll($date = null, $firstName = null, $lastName = null, $email = null, $mobilePhone = null){
        $data = array();
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data['reservations'] = array();

        $date1 = null;
        $date2 = null;
        if($date != null){
            if(is_numeric($date)){
                if(count($date) > 5)
                    $date = 5;
                elseif (count($date) < 0)
                    $date = 0;
                $date = date('Y-m-d H:i:s', strtotime( date('Y-m-d H:i:s', time()). ' + '.$date.' days'));
            }

            $date1 = date_create($date);
            date_time_set($date1, 00, 00, 00);
            $date1 = date_format($date1 , 'Y-m-d H:i:s');

            $date2 = date_create($date);
            date_time_set($date2, 23, 59 ,59);
            $date2 = date_format($date2 , 'Y-m-d H:i:s');
        }

        if($firstName === null){
            $firstName = "";
        }
        $firstName = '%'.$firstName.'%';

        if($lastName === null){
            $lastName = "";
        }
        $lastName = '%'.$lastName.'%';
        if($email === null){
            $email = "";
        }
        $email = '%'.$email.'%';
        if($mobilePhone === null){
            $mobilePhone = "";
        }
        $mobilePhone = '%'.$mobilePhone.'%';

        try {
            $query = '
                SELECT * 
                FROM `'.\Config\Database\DBConfig::$tableReservation.'` 
                INNER JOIN `'.\Config\Database\DBConfig::$tableUser.'`
                ON `'.\Config\Database\DBConfig::$tableReservation.'`.`'.\Config\Database\DBConfig\Reservation::$IdUser.'` =
                    `'.\Config\Database\DBConfig::$tableUser.'`.`'.\Config\Database\DBConfig\User::$IdUser.'`
                INNER JOIN `'.\Config\Database\DBConfig::$tableShowing.'`
                ON `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdShowing.'` =
                    `'.\Config\Database\DBConfig::$tableReservation.'`.`'.\Config\Database\DBConfig\Reservation::$IdShowing.'`
                INNER JOIN `'.\Config\Database\DBConfig::$tableReservationPlace.'`
                ON `'.\Config\Database\DBConfig::$tableReservationPlace.'`.`'.\Config\Database\DBConfig\ReservationPlace::$IdReservation.'` =
                    `'.\Config\Database\DBConfig::$tableReservation.'`.`'.\Config\Database\DBConfig\Reservation::$IdReservation.'`
                INNER JOIN `'.\Config\Database\DBConfig::$tablePlace.'`
                ON `'.\Config\Database\DBConfig::$tableReservationPlace.'`.`'.\Config\Database\DBConfig\ReservationPlace::$IdPlace.'` =
                    `'.\Config\Database\DBConfig::$tablePlace.'`.`'.\Config\Database\DBConfig\Place::$IdPlace.'`
                INNER JOIN `'.\Config\Database\DBConfig::$tableMovieType.'`
                ON `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdMovieType.'` =
                    `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdMovieType.'`
                INNER JOIN `'.\Config\Database\DBConfig::$tableMovie.'`
                ON `'.\Config\Database\DBConfig::$tableMovie.'`.`'.\Config\Database\DBConfig\Movie::$IdMovie.'` =
                    `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdMovie.'`
                INNER JOIN `'.\Config\Database\DBConfig::$tableType.'`
                ON `'.\Config\Database\DBConfig::$tableType.'`.`'.\Config\Database\DBConfig\Type::$IdType.'` =
                    `'.\Config\Database\DBConfig::$tableMovieType.'`.`'.\Config\Database\DBConfig\MovieType::$IdType.'`
                INNER JOIN `'.\Config\Database\DBConfig::$tableLanguageVersion.'`
                ON `'.\Config\Database\DBConfig::$tableLanguageVersion.'`.`'.\Config\Database\DBConfig\LanguageVersion::$IdLanguageVersion.'` =
                    `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$IdLanguageVersion.'`  
            ';
            if($date === null)
                $query .= "
                    WHERE (`".\Config\Database\DBConfig::$tableShowing."`.`".\Config\Database\DBConfig\Showing::$DateTime."` > NOW())
                    AND (`".\Config\Database\DBConfig::$tableUser."`.`".\Config\Database\DBConfig\User::$FirstName."` LIKE :firstName)
                    AND (`".\Config\Database\DBConfig::$tableUser."`.`".\Config\Database\DBConfig\User::$LastName."` LIKE :lastName)
                    AND (`".\Config\Database\DBConfig::$tableUser."`.`".\Config\Database\DBConfig\User::$Email."` LIKE :email)
                    AND (`".\Config\Database\DBConfig::$tableUser."`.`".\Config\Database\DBConfig\User::$MobilePhone."` LIKE :mobilePhone)
                ";
            else{
                $query .= "
                    WHERE (`".\Config\Database\DBConfig::$tableShowing."`.`".\Config\Database\DBConfig\Showing::$DateTime ."` BETWEEN :date1 AND :date2)
                    AND (`".\Config\Database\DBConfig::$tableUser."`.`".\Config\Database\DBConfig\User::$FirstName."` LIKE :firstName)
                    AND (`".\Config\Database\DBConfig::$tableUser."`.`".\Config\Database\DBConfig\User::$LastName."` LIKE :lastName)
                    AND (`".\Config\Database\DBConfig::$tableUser."`.`".\Config\Database\DBConfig\User::$Email."` LIKE :email)
                    AND (`".\Config\Database\DBConfig::$tableUser."`.`".\Config\Database\DBConfig\User::$MobilePhone."` LIKE :mobilePhone)
                ";
            }
            $query .= '
                ORDER BY `'.\Config\Database\DBConfig::$tableShowing.'`.`'.\Config\Database\DBConfig\Showing::$DateTime.'` ASC,
                          `' . \Config\Database\DBConfig::$tablePlace . '`.`' . \Config\Database\DBConfig\Place::$Row . '` ASC,
                          `' . \Config\Database\DBConfig::$tablePlace . '`.`' . \Config\Database\DBConfig\Place::$Column . '` ASC
            ';
            $stmt = $this->pdo->prepare($query);
            if($date !== null){
                $stmt->bindValue(':date1' , $date1 , PDO::PARAM_STR);
                $stmt->bindValue(':date2' , $date2 , PDO::PARAM_STR);
            }
            if($firstName !== null){
                $stmt->bindValue(':firstName' , $firstName , PDO::PARAM_STR);
            }
            if($firstName !== null){
                $stmt->bindValue(':lastName' , $lastName , PDO::PARAM_STR);
            }
            if($email !== null){
                $stmt->bindValue(':email' , $email , PDO::PARAM_STR);
            }
            if($mobilePhone !== null){
                $stmt->bindValue(':mobilePhone' , $mobilePhone , PDO::PARAM_STR);
            }
            $stmt->execute();
            $reservations = $stmt->fetchAll();
            $stmt->closeCursor();
            $data['reservations'] = array();
            if($reservations && !empty($reservations)) {
                foreach ($reservations as $reservation) {
                    if(!isset($data['reservations'][$reservation[\Config\Database\DBConfig\Showing::$IdShowing]])) {
                        $data['reservations'][$reservation[\Config\Database\DBConfig\Showing::$IdShowing]]['data'] = $reservation;
                    }
                    if(!isset($data['reservations'][$reservation[\Config\Database\DBConfig\Showing::$IdShowing]]['reservationData'][$reservation[\Config\Database\DBConfig\User::$IdUser]]['userData'])){
                        $data['reservations'][$reservation[\Config\Database\DBConfig\Showing::$IdShowing]]['reservationData'][$reservation[\Config\Database\DBConfig\User::$IdUser]]['userData']['firstName'] = $reservation[\Config\Database\DBConfig\User::$FirstName];
                        $data['reservations'][$reservation[\Config\Database\DBConfig\Showing::$IdShowing]]['reservationData'][$reservation[\Config\Database\DBConfig\User::$IdUser]]['userData']['lastName'] = $reservation[\Config\Database\DBConfig\User::$LastName];
                        $data['reservations'][$reservation[\Config\Database\DBConfig\Showing::$IdShowing]]['reservationData'][$reservation[\Config\Database\DBConfig\User::$IdUser]]['userData']['email'] = $reservation[\Config\Database\DBConfig\User::$Email];
                        $data['reservations'][$reservation[\Config\Database\DBConfig\Showing::$IdShowing]]['reservationData'][$reservation[\Config\Database\DBConfig\User::$IdUser]]['userData']['mobilePhone'] = $reservation[\Config\Database\DBConfig\User::$MobilePhone];
                    }
                    if(!isset($data['reservations'][$reservation[\Config\Database\DBConfig\Showing::$IdShowing]]['reservationData'][$reservation[\Config\Database\DBConfig\User::$IdUser]]['reservations'][$reservation[\Config\Database\DBConfig\Place::$IdPlace]])){
                        $data['reservations'][$reservation[\Config\Database\DBConfig\Showing::$IdShowing]]['reservationData'][$reservation[\Config\Database\DBConfig\User::$IdUser]]['reservations'][$reservation[\Config\Database\DBConfig\Place::$IdPlace]]['column'] = $reservation[\Config\Database\DBConfig\Place::$Column];
                        $data['reservations'][$reservation[\Config\Database\DBConfig\Showing::$IdShowing]]['reservationData'][$reservation[\Config\Database\DBConfig\User::$IdUser]]['reservations'][$reservation[\Config\Database\DBConfig\Place::$IdPlace]]['row'] = $reservation[\Config\Database\DBConfig\Place::$Row];
                    }
                }
            }
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function deleteReservationForUser($idUSer){
        $data = array();
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if(is_null($idUSer)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        try {
            $query ="
                DELETE `".\Config\Database\DBConfig::$tableReservation."`, `".\Config\Database\DBConfig::$tableReservationPlace."`
                FROM `".\Config\Database\DBConfig::$tableReservation."`
                INNER JOIN `".\Config\Database\DBConfig::$tableReservationPlace."`
                ON `".\Config\Database\DBConfig::$tableReservation."`.`".\Config\Database\DBConfig\Reservation::$IdReservation."` =
                   `".\Config\Database\DBConfig::$tableReservationPlace."`.`".\Config\Database\DBConfig\ReservationPlace::$IdReservation."` 
                WHERE `".\Config\Database\DBConfig::$tableReservation."`.`".\Config\Database\DBConfig\Reservation::$IdUser."` = :idUser
                AND `".\Config\Database\DBConfig::$tableReservationPlace."`.`".\Config\Database\DBConfig\ReservationPlace::$IdReservation."` =
                    `".\Config\Database\DBConfig::$tableReservation."`.`".\Config\Database\DBConfig\Reservation::$IdReservation."`
            ";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':idUser' , $idUSer , PDO::PARAM_STR);
            $result = $stmt->execute();
            $stmt->closeCursor();
            if ($result) {
                $data['message'] = "Usunięto rezerwacje poprawnie.";
            }
            else {
                $data['error'] = "Nie udało się poprawnie usunąć rezerwacji.";
            }
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query." ".$query." ".$idUSer;
        }
        return $data;
    }

}