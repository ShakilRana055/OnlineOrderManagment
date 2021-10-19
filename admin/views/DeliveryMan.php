<?php 
    $headerName = 'Delivery Man';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item active" href="#">Delivery Man List</a>
    </nav>
</div><!-- br-pageheader -->
<div class="br-pagetitle">
    <div class="w-100">
        <h4>
            Delivery Man List
            <a style="color:black !important;" class="btn btn-sm custombtn float-right" href="DeliveryManCreate.php" title="Add New">Add New</a>
        </h4>
        <p class="mg-b-0">All recorded Delivery Man listing here.</p>
    </div>
</div><!-- d-flex -->
<input type = "hidden" value = "<?php echo $_SESSION['DeliveryManCreate']; unset($_SESSION['DeliveryManCreate']);?>" id="deliveryManMessage">
<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Delivery Man List</h6>
            <div class="table-wrapper">
                <table style="width:100%" id="deliveryManList" class="table display responsive nowrap tableStyle">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT * FROM `user` WHERE RoleName = 'DeliveryMan' ORDER BY Id DESC";
                            $queryResult = mysqli_query($con, $sql);
                            while($row = mysqli_fetch_assoc($queryResult)){
                                $id = $row['Id']; $name = $row['Name'];
                                $email = $row['Email']; $phone = $row['phone']; $address = $row['Address'];
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
                                        <td>'.$address.'</td>
                                        <td>'.$whichStatus.'</td>
                                        <td>'.$createdDate.'</td>
                                        <td>'."<a class = 'btn btn-success btn-sm' href = 'DeliveryManUpdate.php?Id=$id' id = '$id' ><i class='fas fa-edit'></i></a>".'</td>
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

<script src="../public/javaScript/DeliveryMan.js"></script>