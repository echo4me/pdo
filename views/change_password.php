<?php require_once('../inc/navbar.php'); ?>
<?php
if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']))
{
    header("Location: login.php");die;
}
?>
<div class="container">
    <br><h1>Update Your Password</h1><br>
    <form action="../controller/change_password.php" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Current Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">New Password</label>
        <input type="password" class="form-control" name="new-password">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Confirm Password</label>
        <input type="password" class="form-control" name="confirm-password">
    </div>
    <input type="submit" value="Change Password" class="btn btn-primary" name="login">
    </form>
</div>

<?php require_once('../inc/scripts.php'); ?>