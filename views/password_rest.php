<?php require_once('../inc/navbar.php'); ?>
<?php
if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin']))
{
    header("Location: login.php");die;
}
?>
<div class="container">
    <br><h1>Genrate Password</h1><br>
    <form action="../controller/password_rest.php" method="POST">
    <div class="form-group">
        <label for="exampleInputEmail1">Put Your Email</label>
        <input type="email" class="form-control" name="email">
    </div>

    <div class="form-group">
        <input type="submit" value="Recover Password" class="btn btn-primary" name="login">
    </div>

    </form>
</div>

<?php require_once('../inc/scripts.php'); ?>