<?php
require_once('../inc/connection.php');
    // we dont user session coz we need to rest the password
    if(isset($_POST['login']) && isset($_POST['email']))
    {
        if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
        {
            //check email in DB
            $stmt = $pdo->prepare("SELECT * FROM `users` WHERE `email` = :zemail");
            $stmt ->execute([
                ':zemail'=>$_POST['email'],
                ]);
            if($stmt->rowCount())
            {
                // Create rest_token And insert To DB By Email
                $token = sha1(uniqid('',true)) .sha1(date('Y-m-d H:i:s'));
                $stmt= $pdo->prepare("UPDATE `users` SET `rest_token` = :zrest WHERE `email` = :zemail ");
                $stmt->execute([
                    ':zrest'  => $token ,
                    ':zemail' => $_POST['email']
                ]);
                if($stmt->rowCount())
                {
                    //Get Email and Token From DB by Email And put inside Link
                    $stmt = $pdo->prepare("SELECT email,rest_token FROM `users` WHERE `email`=:zemail ");
                    $stmt->execute([
                        ':zemail' => $_POST['email']
                    ]);
                    if($stmt->rowCount())
                    {
                        foreach ($stmt->fetchAll() as $value)
                        {?>
                            <a href="password_recovery.php?email=<?= $value['email']; ?>&rest_token=<?= $value['rest_token'];?>">Rest Password</a>

                        <?php
                        }//end Foreach
                    }
                }
            }else{
                echo "Email not Exist";
            }
        }else{
            echo "Please Put Valid Email";
        }
        
    }
    


?>