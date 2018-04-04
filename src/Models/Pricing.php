<?php
namespace Models;
use \PDO;
class Pricing extends Model {
    public function getAll(){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        $data = array();
        $data['pricings'] = array();
        try{
            $query = '
                    SELECT * 
                    FROM `'.\Config\Database\DBConfig::$tablePricing.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tablePricingCategory.'`
                    ON `'.\Config\Database\DBConfig::$tablePricing.'`.`'.\Config\Database\DBConfig\Pricing::$IdPricingCategory.'`
                    = `'.\Config\Database\DBConfig::$tablePricingCategory.'`.`'.\Config\Database\DBConfig\PricingCategory::$IdPricingCategory.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableType.'`
                    ON `'.\Config\Database\DBConfig::$tablePricing.'`.`'.\Config\Database\DBConfig\Pricing::$IdType.'`
                    = `'.\Config\Database\DBConfig::$tableType.'`.`'.\Config\Database\DBConfig\Type::$IdType.'`
            ';
            $stmt = $this->pdo->query($query);
            $pricings = $stmt->fetchAll();
            $stmt->closeCursor();

            if($pricings && !empty($pricings))
                $data['pricings'] = $pricings;
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }

    public function getType($type = "2D"){
        if($this->pdo === null){
            $data['error'] = \Config\Database\DBErrorName::$connection;
            return $data;
        }
        if($type === null){
            $data['error'] = \Config\Database\DBErrorName::$empty;
            return $data;
        }
        $data = array();
        $data['pricings'] = array();
        try{
            $query = "
                    SELECT * 
                    FROM `".\Config\Database\DBConfig::$tablePricing."`
                    INNER JOIN `".\Config\Database\DBConfig::$tablePricingCategory."`
                    ON `".\Config\Database\DBConfig::$tablePricing."`.`".\Config\Database\DBConfig\Pricing::$IdPricingCategory."`
                    = `".\Config\Database\DBConfig::$tablePricingCategory."`.`".\Config\Database\DBConfig\PricingCategory::$IdPricingCategory.'`
                    INNER JOIN `'.\Config\Database\DBConfig::$tableType."`
                    ON `".\Config\Database\DBConfig::$tablePricing."`.`".\Config\Database\DBConfig\Pricing::$IdType."`
                    = `".\Config\Database\DBConfig::$tableType."`.`".\Config\Database\DBConfig\Type::$IdType."`
                    WHERE `".\Config\Database\DBConfig::$tableType."`.`".\Config\Database\DBConfig\Type::$Type."` like '%".$type."%' 
                    ORDER BY `".\Config\Database\DBConfig::$tablePricingCategory.'`.`'.\Config\Database\DBConfig\PricingCategory::$PricingCategoryName."`
            ";
            $stmt = $this->pdo->query($query);
            $pricings = $stmt->fetchAll();
            $stmt->closeCursor();

            if($pricings && !empty($pricings))
                $data['pricings'] = $pricings;
            else
                $data['error'] = \Config\Database\DBErrorName::$empty;
        }
        catch(\PDOException $e){
            $data['error'] = \Config\Database\DBErrorName::$query;
        }
        return $data;
    }
}