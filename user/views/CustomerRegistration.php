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

    <title>Online Food Management System - Registration</title>
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
              <h3><strong>Registration </strong></h3>
              <p style = "color:green;" id="successMsg"></p>
            </p>
            </div>
            <input type = "hidden" value = "<?php echo isset($_SESSION['UserResgister']) ? $_SESSION['UserResgister'] : ''; unset($_SESSION['UserResgister']);?>" id="allUserMessage">
            <!-- action="../controller/LoginActionController.php" -->

            <form  method="post" action="../controller/CustomerRegistrationController.php" id = "customerRegistrationForm">
                <div class="form-group first">
                    <label for="Name">Name</label>
                    <input type="text" name = "Name" class="form-control" required id="Name">
                </div>
                <div class="form-group first">
                    <label for="Email">Email</label>
                    <input type="email" name = "Email" required class="form-control" id="Email">
                </div>
                <div class="form-group first">
                    <label for="Address">Address</label>
                    <input type="text" name = "Address" class="form-control" required id="Address">
                </div>
                <div class="form-group first">
                    <label for="Phone">Phone</label>
                    <input type="text" name = "Phone" class="form-control" required id="Phone">
                </div>
                <div class="form-group last mb-4">
                    <label for="Password">Password</label>
                    <input type="Password" name = "Password"  required class="form-control" id="Password">
                </div>
                <div class="form-group last mb-4">
                    <label for="ConfirmPassword">Confirm Password</label>
                    <input type="Password" name = "ConfirmPassword" required class="form-control" id="ConfirmPassword">
                </div>
                <p style = "color:red;" id="passwordErrorMsg"></p>
                <input type="submit" value="Register" name = "Register" class="btn text-white btn-block btn-primary">
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
    <script src="../scripts/notification.js"></script>
    <script src="../scripts/customer-registration.js"></script>
  </body>
</html>