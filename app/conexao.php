<?php

require_once("config.php");
global $pdo;
try{
    $pdo = new PDO("mysql:dbname=nutri;host=localhost", "root", "56642202Egr.");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "ERRO".$e->getMessage();
    exit;

}




?>