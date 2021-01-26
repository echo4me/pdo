<?php 
//if($_SESSION['privilege'] ===1)
require_once('../inc/navbar.php'); 
if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']))
{
    header("Location: login.php");die;
}
?>

<div class="container">
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
    <h1>Add Post</h1>
    <form action="../controller/create.php" method="POST">
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" name="title" class='form-control' autocomplete="off">
        </div>
        <div class="form-group">
            <label>Post</label>
            <textarea name="body" class='form-control'></textarea>
        </div>

        <div class="form-group">
            
            <input type="submit" name="sumbit" value="Add Post" class='btn btn-primary'>
        </div>
    </form>
</div>

<?php require_once('../inc/scripts.php'); ?>