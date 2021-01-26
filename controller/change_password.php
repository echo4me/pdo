<?php
session_start();
require_once('../inc/connection.php');

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
{
    if(isset($_POST['password'],$_POST['confirm-password']) && isset($_POST['new-password']) && isset($_POST['confirm-password']))
    {
        if(!empty($_POST['confirm-password']) && !empty($_POST['confirm-password']) && !empty($_POST['new-password']))
        {
            if($_POST['new-password'] === $_POST['confirm-password'])
            {
                //check in db 
                $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :zuser OR `email` = :zemail ");
                $stmt->execute([
                    ':zuser'  => $_SESSION['username'],
                    ':zemail' => $_SESSION['email']
                ]);
                //fetch the Data
                if($stmt->rowCount())
                {
                    foreach( $stmt->fetchAll() as $value)
                    {
                        //validate old password inside database
                        if(password_verify($_POST['password'],$value['password']))
                        {
                            $hashedPass = password_hash($_POST['new-password'],PASSWORD_DEFAULT);
                            $stmt = $pdo->prepare("UPDATE `users` SET `password` =:zpass WHERE `username` = :zuser ");
                            $stmt->execute([
                                "zpass" => $hashedPass,
                                'zuser' => $_SESSION['username']
                                ]);
                            if($stmt->rowCount())
                            {
                                echo "Password Changed Succesfully";
                            }
                        }else{
                            echo "Your old password Wrong";
                        }

                    }
                }
            }else{
                echo "Password Not Match";
            }
        }else{
            echo "Please Fill All Fields";
        }
    }
}
?>