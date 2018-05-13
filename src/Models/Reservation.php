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

}