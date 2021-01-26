<?php require_once('../inc/navbar.php'); ?>
<?php 
require_once('../inc/navbar.php'); 
if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']))
{
    header("Location: login.php");die;
}
?>
   <div class="container">
       <br><h1>Our Posts</h1><br>
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
            if(isset($_SESSION['posts']) && $_SESSION['posts'] !== false && !empty($_SESSION['posts']))
            {?>
            <table class='table'>
                <tr>
                    <th>#ID</th>
                    <th>Title</th>
                    <th>Body</th>
                    <th>Status</th>
                    <th>Edit Post</th>
                </tr>
                <?php
                    foreach($_SESSION['posts'] as $value)
                    {?>
                        <tr>
                            <td><?= $value['id']; ?></td>
                            <td><?= $value['title']; ?></td>
                            <td><?= $value['body']; ?></td>
                            <td>
                                <?php
                                    if($value['approved'] == 1){ ?>
                                    <a class='btn btn-danger' href="../controller/approval.php?action=unapproved&id=<?= $value['id'];?>">Un Approved</a>
                                    <?php
                                    }else{ ?>
                                        <a class='btn btn-success' href="../controller/approval.php?action=approved&id=<?= $value['id'];?>">Approved</a>                                           
                                    <?php
                                    }
                                ?>
                            </td>
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
                echo "Posts Not Found ";
            }
        ?>
       </div>
   </div> 

</body>
<?php require_once('../inc/scripts.php'); ?>