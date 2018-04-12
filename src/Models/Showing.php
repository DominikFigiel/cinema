<?php
namespace Models;
use \PDO;
class Showing extends Model {

    public function getAll($date = null , $type = null){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $type = '2D';
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
            if($type != null)
                $query .= '
                    WHERE `'.\Config\Database\DBConfig::$tableType.'`.`'.\Config\Database\DBConfig\Type::$Type.'` = :type
                ';
            $query .= "ORDER BY `".\Config\Database\DBConfig::$tableMovie."`.`".\Config\Database\DBConfig\Movie::$Title."` ,
                                `".\Config\Database\DBConfig::$tableType."`.`".\Config\Database\DBConfig\Type::$Type."` ,
                                `".\Config\Database\DBConfig::$tableShowing."`.`".\Config\Database\DBConfig\Showing::$DateTime."` ASC";
            if($type != null){
                $stmt = $this->pdo->prepare($query);
                $stmt->bindValue(':type' , $type , PDO::PARAM_STR);
                $stmt->execute();
            }
            else
                $stmt = $this->pdo->query($query);
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