<?php require_once('../inc/navbar.php'); ?>
<?php
if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']))
{
    header("Location: login.php");die;
}
?>
<div class="container">
    <br><h1>Update Your Email Address</h1><br>
    <form action="../controller/change_email.php" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">New Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <input type="submit" value="Change Email" class="btn btn-primary" name="login">
    </form>
</div>

<?php require_once('../inc/scripts.php'); ?>