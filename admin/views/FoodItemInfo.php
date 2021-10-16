<?php 
    $headerName = 'Food Item Info';
    include("layout/topbar.php");
    include("layout/sidebar.php");
    $Id = $_GET['Id'];
    $sql = "SELECT FI.Id, FI.Name, FI.Price, FI.Discount, FI.IsAvailable, FI.IsActive,FI.DisplayPicture,FI.Description, CT.Name CategoryName, SCT.Name SubCategoryName
    FROM fooditem FI 
    INNER JOIN category CT ON CT.Id = FI.CategoryId
    INNER JOIN subcategory SCT ON SCT.Id = FI.SubCategoryId
    WHERE FI.Id = '$Id'";
    $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sql));
    
    $status = $queryResult['IsActive']; $whichStatus = '';
    $isAvailable = $queryResult['IsAvailable']; $whichAvailable = '';
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
?>

<style>
    .information tr th{
        text-align: left;
    }
    .bottom{
        margin-bottom: 10px !important;
    }
</style>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item active" href="FoodItem.php">Food Items</a>
        <a class="breadcrumb-item active" href="#">Food Item Info</a>
    </nav>
</div><!-- br-pageheader -->

<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Food Item Info</h6>
            <div class="table-wrapper">
                <div class = "row">
                    <div class = "col-md-8 col-sm-8 col-lg-8">
                        <table class = "table table-borderless information">
                            <tr>
                                <th>Name: </th>
                                <td><?php echo $queryResult['Name'];?></td>
                            </tr>
                            <tr>
                                <th>Price: </th>
                                <td><?php echo $queryResult['Price'];?></td>
                            </tr>
                            <tr>
                                <th>Discount: </th>
                                <td><?php echo $queryResult['Discount'];?></td>
                            </tr>
                            <tr>
                                <th>Category Name: </th>
                                <td><?php echo $queryResult['CategoryName'];?></td>
                            </tr>
                            <tr>
                                <th>Sub Category Name: </th>
                                <td><?php echo $queryResult['SubCategoryName'];?></td>
                            </tr>
                            <tr>
                                <th>Description: </th>
                                <td><?php echo $queryResult['Description'];?></td>
                            </tr>
                            <tr>
                                <th>Availability: </th>
                                <td><?php echo $whichAvailable;?></td>
                            </tr>
                            <tr>
                                <th>Status: </th>
                                <td><?php echo $whichStatus;?></td>
                            </tr>
                            <tr>
                                <th>Display Image: </th>
                                <td><img src = "../../<?php echo $queryResult['DisplayPicture'];?>" height = "100" width = "100"></td>
                            </tr>
                        </table>
                    </div>
                    <div class = "col-md-4 col-sm-4 col-lg-4">
                        <h4>Other Images</h4>
                        <div class = "row">
                            <?php 
                                $sql = "SELECT * FROM `images` WHERE FoodItemId = '$Id'";
                                $queryResult = mysqli_query($con, $sql);
                                while($row = mysqli_fetch_assoc($queryResult)){
                                    $imageUrl = $row['PhotoUrl'];
                                    echo "<div class = 'col-md-6 col-sm-6 col-lg-6 bottom'>
                                    "."<img src = '../../$imageUrl' alt = 'Image' height = '100' width = '100'>"."</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-4 form-group">
                        <a class="btn custombtn float-left" href = "FoodItem.php" style="background-color: #E0E0E0 !important; color: black !important; margin-left: 15px;">Back</a>
                    </div>
                    <div class="col-md-4 form-group">

                    </div>
                    <div class="col-md-4 form-group">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include("layout/footer.php");?>