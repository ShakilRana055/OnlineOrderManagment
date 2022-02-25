<?php 
    $headerName = 'Order List';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item active" href="#">Order List</a>
    </nav>
</div><!-- br-pageheader -->

<input type = "hidden" value = "<?php echo isset($_SESSION['PendingOrderList']) ? $_SESSION['PendingOrderList'] : '' ; unset($_SESSION['PendingOrderList']);?>" id="pendingOrderListMessage">
<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Order List</h6>
            <div class="table-wrapper">
                <table style="width:100%" id="pendingOrderList" class="table display responsive nowrap tableStyle">
                    <thead>
                        <tr>
                            <th>Invoice No.</th>
                            <th>Customer Name</th>
                            <th>Address</th>
                            <th>Sub Total</th>
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
                            $sql = "SELECT P.*, CUS.Name CustomerName,CUS.Address
                                    FROM invoice P
                                    LEFT JOIN user CUS ON CUS.Id = P.CustomerId
                                    WHERE Status in ('Pending', 'Shipment')
                                    ORDER BY Id DESC";
                            $queryResult = mysqli_query($con, $sql);
                            foreach ($queryResult as $row){
                                $id = $row['Id']; 
                                $invoiceNumber = $row['InvoiceNumber']; 
                                $customerName = $row['CustomerName'];
                                $address = $row['Address'];
                                $subTotal = $row['SubTotal'];
                                $grandTotal = $row['GrandTotal'];
                                $discount = $row['Discount'];
                                $orderDate = $row['OrderDate'];
                                $deliveryCharge = $row['DeliveryCharge'];
                                $Status = $row['Status'];

                                $whichStatus = '';
                                if($Status == 'Pending') $whichStatus = '<span class="badge badge-primary">Pending</span>';
                                else if($Status == 'Shipment') $whichStatus = '<span class="badge badge-warning">Shipment</span>';
                                else if($Status == 'Delivered') $whichStatus = '<span class="badge badge-success">Delivered</span>'; 
                               
                                $buttons = '';
                                if($_SESSION['user']['RoleName'] == 'Admin' && $Status == 'Pending'){
                                    $buttons .= "<button class = 'btn btn-success btn-sm orderProcess' action = 'shipment' title = 'Shipment' url = '../controller/PendingOrderController.php?shipmentId=$id' ><i class='fas fa-ship'></i></button>";
                                }
                                else if($_SESSION['user']['RoleName'] == 'DeliveryMan' && $Status == 'Shipment'){
                                    $buttons .= "<button class = 'btn btn-success btn-sm orderProcess' action = 'takeOrder' title = 'Take Order' url = '../controller/PendingOrderController.php?takeOrder=$id' ><i class='fas fa-truck'></i></button>";
                                }
                                $buttons .= "<button class = 'btn btn-info btn-sm btnInfo' title = 'Info' invoiceId='$id' ><i class='fa fa-info-circle'></i></button>";

                                echo '<tr>
                                        <td>'.$invoiceNumber.'</td>
                                        <td>'.$customerName.'</td>
                                        <td>'.$address.'</td>
                                        <td>'.$subTotal.'</td>
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
<script src="../public/javaScript/PendingOrder.js"></script>