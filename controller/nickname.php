<?php
session_start();
require_once('../inc/connection.php');
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
{
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if(isset($_POST['nickname'],$_POST['password']) && !empty($_POST['nickname']) && !empty($_POST['password']))
        {
            
            //Regex For Nickname accpt only letters and space
            if(preg_match('/^[a-z ]*$/i',$_POST['nickname']))
            {
                
                //Select all info by Email
                $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email`=:zemail ");
                $stmt->execute([
                    ':zemail'  => $_SESSION['email']
                ]);

                if($stmt->rowCount())
                {   //fetch data
                    
                    foreach($stmt->fetchAll() as $value)
                    {
                        //verify the password from db with password from $_POST .. to check the user password
                        
                        if(password_verify($_POST['password'],$value['password']))
                        {
                            $stmt = $pdo->prepare("UPDATE `users` SET `nickname` = :znick WHERE `email` = :zemail");
                            $stmt->execute([
                                ':znick'   => $_POST['nickname'],
                                ':zemail'  => $_SESSION['email']
                            ]);
                            if($stmt->rowCount())
                            {
                                echo "Hello ". $_POST['nickname'];
                            }
                        }else{
                            echo 'incorrect Password';
                        }
                    }
                }
            }else{
                echo " letters and Whitespaces are only Allowed";
            }
        }else{
            echo "Please Fill All Fields";
        }

    }
}else{
    die('U need to Login');
}
