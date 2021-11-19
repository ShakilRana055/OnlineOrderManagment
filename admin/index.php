<?php include("LoginAction.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login - Online Food Service</title>

    <!-- vendor css -->
    <link href="public/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="public/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="public/css/bubbles.css" rel="stylesheet" />
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="public/css/bracket.css">
</head>

<body>

    <div class="main-w3layouts wrapper">
        <div>
            <img style="width:8%; display:block; margin-left:auto; margin-right:auto" src="public/bondi.jpg" />
        </div>
        <input type = "hidden" val = "<?php echo $_SESSION['PasswordChange'];?>" id = "passwordChangeMessage" >
        <div style="" class="main-agileinfo">
            <div class="agileits-top">
                <h1 style="color:black !important;">Online Food Service</h1>
                <h4 style="margin-bottom:10px;color: black !important; display: flex; justify-content: center;">Sign In</h4>
                <form class="form-horizontal" method = "post" action ="" enctype="multipart/form-data" data-parsley-validate>
                   
                    <div class="tx-center text-danger mg-b-10"><?php echo $msg;?></div>
                    

                    <div class="form-group">
                        <label class='control-label'>Email</label>
                        <input type = "email" name="Email" class="form-control" placeholder= "Email here .."/>
                    </div>

                    <div class="form-group">
                        <label class='control-label'>Password</label>
                        <input type = "password" name="Password" class="form-control" placeholder= "Password Here .."/>
                    </div>
                    <button type="submit" name = "submit" style="background: #555555; color:white; font-size: 15px; font-weight: bolder; " class="btn btn-block">Sign In</button>
                </form>

            </div>

        </div>
        <div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div style="color: #555555; text-align:center">
                        <span>Version: Food Service 1.0 <span style="margin-left:20px;">Release Date : 1-Nov-2021</span></span>
                    </div>
                </div>
                
            </div>
        </div>

    </div>

    <script src="public/jquery/jquery.min.js"></script>
    <script src="public/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="public/parsleyjs/parsley.min.js"></script>
    <script src="public/notify/notify.js"></script>
    <script src="public/javaScript/notification.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            var errorMessage = "";
            if (errorMessage && errorMessage !="") {
                $.notify(errorMessage, "error");
            }

            let message = $("#passwordChangeMessage").val();
            $("#passwordChangeMessage").val('');
            if (message && message =="success") {
                Success('Category Created Successfully');
            }
        });
    </script>
</body>
</html>