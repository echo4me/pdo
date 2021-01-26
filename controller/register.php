<?php
require_once('../inc/connection.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['submit']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordconfirm']))
    {
        $username           = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $email              = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $password           = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
        $passworConfirm     = filter_var($_POST['passwordconfirm'],FILTER_SANITIZE_STRING);
        
        if(strlen($password) >= 4){
            
            if($password === $passworConfirm)
            {
                if(filter_var($email,FILTER_VALIDATE_EMAIL))
                {
                    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` =? OR `email` = ? ");
                    $stmt->execute([$username,$email]);
                    if($stmt->rowCount())
                    {
                        die('Username or Email already Taken, Please Choose other one');
                    }else{
                        $stmt = $pdo->prepare("INSERT INTO `users` (`username`,`password`,`email`) VALUES (?,?,?) ");
                        $stmt->execute([
                        $username,
                        password_hash($password,PASSWORD_DEFAULT,['cost'=>11]),
                        $email
                        ]);
                        $count = $stmt->rowCount();
                        if($count > 0)
                        {
                            echo "Thank you for Registerion ,Please Active ur account ";
                        }
                    }
                    
                }else{
                    echo "Email Invalid";
                }
            }else{
                echo "Password Dos'nt Match";
            }
        }else{
            echo "Password too short";
        }
        
    }
}

?>