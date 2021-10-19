<?php 
    $headerName = 'Add User';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item" href="AddUser.php">Add User</a>
    </nav>
   
</div>

<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Add User</h6>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                <input type = "hidden" value = "<?php echo $_SESSION['AddUserCreate']; unset($_SESSION['AddUserCreate']);?>" id="AddUserMessage">
                    <form action = "../controller/UserController.php" enctype="multipart/form-data" method="post">
                    <div asp-validation-summary="ModelOnly" class="text-danger"></div>
                        <div class="form-row">
                        <div class="col-md-4 form-group">
                                <label class="control-label">Role</label>
                                <select  name = "RoleName" id="Role" class="form-control ">
                                    <option value = "Admin">Admin</option>
                                    <option value = "DeliveryMan">Delivery Man</option>
                                </select>
                                <span validation-for="Code" class="text-danger"></span>
                            </div>

                            <div class="col-md-4 form-group">
                                <label class="control-label">Name<sup>*</sup></label>
                                <input name = "Name" id="Name" required class="form-control" />
                                <span validation-for="Name" class="text-danger"></span>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Phone<sup>*</sup></label>
                                <input type = "number" name = "Phone" id="Phone" required class="form-control" />
                                <span validation-for="Phone" class="text-danger"></span>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Email<sup>*</sup></label>
                                <input type= "email" min = "1" name = "Email" id="Email" required class="form-control" />
                                <span validation-for="Price" class="text-danger"></span>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Password<sup>*</sup></label>
                                <input type="password" required name = "Password" id="Password" class="form-control" />
                                <span validation-for="Password" class="text-danger"></span>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Confirm Password<sup>*</sup></label>
                                <input type="password" required name = "ConfirmPassword" id="ConfirmPassword" class="form-control" />
                                <span validation-for="ConfirmPassword" class="text-danger"></span>
                            </div>
                            
                            <div class="col-md-4 form-group">
                                <label for="IsActive"> Is Active</label>
                                <input name="IsActive" checked = "true" type="checkbox" />
                            </div>
                        </div>
                       
                        
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <!-- <a class="btn custombtn float-left" href = "FoodItem.php" style="background-color: #E0E0E0 !important; color: black !important; margin-left: 15px;">Back</a> -->
                            </div>
                            <div class="col-md-4 form-group">

                            </div>
                            <div class="col-md-4 form-group">
                                <input style="color:black !important;" type="submit" name = "Create" value="Create" class="btn custombtn float-right" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php");?>
<script src="../public/javaScript/AddUser.js"></script>