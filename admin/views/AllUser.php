<?php 
    $headerName = 'All User';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item active" href="#">All User List</a>
    </nav>
</div><!-- br-pageheader -->
<div class="br-pagetitle">
    <div class="w-100">
        <h4>
            User List
            <a style="color:black !important;" class="btn btn-sm custombtn float-right" href="AddUser.php" title="Add New">Add New</a>
        </h4>
        <p class="mg-b-0">All recorded User listing here.</p>
    </div>
</div><!-- d-flex -->
<input type = "hidden" value = "<?php echo $_SESSION['AllUserCreate']; unset($_SESSION['AllUserCreate']);?>" id="allUserMessage">
<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">All User List</h6>
            <div class="table-wrapper">
                <table style="width:100%" id="allUserList" class="table display responsive nowrap tableStyle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM `user` WHERE RoleName NOT IN ('SuperAdmin', 'Customer') ORDER BY Id DESC";
                            $queryResult = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($queryResult)){
                                $id = $row['Id']; $name = $row['Name']; $roleName = $row['RoleName'];
                                $email = $row['Email']; $phone = $row['Phone']; $address = $row['Address'];
                                $status = $row['IsActive']; $whichStatus = '';
                                if($status == 0){
                                    $whichStatus = '<span class="badge badge-danger">Inactive</span>';
                                }
                                else{
                                    $whichStatus = '<span class="badge badge-success">Active</span>';
                                }
                                echo '<tr>
                                        <td>'.$name.'</td>
                                        <td>'.$email.'</td>
                                        <td>'.$phone.'</td>
                                        <td>'.$roleName.'</td>
                                        <td>'.$whichStatus.'</td>
                                        <td>'."<a class = 'btn btn-success btn-sm' href = 'UpdateUser.php?Id=$id' id = '$id' ><i class='fas fa-edit'></i></a>".'</td>
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

<script src="../public/javaScript/AllUser.js"></script>