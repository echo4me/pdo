<?php
session_start();
require_once('../inc/connection.php');

$stmt = $pdo->prepare("SELECT * FROM `posts`");
$stmt->execute();
if($stmt->rowCount())
{
    $_SESSION['posts']  = $stmt->fetchAll();
    header("Location: ../views/index.php "); //redirect to index ['posts']
}
