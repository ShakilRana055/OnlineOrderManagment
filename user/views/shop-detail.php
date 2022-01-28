<?php 
    $topBanner = true;
    $shopPage = true;
    $title = 'Online Food Service - Shop Detail';
    $pageName = 'Shop Detail';
    include('layout/topbar.php');

    $foodItemId = $_GET['foodItemId'];

    $getImage = "SELECT FD.*, CT.Name CategoryName, SB.Name SubCategoryName
                FROM fooditem FD
                INNER JOIN category CT ON CT.Id = FD.CategoryId
                INNER JOIN subcategory SB ON SB.Id = FD.SubCategoryId
                WHERE FD.IsAvailable = 1 AND FD.IsActive = 1 AND FD.Id  = $foodItemId";
    $foodItemInfo = mysqli_fetch_assoc(mysqli_query($con, $getImage));
?>


    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="<?php echo '../../'.$foodItemInfo['DisplayPicture'];?>" alt="nothing">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">

                        <?php 
                                $getDetailImage = "SELECT * 
                                FROM `images` 
                                WHERE `FoodItemId` = $foodItemId";
                                $imageResult = mysqli_query($con, $getDetailImage);
                                while($row = mysqli_fetch_assoc($imageResult)){
                                    $photoUrl = $row['PhotoUrl'];
                                    echo '<img data-imgbigurl="../../'.$photoUrl.'"
                                    src="../../'.$photoUrl.'" alt="">';
                                }
                        ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $foodItemInfo['Name'];?></h3>
                        
                        <div class="product__details__price">৳<?php echo number_format($foodItemInfo['Price']  - (($foodItemInfo['Price'] * $foodItemInfo['Discount']) / 100)); ?></div>
                        <p><?php echo $foodItemInfo['Description'];?></p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" id = "cartQuantity" value="1">
                                </div>
                            </div>
                        </div>
                        <a href="" id = "addToCart" foodItemId = "<?php echo $foodItemId;?>" class="primary-btn">ADD TO CARD</a>
                        <!-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> -->
                        <ul>
                            <li>
                                <b>Availability</b> 
                                                <span><div class="spinner-grow text-success" style="width: 2rem; height: 2rem;" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                        </div>
                                                In Stock</span>
                            </li>
                            <li><b>Regular Price</b> <span><?php echo number_format($foodItemInfo['Price'], 2);?></span></li>
                            <li><b>Discount</b> <span><?php echo number_format($foodItemInfo['Discount'], 2);?></span></li>
                            <li><b>Category</b> <span><?php echo $foodItemInfo['CategoryName'];?></span> </li>
                            <li><b>Sub Category</b> <span><?php echo $foodItemInfo['SubCategoryName'];?></span> </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

<?php include('layout/footer.php');?>

<script>
    (fucntion(){
        let selector = {
            addToCart : $("#addToCart"),
            cartQuantity : $("#cartQuantity"),
        };
        
        function GenerateLink(foodItemId, quantity){
            let saveToCartUrl = `../controller/CustomerController.php?foodItemId=${foodItemId}&&quantity=${quantity}`;
            selector.addToCart.attr("href", saveToCartUrl);
        }

        selector.addToCart.change(function(){
            GenerateLink($(this).attr('foodItemId'), $(this).val());
        });

        window.onload = GenerateLink(selector.cartQuantity.attr('foodItemId'), selector.cartQuantity.val());
    })();
</script>
