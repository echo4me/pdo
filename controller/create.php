<?php
session_start();
require_once('../inc/connection.php');

if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin']))
{
    if(isset($_POST['title']) && isset($_POST['body']) && !empty($_POST['title']) && !empty($_POST['body']))
    {
        if(ctype_alpha($_POST['title']))
        {
            if(preg_match('/^[a-z0-9-_. ]*$/i',$_POST['body']))
            {
                $stmt = $pdo->prepare("INSERT INTO `posts` (`user_id`,`username`,`title`,`body`) VALUES (:userid,:username,:title,:body) ");
                $stmt->execute([
                    ':userid'   => $_SESSION['id'],
                    ':username' => $_SESSION['username'],
                    ':title'    => $_POST['title'],
                    ':body'     => $_POST['body'],
                ]);
                if($stmt->rowCount())
                {
                    $_SESSION['success'] = 'Your Post Added Successfuly';
                    header('refresh:.2;url=../views/create.php');
                }
            }else{
                // make Error if Body have bad charcters
                $_SESSION['error'] = "Body Field Should only Contain Letters ,Whitespace and dots";
                header('refresh:.2;url=../views/create.php');
            }
        }else{
            // make Error if title not alpha
            $_SESSION['error'] = "Title Field Should only Contain Letters";
            header('refresh:.2;url=../views/create.php');
        }
    }else{
        // make Error if post empty
        $_SESSION['error'] = "Body and Title are Required";
        header('refresh:.2;url=../views/create.php');
    }
}

?>