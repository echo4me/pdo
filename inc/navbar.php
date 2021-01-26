<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <title>Document</title>
</head>
<body>
<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
        
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="<?= ($_SESSION['img_path']) ?? '../inc/logo.jpg' ;?>"  alt="logo" style="max-width:50px;border-radius: 50%;">
          <?php
            if(isset($_SESSION['nickname']) && !empty($_SESSION['nickname'])){ echo $_SESSION['nickname']; }else{ echo "Hello Guest"; }
          ?>
        </a>
      
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <?php
          
            if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin']))
            {
              switch ($_SESSION['privilege']) {
                case 0:
                  ?>
                  <a class="dropdown-item" href="../views/create.php">Create Post</a>
                  <?php
                  break;
                case 1:
                  ?>
                  <a class="dropdown-item" href="../views/create.php">Create Post</a>
                  <a class="dropdown-item" href="../controller/index.php">List Post</a>
                  <a class="dropdown-item" href="../controller/users.php">Users</a>
                  <div class="dropdown-divider"></div>
                  <?php
                  break;
              }
              ?>
              <a class="dropdown-item" href="../views/change_password.php">Change My Password</a>
              <a class="dropdown-item" href="../views/change_email.php">Change My Email</a>
              <a class="dropdown-item" href="../views/nickname.php">Change My Nickname</a>
              <a class="dropdown-item" href="../views/uploads.php">Change My Photo</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../views/logout.php">Logout</a>
              <?php
            }else{
              echo '<a class="dropdown-item" href="../views/login.php">Login</a>';
              echo '<a class="dropdown-item" href="../views/register.php">register</a>';
            }
          ?>
          
          
        </div>
      </li>
     
    </ul>

  </div>
</nav>
</div>