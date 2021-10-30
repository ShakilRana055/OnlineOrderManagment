<?php 
    $headerName = 'Password Change';
    include("layout/topbar.php");
    include("layout/sidebar.php");
    $Id = $_SESSION['user']['Id'];;
?>


<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item" href="#">Password Change</a>
    </nav>
   
</div>


<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Password Change</h6>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <form action = "../controller/UserController.php"  onsubmit = "return FormValidation()"  method="post">
                     <div asp-validation-summary="ModelOnly" class="text-danger"></div>
                     <input type = "hidden" value = "<?php echo $_SESSION['PasswordChange']; unset($_SESSION['PasswordChange']);?>" name = 'changePasswordMessage' id = "changePasswordMessage">
                    
                    <div class="row">
                        <div class="col-md-6 form-group">
                                <label class="control-label">New Password<sup>*</sup></label>
                                <input type = "password" name = "Password" id="newPassword" required class="form-control" />
                                <span validation-for="newPassword" class="text-danger"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label class="control-label">Confirm Password<sup>*</sup></label>
                                <input type = "password" name = "ConfirmPassword" id="confirmPassword" required class="form-control" />
                                <span id = "confirmPasswordMessage" class="text-danger"></span>
                            </div>
                        </div>
                       
                        
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <input style="color:black !important;" type="submit" name = "ChangePassword" value="Change" class="btn custombtn float-right" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php");?>
<script>
    function FormValidation(){
        let selector = {
            password :$("#newPassword"),
            confirmPassword :$("#confirmPassword"),
            confirmPasswordMessage : $("#confirmPasswordMessage")
        }

        if(selector.password.val() !== selector.confirmPassword.val()){
            selector.confirmPasswordMessage.text('Password do not matched');
            return false;
        }
        return true;
    }

    (function(){
        window.onload = function (){
            var errorMessage = selector.changePasswordMessage.val();
            selector.changePasswordMessage.val('');
            
            if(errorMessage && errorMessage =="failed"){
                Failed('Something went wrong!');
            }
        }
    })();
</script>