<?php
session_start();
require_once('../inc/connection.php');

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
{
    //$stmt = $pdo->prepare("SELECT * FROM `users` WHERE activated = 1");
    $stmt = $pdo->prepare("SELECT * FROM `users` ");
    $stmt->execute();
    if($stmt->rowCount())
    {
        $_SESSION['users'] = $stmt->fetchAll();
    }
    header('Location: ../views/users.php');
}