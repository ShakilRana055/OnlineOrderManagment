<?php 
    $headerName = 'Food Item Update';
    include("layout/topbar.php");
    include("layout/sidebar.php");
    $id = $_GET['Id'];
    $sql = "SELECT * FROM fooditem WHERE Id = $id";
    $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sql));
?>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item" href="FoodItem.php">Food Item List</a>
        <a class="breadcrumb-item active" href="#">Update Food Item</a>
    </nav>
   
</div>


<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Food Item Update</h6>
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <form action = "../controller/FoodItemController.php" enctype="multipart/form-data" method="post">
                    <input type = "hidden" value = "<?php echo $id;?>" name = "Id" />
                    <div asp-validation-summary="ModelOnly" class="text-danger"></div>
                        <div class="form-row">
                            
                            <div class="col-md-4 form-group">
                                <label class="control-label">Name<sup>*</sup></label>
                                <input name = "Name" id="Name" value = "<?php echo $queryResult['Name'];?>" required class="form-control" />
                                <span validation-for="Name" class="text-danger"></span>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Price<sup>*</sup></label>
                                <input type= "number" min = "1" value = "<?php echo $queryResult['Price'];?>" name = "Price" id="Price" required class="form-control" />
                                <span validation-for="Price" class="text-danger"></span>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Discount<sup>*</sup></label>
                                <input type="number" min = "1" max = "100" value = "<?php echo $queryResult['Discount'];?>" required name = "Discount" id="Discount" class="form-control" />
                                <span validation-for="Code" class="text-danger"></span>
                            </div>
                            <div class="col-md-4 form-group">
                                <label class="control-label">Category</label>
                                <select  name = "CategoryId" id="CategoryId" class="form-control select2">
                                    <?php 
                                        $sql = "SELECT * FROM `category` WHERE IsActive = 1 ORDER BY Id DESC";
                                        $Result = mysqli_query($con, $sql);
                                        while($row = mysqli_fetch_assoc($Result)){
                                            $id = $row['Id']; $name = $row['Name']; $code = $row['Code'];
                                            if($queryResult['CategoryId'] == $id){
                                                echo "<option selected = selected value = '$id'>$name ($code)</option>";
                                            }else{
                                                echo "<option value = '$id'>$name ($code)</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <span validation-for="Code" class="text-danger"></span>
                            </div>

                            <div class="col-md-4 form-group">
                                <label class="control-label">Sub Category</label>
                                <select  name = "SubCategoryId" id="SubCategoryId" class="form-control select2">
                                <?php 
                                        $sql = "SELECT * FROM `subcategory` WHERE IsActive = 1 ORDER BY Id DESC";
                                        $Result = mysqli_query($con, $sql);
                                        while($row = mysqli_fetch_assoc($Result)){
                                            $id = $row['Id']; $name = $row['Name']; $code = $row['Code'];
                                            if($queryResult['SubCategoryId'] == $id){
                                                echo "<option selected = selected value = '$id'>$name ($code)</option>";
                                            }else{
                                                echo "<option value = '$id'>$name ($code)</option>";
                                            }
                                        }
                                    ?>
                                </select>
                                <span validation-for="Code" class="text-danger"></span>
                            </div>

                            <div class="col-md-4 form-group">
                                <label class="control-label">Display Picture</label>
                                <input type="file" accept=".jpg, .jpeg, .png, .JPG, .JPEG, .PNG" style = 'border:none;' name = "DisplayPicture" id="DisplayPicture" class="form-control" />
                                <span validation-for="DisplayPicture" class="text-danger"></span>
                            </div>

                            <div class="col-md-8 form-group">
                                <label class="control-label">Description</label>
                                <textarea type="text" cols = "3" name = "Description" id="Description" class="form-control" ><?php echo $queryResult['Description'];?> </textarea>
                                <span validation-for="Description" class="text-danger"></span>
                            </div>

                            <div class="col-md-4 form-group">
                                <label class="control-label">Other Picture</label>
                                <input type="file" accept=".jpg, .jpeg, .png, .JPG, .JPEG, .PNG" multiple style = 'border:none;' name = "OtherPicture[]" id="OtherPicture" class="form-control" />
                                <span validation-for="OtherPicture" class="text-danger"></span>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="IsAvailable"> Is Available</label>
                                <input name="IsAvailable" <?php echo $queryResult['IsAvailable'] == 1 ? "checked" : "";?> id="IsAvailable" type="checkbox" />
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="IsActive"> Is Active</label>
                                <input name="IsActive"  <?php echo $queryResult['IsActive'] == 1 ? "checked" : "";?> type="checkbox" />
                            </div>
                        </div>
                       
                        
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <a class="btn custombtn float-left" href = "FoodItem.php" style="background-color: #E0E0E0 !important; color: black !important; margin-left: 15px;">Back</a>
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
<script>
    (function(){
        window.onload = function(){

            $('.select2').select2();
        }
    })();
</script>