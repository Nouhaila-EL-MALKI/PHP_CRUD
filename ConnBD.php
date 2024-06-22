<?php

$dns = "mysql:host=localhost;dbname=gestion_promonade;charset=utf8";
$username = "root";
$password = "";

try{
    $pdo = new PDO($dns, $username, $password);

}catch(PDOException $e){
    
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}