<?php
namespace Models;
use \PDO;
class CinemaHallPlaces extends Model {

    public function getCinemaHallPlaces($id, $idShowing){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        if(is_null($id) || is_null($idShowing)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data['places'] = array();
        try {
            $query = '
                    SELECT * 
                    FROM `' . \Config\Database\DBConfig::$tableCinemaHallPlace . '`
                    INNER JOIN `' . \Config\Database\DBConfig::$tableCinemaHall . '`
                    ON `' . \Config\Database\DBConfig::$tableCinemaHallPlace . '`.`' . \Config\Database\DBConfig\CinemaHallPlace::$IdCinemaHall . '`
                    = `' . \Config\Database\DBConfig::$tableCinemaHall . '`.`' . \Config\Database\DBConfig\CinemaHall::$IdCinemaHall . '`
                    INNER JOIN `' . \Config\Database\DBConfig::$tablePlace . '`
                    ON `' . \Config\Database\DBConfig::$tableCinemaHallPlace . '`.`' . \Config\Database\DBConfig\CinemaHallPlace::$IdPlace . '`
                    = `' . \Config\Database\DBConfig::$tablePlace . '`.`' . \Config\Database\DBConfig\Place::$IdPlace . '`
                    WHERE `' . \Config\Database\DBConfig::$tableCinemaHall . '`.`' . \Config\Database\DBConfig\CinemaHall::$IdCinemaHall . '` = :id
                    ORDER BY `' . \Config\Database\DBConfig::$tablePlace . '`.`' . \Config\Database\DBConfig\Place::$Row . '` ASC,
                                `' . \Config\Database\DBConfig::$tablePlace . '`.`' . \Config\Database\DBConfig\Place::$Column . '` ASC
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $places = $stmt->fetchAll();
            $placesTmp = array();
            foreach ($places as $place) {
                //$placesTmp[$place[\Config\Database\DBConfig\Place::$Row]]['Columns'][] = $place[\Config\Database\DBConfig\Place::$Column];
                $placesTmp[$place[\Config\Database\DBConfig\Place::$Row]][$place[\Config\Database\DBConfig\Place::$Column]]['id'] = $place[\Config\Database\DBConfig\Place::$IdPlace];
                $placesTmp[$place[\Config\Database\DBConfig\Place::$Row]][$place[\Config\Database\DBConfig\Place::$Column]]['busy'] = null;
            }
            $max = count($placesTmp[1]);
            foreach ($placesTmp as $place) {
                if (count($place) > $max)
                    $max = count($place);
            }
            $stmt->closeCursor();
            if (count($places) > 0){
                $data['places'] = $placesTmp;
            }
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }

        $busyPlaces = $this->getCinemaHallPlacesBusy($idShowing);
        if(isset($busyPlaces['message']))
            $data['message'] = $busyPlaces['message'];
        if(isset($busyPlaces['error']))
            $data['error'] = $busyPlaces['error'];
        if(isset($busyPlaces['placesBusy'])) {
            foreach ($busyPlaces['placesBusy'] as $keyRow => $row) {
                foreach ($row as $keyColumn => $column)
                $data['places'][$keyRow][$keyColumn]['busy'] = true;
            }
        }

        return $data;
    }

    public function getCinemaHallPlacesBusy($idShowing){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        if(is_null($idShowing)){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data['placesBusy'] = array();

        try {
            $query = '
                    SELECT * 
                    FROM `' . \Config\Database\DBConfig::$tableReservationPlace . '`
                    INNER JOIN `' . \Config\Database\DBConfig::$tableReservation . '`
                    ON `' . \Config\Database\DBConfig::$tableReservation . '`.`' . \Config\Database\DBConfig\Reservation::$IdReservation . '`
                    = `' . \Config\Database\DBConfig::$tableReservationPlace . '`.`' . \Config\Database\DBConfig\ReservationPlace::$IdReservation . '`
                    INNER JOIN `' . \Config\Database\DBConfig::$tablePlace . '`
                    ON `' . \Config\Database\DBConfig::$tableReservationPlace . '`.`' . \Config\Database\DBConfig\ReservationPlace::$IdPlace . '`
                    = `' . \Config\Database\DBConfig::$tablePlace . '`.`' . \Config\Database\DBConfig\Place::$IdPlace . '`
                    WHERE `' . \Config\Database\DBConfig::$tableReservation . '`.`' . \Config\Database\DBConfig\Reservation::$IdShowing . '` = :id
                    ORDER BY `' . \Config\Database\DBConfig::$tablePlace . '`.`' . \Config\Database\DBConfig\Place::$Row . '` ASC,
                                `' . \Config\Database\DBConfig::$tablePlace . '`.`' . \Config\Database\DBConfig\Place::$Column . '` ASC
            ';
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(':id', $idShowing, PDO::PARAM_INT);
            $stmt->execute();
            $placesBusy = $stmt->fetchAll();
            $placesBusyTmp = array();
            foreach ($placesBusy as $place) {
                $placesBusyTmp[$place[\Config\Database\DBConfig\Place::$Row]][$place[\Config\Database\DBConfig\Place::$Column]] = true;
            }
            $stmt->closeCursor();
            if (count($placesBusy) > 0){
                $data['placesBusy'] = $placesBusyTmp;
            }
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }

        return $data;
    }

}