<?php require_once('../inc/navbar.php'); ?>
<?php 
require_once('../inc/navbar.php'); 
if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']))
{
    header("Location: login.php");die;
}
?>
   <div class="container">
       <br><h1>Our Users</h1><br>
       <?php
        if(isset($_SESSION['error']) && !empty($_SESSION['error']))
        {
            echo "<div class='alert alert-danger'>" .$_SESSION['error'] ."</div>";
            unset($_SESSION['error']);
        }
        if(isset($_SESSION['success']) && !empty($_SESSION['success']))
        {
            echo "<div class='alert alert-success'>" .$_SESSION['success'] ."</div>";
            unset($_SESSION['success']);
        }
        ?>
       <div class="row">
        <?php
            if(isset($_SESSION['users']) && $_SESSION['users'] !== false && !empty($_SESSION['users']))
            {?>
            <table class='table'>
                <tr>
                    <th>#ID</th>
                    <th>Username</th>
                    <th>Nickname</th>
                    <th>Joint at</th>
                    <th>Last Login</th>
                    <th>Status</th>
                    <th>Duration</th>
                    <th>Edit Post</th>
                </tr>
                <?php
                    foreach($_SESSION['users'] as $value)
                    {?>
                        <tr>
                            <td><?= $value['id']; ?></td>
                            <td><?= $value['username']; ?></td>
                            <td><?= $value['nickname']; ?></td>
                            <td><?= $value['created_at']; ?></td>
                            <td><?= $value['last_login']; ?></td>
                            <td>
                                <?php
                                    if($value['active'] == 1){ ?>
                                    <a class='btn btn-danger' href="../controller/ban.php?action=unban&id=<?= $value['id'];?>">Ban</a>
                                    <?php
                                    }else{ ?>
                                        <a class='btn btn-success' href="../controller/ban.php?action=ban&id=<?= $value['id'];?>">Active</a>                                           
                                    <?php
                                    }
                                ?>
                            </td>
                            <td><?= ($value['ban_duration'] === NULL) ? "" : $value['ban_duration']; ?></td>
                            <td>
                                <a class='btn btn-primary' href="../controller/edit.php?id=<?= $value['id']; ?>">Edit</a>
                                <a class='btn btn-danger' href="../controller/delete.php?id=<?= $value['id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php    
                    }
                ?>
            </table>
            <?php
            }else{
                echo "Users Not Found ";
            }
        ?>
       </div>
   </div> 

</body>
<?php require_once('../inc/scripts.php'); ?>