<?php 
    $headerName = 'Category Update';
    include("layout/topbar.php");
    include("layout/sidebar.php");
    $Id = $_GET['Id'];
    $sql = "SELECT * FROM subcategory WHERE Id = '$Id'";
    $category = mysqli_fetch_assoc(mysqli_query($con, $sql));
?>


<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item" href="SubCategory.php">Sub Category List</a>
        <a class="breadcrumb-item active" href="#">Sub Create Update</a>
    </nav>
   
</div>


<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Sub Category Update</h6>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <form action = "../controller/SubCategoryController.php" method="post">
                       <input type = "hidden" value = "<?php echo $category['Id'];?>" name = 'Id'>
                    <div asp-validation-summary="ModelOnly" class="text-danger"></div>
                        <div class="form-row">
                            
                            <div class="col-md-6 form-group">
                                <label   class="control-label">Name<sup>*</sup></label>
                                <input  name = "Name" id="Name" value ="<?php echo $category['Name'];?>" required class="form-control" />
                                <span validation-for="Name" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label   class="control-label">Code</label>
                                <input  name = "Code" id="Code" value ="<?php echo $category['Code'];?>" class="form-control" />
                                <span validation-for="Code" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 form-group">
                                <label asp-for="IsActive"> Is Active</label>
                                <input name="IsActive" <?php echo $category['IsActive'] == 1 ? "checked" : "";?> type="checkbox" />
                            </div>
                        </div>
                       
                        
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <a class="btn custombtn float-left" href = "Category.php" style="background-color: #E0E0E0 !important; color: black !important; margin-left: 15px;">Back</a>
                            </div>
                            <div class="col-md-4 form-group">

                            </div>
                            <div class="col-md-4 form-group">
                                <input style="color:black !important;" type="submit" name = "Update" value="Update" class="btn custombtn float-right" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php");?>