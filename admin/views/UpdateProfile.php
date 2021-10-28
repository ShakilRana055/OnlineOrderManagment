<?php 
    $headerName = 'Update Profile';
    include("layout/topbar.php");
    include("layout/sidebar.php");
    $Id = $_SESSION['user']['Id'];;
    $sql = "SELECT * FROM user WHERE Id = '$Id'";
    $user = mysqli_fetch_assoc(mysqli_query($con, $sql));
?>


<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item" href="#">Update Profile</a>
    </nav>
   
</div>


<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Update Profile</h6>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <form action = '../controller/UserController.php'  method="post">
                       <input type = "hidden" value = "<?php echo $user['Id'];?>" name = 'Id'>
                       <input type = "hidden" value = "<?php echo $_SESSION['UpdateProfile']; unset($_SESSION['UpdateProfile']);?>" name = 'updateMessage' id = "updateMessage">
                    <div asp-validation-summary="ModelOnly" class="text-danger"></div>
                       
                    <div class="form-row">
                        <div class="col-md-4 form-group">
                                <label class="control-label">Name<sup>*</sup></label>
                                <input name = "Name" id="Name" required class="form-control" value = "<?php echo $user['Name'];?>" />
                                <span validation-for="Name" class="text-danger"></span>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Phone<sup>*</sup></label>
                                <input type = "number" name = "Phone" id="Phone" required class="form-control" value = "<?php echo $user['Phone'];?>" />
                                <span validation-for="Phone" class="text-danger"></span>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Email<sup>*</sup></label>
                                <input type= "email" readonly name = "Email" id="Email" required class="form-control" value = "<?php echo $user['Email'];?>" />
                                <span validation-for="Email" class="text-danger"></span>
                            </div>
                           
                        </div>
                       
                        
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <!-- <a class="btn custombtn float-left" href = "AllUser.php" style="background-color: #E0E0E0 !important; color: black !important; margin-left: 15px;">Back</a> -->
                            </div>
                            <div class="col-md-4 form-group">

                            </div>
                            <div class="col-md-4 form-group">
                                <input style="color:black !important;" type="submit" name = "UpdateProfile" value="Update Profile" class="btn custombtn float-right" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php");?>
<script src = "../public/javaScript/UpdateProfile.js"></script>