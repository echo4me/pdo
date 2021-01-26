<?php
session_start();
require_once('../inc/connection.php');

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
{
    if(isset($_POST['email'],$_POST['password']) && !empty($_POST['email'])){
       
        if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
        {
            $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = ? ");
            $stmt->execute([$_POST['username']]);
            if($stmt->rowCount())
            {
                foreach($stmt->fetchAll() as $value)
                {
                    if(password_verify($_POST['password'],$value['password']))
                    {
                        $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` =? ");
                        $stmt->execute([$_POST['email']]);
                        
                        if(!$stmt->rowCount())
                        {
                            $stmt = $pdo->prepare("UPDATE `users` SET `email` = :zemail WHERE `username`=:zuser AND `id`= :zid ");
                            $stmt->execute([
                                ':zemail' => $_POST['email'],
                                ':zuser'  => $_SESSION['username'],
                                ':zid'    => $_SESSION['id']
                            ]);
                            if($stmt->rowCount())
                            {
                                echo "ur email Updated Succesfuly";
                            }
                        }else{
                            echo 'This email already Taken';
                        }

                    }else{
                        echo "Password incorrect";
                    }

                }
            }



        }else{
           echo 'Please Put Valid Email';
        }
    }else{
        'Please Fill All Fields';
    }
}else{
    die("u need to Login");
}

?>