<?php require_once('../inc/navbar.php'); ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
        <div class="card card-signin flex-row my-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">Register</h5>
            <form  action="../controller/register.php" method="POST">
              <div class="form-label-group">
                <label for="inputUserame">Username</label>
                <input type="text" id="inputUserame" name="username" class="form-control" placeholder="Username" required autofocus>
              </div>

              <div class="form-label-group">
                <label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail"  name="email" class="form-control" placeholder="Email address" required>
              </div>
              
              <hr>

              <div class="form-label-group">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
              </div>
              
              <div class="form-label-group">
                <label for="inputConfirmPassword">Confirm password</label>
                <input type="password" id="inputConfirmPassword" name="passwordconfirm" class="form-control" placeholder="Password" required>
                
              </div>

              <input type='submit' class="btn btn-lg btn-primary btn-block text-uppercase" name="submit" value="submit"> 
              <a class="d-block text-center mt-2 small" href="#">Sign In</a>
              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php require_once('../inc/scripts.php'); ?>
