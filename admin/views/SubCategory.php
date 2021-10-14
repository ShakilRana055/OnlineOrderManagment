<?php 
    $headerName = 'Sub Category';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item active" href="#">Sub Category List</a>
    </nav>
</div><!-- br-pageheader -->
<div class="br-pagetitle">
    <div class="w-100">
        <h4>
            Sub Category List
            <a style="color:black !important;" class="btn btn-sm custombtn float-right" href="SubCategoryCreate.php" title="Add New">Add New</a>
        </h4>
        <p class="mg-b-0">All recorded Sub Category listing here.</p>
    </div>
</div><!-- d-flex -->
<input type = "hidden" value = "<?php echo $_SESSION['SubCategoryCreate']; unset($_SESSION['SubCategoryCreate']);?>" id="subCategoryMessage">
<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Sub Category List</h6>
            <div class="table-wrapper">
                <table style="width:100%" id="subCategoryList" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Status</th>
                            <th>Created Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM `subcategory` ORDER BY Id DESC";
                            $queryResult = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($queryResult)){
                                $id = $row['Id']; $name = $row['Name'];
                                $code = $row['Code']; $createdDate = $row['CreatedDate'];
                                $status = $row['IsActive']; $whichStatus = '';
                                if($status == 0){
                                    $whichStatus = '<span class="badge badge-danger">Inactive</span>';
                                }
                                else{
                                    $whichStatus = '<span class="badge badge-success">Active</span>';
                                }
                                echo '<tr>
                                        <td>'.$name.'</td>
                                        <td>'.$code.'</td>
                                        <td>'.$whichStatus.'</td>
                                        <td>'.$createdDate.'</td>
                                        <td>'."<a class = 'btn btn-success btn-sm' href = 'SubCategoryUpdate.php?Id=$id' id = '$id' ><i class='fas fa-edit'></i></a>".'</td>
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

<script src="../public/javaScript/SubCategory.js"></script>