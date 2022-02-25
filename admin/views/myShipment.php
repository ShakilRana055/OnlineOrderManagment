<?php 
    $headerName = 'My Shipment';
    include("layout/topbar.php");
    include("layout/sidebar.php");
    $userId = $_SESSION['user']['Id'];
?>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item active" href="#">My Shipment</a>
    </nav>
</div><!-- br-pageheader -->

<input type = "hidden" value = "<?php echo isset($_SESSION['myShipmentList']) ? $_SESSION['myShipmentList'] : ''; unset($_SESSION['myShipmentList']);?>" id="myShipmentListMessage">
<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Shipment List</h6>
            <div class="table-wrapper">
                <table style="width:100%" id="myShipmentList" class="table display responsive nowrap tableStyle">
                    <thead>
                        <tr>
                            <th>Invoice No.</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Grand Total</th>
                            <th>Discount</th>
                            <th>Order Date</th>
                            <th>Delivery Charge</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT P.*, CUS.Name CustomerName,CUS.Address, CUS.Phone
                                    FROM invoice P
                                    LEFT JOIN user CUS ON CUS.Id = P.CustomerId
                                    WHERE Status in ('Shipping', 'Delivered') AND P.DeliveryManId = '$userId'
                                    ORDER BY Id DESC";
                            $queryResult = mysqli_query($con, $sql);
                            foreach ($queryResult as $row){
                                $id = $row['Id']; 
                                $invoiceNumber = $row['InvoiceNumber']; 
                                $customerName = $row['CustomerName'];
                                $address = $row['Address'];
                                $Phone = $row['Phone'];
                                $grandTotal = $row['GrandTotal'];
                                $discount = $row['Discount'];
                                $orderDate = $row['OrderDate'];
                                $deliveryCharge = $row['DeliveryCharge'];
                                $Status = $row['Status'];

                                $whichStatus = '';
                                if($Status == 'Shipping') $whichStatus = '<span class="badge badge-primary">Shipping</span>';
                                else if($Status == 'Delivered') $whichStatus = '<span class="badge badge-success">Delivered</span>'; 
                               
                                $buttons = '';
                                if($Status == 'Shipping'){
                                    $buttons .= "<button class = 'btn btn-danger btn-sm orderProcess' action = 'cancel' title = 'Cancel' url = '../controller/PendingOrderController.php?orderCancel=$id' ><i class='fas fa-window-close'></i></button>";
                                    $buttons .= "<button class = 'btn btn-success btn-sm orderProcess' action = 'deliver' title = 'Delivered' url = '../controller/PendingOrderController.php?deliverOrder=$id' ><i class='fas fa-money-bill-wave'></i></button>";
                                }
                                $buttons .= "<button class = 'btn btn-info btn-sm btnInfo' title = 'Info' invoiceId='$id' ><i class='fa fa-info-circle'></i></button>";

                                echo '<tr>
                                        <td>'.$invoiceNumber.'</td>
                                        <td>'.$customerName.'</td>
                                        <td>'.$address.'</td>
                                        <td>'.$Phone.'</td>
                                        <td>'.$grandTotal.'</td>
                                        <td>'.$discount.'</td>
                                        <td>'.$orderDate.'</td>
                                        <td>'.$deliveryCharge.'</td>
                                        <td>'.$whichStatus.'</td>
                                        <td>'.$buttons.'</td>
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
<script src="../public/javaScript/MyShipment.js"></script>