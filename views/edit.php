<?php 
require_once('../inc/navbar.php'); 

if($_SESSION['loggedin'] !== true || !isset($_SESSION['loggedin'])) { header("Location: login.php"); }
///
if(isset($_SESSION['posts']) && count($_SESSION['posts']) > 0){
    ?>
    <div class="container">
    <br><h1>Edit My Post</h1><br>
    <form action="../controller/edit.php" method="POST">
    <input type="hidden" name="id" value="<?= $_SESSION['posts']['id'];?>">
    <div class="form-group">
        <label for="exampleInputEmail1">Title</label>
        <input type="text" class="form-control" name="title" value="<?= $_SESSION['posts']['title'];?>">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Body</label>
        <textarea name="body" class='form-control'><?= $_SESSION['posts']['body'];?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" value="Update Post" class="btn btn-primary" name="login" >
    </div>

    </form>
</div>
<?php
unset($_SESSION['posts']);
}else{
    $_SESSION['error'] = "You are not Authorized to Edit this Post";
    header('refresh:.2;url=../views/index.php');
}

?>


<?php require_once('../inc/scripts.php'); ?>