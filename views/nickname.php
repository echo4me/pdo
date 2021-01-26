<?php require_once('../inc/navbar.php'); ?>
<?php
if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']))
{
    header("Location: login.php");die;
}
?>
<div class="container">
    <br><h1>Update Your Nickname</h1><br>
    <form action="../controller/nickname.php" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Nickname</label>
        <input type="text" class="form-control" name="nickname">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
        <input type="submit" value="Update" class="btn btn-primary" name="login">
    </div>

    </form>
</div>

<?php require_once('../inc/scripts.php'); ?>