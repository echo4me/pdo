<?php
session_start();
require_once('../inc/connection.php');

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true)
{
    if(isset($_GET['action']) && isset($_GET['id']) && !empty($_GET['action']) && !empty($_GET['id']))
    {
        if(is_numeric($_GET['id']))
        {
            $stmt = $pdo->prepare("SELECT * From posts WHERE id = :id");
            $stmt->execute([':id' => $_GET['id']]);
            if($stmt->rowCount())
            {
                foreach($stmt->fetchAll() as $value)
                {
                    if( $_SESSION['id'] == $value['user_id'])
                    {
                        switch ($_GET['action']) {
                            case 'approved':
                                $stmt = $pdo->prepare("UPDATE `posts` SET `user_id` = :userid ,`approved` = :approved , `updated_at` = :updated_at  WHERE id = :id");
                                $stmt->execute([
                                    ':userid'     => $_SESSION['id'],
                                    ':approved'   => 1 ,
                                    ':updated_at' =>date('Y-m-d H:i:s'),
                                    ':id'   => $_GET['id']
                                    ]);
                                    if($stmt->rowCount())
                                    {
                                        $_SESSION['success'] = "You Approved Successfuly";
                                        header('refresh:.2;url=../controller/index.php');
                                    }
                                break;

                            case 'unapproved':
                                $stmt =$pdo->prepare("UPDATE `posts` SET `user_id` = :userid ,`approved` = :approved , `updated_at` = :updated_at  WHERE id = :id");
                                $stmt->execute([
                                    ':userid'     => $_SESSION['id'],
                                    ':approved'   => 0 ,
                                    ':updated_at' =>date('Y-m-d H:i:s'),
                                    ':id'   => $_GET['id']
                                    ]);
                                    if($stmt->rowCount())
                                    {
                                        $_SESSION['success'] = "You unApproved Successfuly";
                                        header('refresh:.2;url=../controller/index.php');
                                    }
                                break;
                            
                        }
                    }else{
                        $_SESSION['error'] = "You Not Authoriezed To Approve or Unapprove";
                        header('refresh:.2;url=../controller/index.php');
                    }
                }
            }
        }
    }
}