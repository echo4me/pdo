<?php
ini_get('display_errors');
$dsn = "mysql:host=localhost;dbname=crud";
$user = 'root' ; $pass = '';


try{
    $pdo = new PDO($dsn,$user,$pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    
}catch(PDOException $e){
    die( "Error ".$e->getMessage());
}



?>
