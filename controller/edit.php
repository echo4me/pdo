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
                $stmt = $pdo->prepare("SELECT * FROM `posts` WHERE `id`=:id");
                $stmt->execute([':id' => $_GET['id'] ]);
                
                if($stmt->rowCount() > 0)
                {
                    
                    foreach($stmt->fetchAll() as $post)
                    {
                        
                        if($_SESSION['id'] == $post['user_id']){
                            
                            $_SESSION['posts'] = $post;
                            
                            header("refresh:0;url= ../views/edit.php");
                        }else{
                            $_SESSION['error'] = "You are not Authorized to Edit this Post";
                            header('refresh:.2;url=../views/index.php');
                        }
                    }
                    
                }
            }else{
                // make Error if Body have bad charcters
                $_SESSION['error'] = "ID Should Contain only Numbers";
                header('refresh:.2;url=../views/index.php');
            }
        }else{
            $_SESSION['error'] = "Put Valid ID";
            header('refresh:.2;url=../views/index.php');
        }
    }else{
        header('Location: ../views/login.php');
    }
}elseif(!empty($_POST)){
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :username");
    $stmt->execute([':username' => $_SESSION['username']]);
    if($stmt->rowCount())
    {
        foreach($stmt->fetchAll() as $value)
        {
            if(password_verify($_POST['password'],$value['password']))
            {
                try{
                    $pdo->beginTransaction();
                    $stmt = $pdo->prepare("SELECT * FROM `posts` WHERE id = :id");
                    $stmt->execute([':id' => $_POST['id']]);
                    if($stmt->rowCount())
                    {
                        $stmt =$pdo->prepare("UPDATE `posts` SET `user_id` = :userid , `username` = :username , `title` = :title ,`body` = :body , `updated_at` = NOW() WHERE `id` =:id ");
                        $stmt->execute([
                            ':userid'       => $_SESSION['id'],
                            ':username'     => $_SESSION['username'],
                            ':title'        => $_POST['title'],
                            ':body'         => $_POST['body'],
                            'id'            => $_POST['id']
                        ]);
                        if($stmt->rowCount())
                        {
                            $_SESSION['success'] = "Post Updated Successfuly";
                            header('refresh:.2;url=../views/index.php');
                        }
                        
                    }else{
                        echo "No Such users";
                    }
            
                    $pdo->commit();
                }catch(PDOException $e){
                    $pdo->rollBack();
                    $_SESSION['error'] = "Post Title Already Exists";
                    header('refresh:.2;url=../views/index.php');
                }
            }else{
                $_SESSION['error'] = "Password incorrect";
                header('refresh:.2;url=../views/index.php');
            }
        }
    }
    
}