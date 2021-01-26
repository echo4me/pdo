<?php

require_once('../inc/connection.php');
if(isset($_GET['email']) && isset($_GET['rest_token']) && !empty($_GET['email']) && !empty($_GET['rest_token']))
{
    //check Email and Token
    $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` =:zemail AND `rest_token` =:zrest ");
    $stmt->execute([
       ':zemail' => $_GET['email'],
       ':zrest'  => $_GET['rest_token']
    ]);
    if($stmt->rowCount()){?>
        <!-- Create Form To get the Password  -->
        <div class="container">
            <form action="" method="POST">
                <div class="form-group">
                    <label>New Password</label>
                    <input type="password" name="new-password"  class="form-control">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm-password"  class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" value="genrate" name="login" class='btn btn-primary'>
                </div>

            </form>
        </div>
        <?php
        if(isset($_POST['login']) && !empty($_POST['new-password']))
        {
            if($_POST['new-password'] === $_POST['confirm-password'])
            {
                //change password in DB
                $stmt= $pdo->prepare("UPDATE `users` SET `password` = :zpass WHERE `rest_token`=:zrest AND `email` = :zemail ");
                $stmt->execute([
                    ':zpass'  => password_hash($_POST['new-password'],PASSWORD_DEFAULT),
                    ':zrest'  => $_GET['rest_token'],
                    ':zemail' =>$_GET['email']
                ]);
                if($stmt->rowCount())
                {
                    $stmt = $pdo->prepare("UPDATE `users` SET `rest_token` = :zrest WHERE `email` =:zemail ");
                    $stmt->execute([
                        ':zrest'  => NULL,
                        ':zemail' => $_GET['email']
                    ]);
                    if($stmt->rowCount()){
                        echo "Password Changed Succefuly";
                    }
                }
            }else{
                echo "Passwords Not Match";
            }
        }else{
            echo "please Fill up ur Form";
        }
    }else{
        echo 'Invalid Token';
    }
}

?>