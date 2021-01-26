<?php
session_start();
require_once('../inc/connection.php');

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
{
    if(isset($_FILES['img']) && !empty($_FILES['img']))
    {
        $allow_Extention     = ['png','gif','jpg','jpeg'];
        $file_name   = $_FILES['img']['name'];
        $file_tmp    = $_FILES['img']['tmp_name'];
        $file_type   = $_FILES['img']['type'];
        $file = explode('/',$file_type,2);
        $file_ext = strtolower(end($file));
        
        if(in_array($file_ext,$allow_Extention))
        {
            $file_new_name = rand(0,1000000).'.'.$file_ext; // create new Name for the photo 456579841.png
            $file_dest     = '../uploads/'.$file_new_name; //create to save with destination of image , easy to call inside img src
            if(move_uploaded_file($file_tmp,$file_dest)){
                $stmt = $pdo->prepare("UPDATE `users` SET `img_path` =:img_path  WHERE `username` = :username ");
                $stmt->execute([
                    ':img_path'  => $file_dest,
                    ':username'  => $_SESSION['username']
                ]);
                if($stmt->rowCount())
                {
                    $_SESSION['success'] = "Image Uploaded Successfuly";
                    header('refresh:.2;url=../views/uploads.php');
                }
                
            }else{
                $_SESSION['error'] = "Failed To upload image ";
                header('refresh:.2;url=../views/uploads.php');
            }
        }else{
            $_SESSION['error'] = "Extention not Allowed ";
            header('refresh:.2;url=../views/uploads.php');
        }

    }
}
?>