<?php 
session_start();
    $topBanner = true;
    $shopPage = true;
    $title = 'Online Food Service - My Cart';
    $pageName = 'My Cart';
    include('layout/topbar.php');
?>

<style>
    #shopping-cart tr td, tr th{
        text-align:center;
    }
</style>

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <table class = 'table table-hover table-bordered' id = 'shopping-cart'>
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Invoice Number</th>
                                <th>Sub Total</th>
                                <th>Grand Total </th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id = 'myCartList'>
                        <?php 
                            $sql = "SELECT *
                                    FROM invoice
                                    WHERE CustomerId = '$customerId' 
                                    ORDER BY CreatedDate DESC";
                            $result = mysqli_query($con, $sql);
                            $sl = 1;
                            while($row = mysqli_fetch_assoc($result)){
                                $invoiceNumber = $row['InvoiceNumber'];
                                $subTotal = $row['SubTotal'];
                                $grandTotal = $row['GrandTotal'];
                                $orderDate = $row['OrderDate'];
                                $deliverDate = $row['DeliveryDate'];
                                $status = $row['Status'];
                                $id = $row['Id'];
                                //
                                echo '<tr>
                                    <td>'.$sl.'</td>
                                    <td>'.$invoiceNumber.'</td>
                                    <td>'.$subTotal.'</td>
                                    <td>'.$grandTotal.'</td>
                                    <td>'.$orderDate.'</td>
                                    <td>'.$deliverDate.'</td>
                                    <td>'.$status.'</td>
                                    <td>
                                        <button invoiceId = '.$id.' class = "information btn btn-sm btn-primary">Info</button>
                                     </td>
                                </tr>';
                                $sl++;
                            }
                        ?>
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
          
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

<?php include('layout/footer.php');?>
<script src = "../scripts/my-cart.js"></script>