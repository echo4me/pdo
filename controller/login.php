<?php
session_start();
require_once('../inc/connection.php');

if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['login']) && isset($_POST['username']) && isset($_POST['password']))
    {
        $username           = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
        $password           = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
        
        if(!empty($username) && !empty($password))
        {
            $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `username` = :username OR `email` = :zemail AND `activated` =1 ");
            $stmt->execute([':username' => $username, ':zemail' =>  $username ]);
            if($stmt->rowCount() )
            {
                foreach($stmt->fetchAll() as $value)
                {
                    if(password_verify($password,$value['password']))
                    {
                        //save Data inside Session
                        $_SESSION['loggedin']       = true;
                        $_SESSION['username']       = $value['username'];
                        $_SESSION['email']          = $value['email'];
                        $_SESSION['nickname']       = $value['nickname'];
                        $_SESSION['img_path']       = $value['img_path'];
                        $_SESSION['privilege']      = $value['privilege'];
                        $_SESSION['id']             = $value['id'];
                        // Set Lastlogin Date 
                        $stmt =$pdo->prepare("UPDATE `users` SET `last_login` =:zlastlog WHERE `username`=:zuser ");
                        $stmt->execute([
                            ':zlastlog'  => date('Y-m-d H:i:s'),
                            'zuser'      => $_SESSION['username']
                        ]);                         
                        header("Location: ../controller/index.php"); //redirect to index ['posts']

                    }else{
                            echo "Username/password inncorrect";
                            header('refresh:.5;url= ../views/login.php');
                        }
                }
                 
            
               
            }else{
                echo "No such user Or not Activated yet";
                header('refresh:.5;url= ../views/login.php');
            }
           
        }else{
            echo "Fields Are Required !";
            header('refresh:.5;url= ../views/login.php');
        }
        
    }
}

?>
