<?php
session_start();
require_once('../inc/connection.php');
if(!empty($_GET))
{
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
    {
        if(isset($_GET['id']) && is_numeric($_GET['id']) && !empty($_GET['id']))
        {
            if(preg_match('/^[0-9]*$/',$_GET['id']))
            {
                $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id");
                $stmt->execute([':id'=>$_GET['id']]);
                if($stmt->rowCount())
                {
                    foreach ($stmt->fetchAll() as $value){
                        if($_SESSION['id'] == $value['user_id'])
                        {
                            $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :id");
                            $stmt->execute([':id'=>$_GET['id']]);
                            if($stmt->rowCount())
                            {
                                $_SESSION['success'] = "Post Deleted Successfuly";
                                header('refresh:.2;url=../controller/index.php');
                            }
                        }else{
                                $_SESSION['error'] = "You not Authoirezed to Delete this Post";
                                header('refresh:.2;url=../controller/index.php');
                        }
                    }
                }
            }
       }     
    }
}