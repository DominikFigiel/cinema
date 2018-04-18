<?php
namespace Models;
use \PDO;
class Showing extends Model {

    public function getAll($date = null , $type = null){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($date == null)
            $date = date('Y-m-d h:i:s', time());
        //$date = date('Y-m-d h:i:s', time());
        if($date != null){
            //Jeśli data nie jest datą, tylko liczbą, to pobieramy dzisiejszą datę i dodajemy liczbę jako dni
            if(is_numeric($date)){
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
            ';
            if($type != null || $date != null) {
                if ($type != null && $date != null) {
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
            $stmt->execute();
            $showings = $stmt->fetchAll();
            $stmt->closeCursor();

            $data['showings'] = array();
            if($showings && !empty($showings)) {
                foreach ($showings as $showing){
                    if(!isset($data['showings'][$showing[\Config\Database\DBConfig\Movie::$IdMovie]][$showing[\Config\Database\DBConfig\Type::$Type]][$showing[\Config\Database\DBConfig\Showing::$Dubbing]]))
                        $data['showings'][$showing[\Config\Database\DBConfig\Movie::$IdMovie]][$showing[\Config\Database\DBConfig\Type::$Type]][$showing[\Config\Database\DBConfig\Showing::$Dubbing]] = $showing;
                    $data['showings'][$showing[\Config\Database\DBConfig\Movie::$IdMovie]][$showing[\Config\Database\DBConfig\Type::$Type]][$showing[\Config\Database\DBConfig\Showing::$Dubbing]]['hours'][] = $showing[\Config\Database\DBConfig\Showing::$DateTime];
                }
            }
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

}