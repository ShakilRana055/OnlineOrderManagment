<?php 
session_start();
    $topBanner = true;
    $shopPage = true;
    $title = 'Online Food Service - Shopping- Cart';
    $pageName = 'Shopping Cart';
    include('layout/topbar.php');
?>

<?php
    $userId = 0; 
    if(isset($_SESSION['customer'])){
        $userId = $_SESSION['customer']['Id'];
    }

    $sql = "SELECT * FROM user WHERE Id = '$userId'";
    $userInfo = mysqli_fetch_assoc(mysqli_query($con, $sql));
?>

<style>
    #shopping-cart thead tr th, tbody tr td{
        text-align : center;
    }

    #shopping-cart thead tr{
        background-color: #b3e6ff;
    }

</style>


    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <table class = 'table table-hover table-bordered' id = 'shopping-cart'>
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id = 'shoppingCartList'>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan = "5" style = "text-align:right">Grand Total</td>
                                <td style = "text-align:center;"><span id = 'grandTotal'></span> ৳</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-lg-4 col-md-4">
                <div class="product__details__text">
                        <h3><?php echo $userInfo['Name'];?></h3>
                        
                        <table class = "table table-borderless" style = "text-align:center;">
                            <tr><td>Email</td><td><?php echo $userInfo['Email'];?></td></tr>
                            <tr><td>Phone</td><td><input type = "number" value = "<?php echo $userInfo['Phone'];?>" id= "phone" class = "form-control"/></td></tr>
                            <tr><td>Address</td><td><textarea cols = "3" id= "address" class = "form-control"><?php echo $userInfo['Address'];?> </textarea></td></tr>
                            <tr><td>Delivery Date</td><td><input type = "date" data-date-format="dd-mm-yyyy" id = "deliveryDate" class = "form-control" /></td></tr>
                        </table>
                        <button type="button" id = 'confirmOrder' class="btn btn-success btn-lg btn-block">Confirm Order</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
  
<?php include('layout/footer.php');?>
<script src="../scripts/shopping-cart.js"></script>

