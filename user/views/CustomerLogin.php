<?php session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../public/login/fonts/icomoon/style.css">

    <link rel="stylesheet" href="../public/login/css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/login/css/bootstrap.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="../public/login/css/style.css">

    <title>Online Food Management System - Login</title>
    <link rel="icon" href="../public/img/core-img/favicon.ico">
  </head>
  <body>
  
  <div class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-6 order-md-2">
          <img src="../public/login/images/undraw_file_sync_ot38.svg" alt="Image" class="img-fluid">
        </div>
        <div class="col-md-6 contents">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="mb-4">
              <h3><strong>Sign In </strong></h3>
              <p class="mb-4">Order your Food</p>
              <p class="mb-4" style = "color:red;">
              <?php 
                    if(isset($_SESSION['loginErrorMsg']) == true){
                      echo $_SESSION['loginErrorMsg'];
                      unset($_SESSION['loginErrorMsg']);
                    }
                    else{
                      echo "";
                    }
                    
              ?>
            </p>
            </div>
            <form action="../controller/LoginActionController.php" method="post">
              <div class="form-group first">
                <label for="Email">Email</label>
                <input type="email" name = "Email" class="form-control" id="Email">

              </div>
              <div class="form-group last mb-4">
                <label for="Password">Password</label>
                <input type="Password" name = "Password" class="form-control" id="Password">
                
              </div>

              <input type="submit" value="Log In" name = "submit" class="btn text-white btn-block btn-primary">

              <span class="d-block text-left my-4 text-muted"> or sign in with</span>
              
              <div class="social-login">
                <a href="#" class="facebook">
                  <span class="icon-facebook mr-3"></span> 
                </a>
                <a href="#" class="twitter">
                  <span class="icon-twitter mr-3"></span> 
                </a>
                <a href="#" class="google">
                  <span class="icon-google mr-3"></span> 
                </a>
              </div>
            </form>
            </div>
          </div>
          
        </div>
        
      </div>
    </div>
  </div>

  
    <script src="../public/login/js/jquery-3.3.1.min.js"></script>
    <script src="../public/login/js/popper.min.js"></script>
    <script src="../public/login/js/bootstrap.min.js"></script>
    <script src="../public/login/js/main.js"></script>
  </body>
</html>