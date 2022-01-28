<?php 
    $headerName = 'Food Item';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item active" href="#">Food Items</a>
    </nav>
</div><!-- br-pageheader -->
<div class="br-pagetitle">
    <div class="w-100">
        <h4>
        Food Items
            <a style="color:black !important;" class="btn btn-sm custombtn float-right" href="FoodItemCreate.php" title="Add New">Add New</a>
        </h4>
        <p class="mg-b-0">All recorded Food Items listing here.</p>
    </div>
</div><!-- d-flex -->
<input type = "hidden" value = "<?php echo isset($_SESSION['FoodItemCreate']) ? $_SESSION['FoodItemCreate'] : '' ; unset($_SESSION['FoodItemCreate']);?>" id="FoodItemMessage">
<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Food Item List</h6>
            <div class="table-wrapper">
                <table style="width:100%" id="foodItemList" class="table display responsive nowrap tableStyle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Discount(%)</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Image</th>
                            <th>Availability</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT FI.Id, FI.Name, FI.Price, FI.Discount, FI.IsAvailable, FI.IsActive,FI.DisplayPicture, CT.Name CategoryName, SCT.Name SubCategoryName
                                    FROM fooditem FI 
                                    INNER JOIN category CT ON CT.Id = FI.CategoryId
                                    INNER JOIN subcategory SCT ON SCT.Id = FI.SubCategoryId
                                    ORDER BY FI.Id DESC";
                            $queryResult = mysqli_query($con, $sql);
                            foreach ($queryResult as $row){
                                $id = $row['Id']; $name = $row['Name'];
                                $price = $row['Price']; $discount = $row['Discount'];
                                $categoryName = $row['CategoryName'];
                                $subCategoryName = $row['SubCategoryName'];
                                $status = $row['IsActive']; $whichStatus = '';
                                $isAvailable = $row['IsAvailable']; $whichAvailable = '';
                                $image = '../../'.($row['DisplayPicture'] == null ? 'public/image/dummy.jpg' : $row['DisplayPicture']) ;

                                if($status == 0){
                                    $whichStatus = '<span class="badge badge-danger">Inactive</span>';
                                }
                                else{
                                    $whichStatus = '<span class="badge badge-success">Active</span>';
                                }

                                if($isAvailable == 0){
                                    $whichAvailable = '<span class="badge badge-danger">Not Available</span>';
                                }
                                else{
                                    $whichAvailable = '<span class="badge badge-success">Available</span>';
                                }
                                echo '<tr>
                                        <td>'.$name.'</td>
                                        <td>'.$price.'</td>
                                        <td>'.$discount.'</td>
                                        <td>'.$categoryName.'</td>
                                        <td>'.$subCategoryName.'</td>
                                        <td>'."<img src = '$image' height = '50' width = '50' />".'</td>
                                        <td>'.$whichAvailable.'</td>
                                        <td>'.$whichStatus.'</td>
                                        <td>'."<a class = 'btn btn-success btn-sm' title = 'Edit' href = 'FoodItemUpdate.php?Id=$id' id = '$id' ><i class='fas fa-edit'></i></a> <a class = 'btn btn-info btn-sm' title = 'Info' href = 'FoodItemInfo.php?Id=$id' ><i class='fa fa-info-circle'></i></a>".'</td>
                                    </tr>';
                            }
                        ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php");?>
<script src="../public/javaScript/FoodItem.js"></script>