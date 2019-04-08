<?php
require 'db.php';
class DbPDO {
    public static function pdoConnexion(){
        try{
            $connexion = new PDO('mysql:host='.HOST.';port='.PORT.';dbname='.DBNAME.';', USER, PASSWORD);
            $connexion->exec('SET NAMES utf8');
        }catch(Exception $e){
            echo 'Erreur:'.$e->getMessage().'<br />';
            echo 'N° : '.$e->getCode();
            die();
        }
        return $connexion;
    }
}