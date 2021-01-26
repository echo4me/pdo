<?php 
require_once('../inc/navbar.php'); 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
    header("Location: create.php");die;
}
?>
<div class="container">
    <br><h1>Login</h1><br>
    <form action="../controller/login.php" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input type="text" class="form-control" name="username">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password">
    </div>
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <div class="form-group">
        <input type="submit" value="Login" class="btn btn-primary" name="login">
    </div>
    <div class="form-group">
        <small><a href="password_rest.php">Forget Password !</a></small>
    </div>
    </form>
</div>

<?php require_once('../inc/scripts.php'); ?>