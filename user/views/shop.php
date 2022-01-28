<?php 
session_start();
    $topBanner = true;
    $shopPage = true;
    $title = 'Online Food Service - Shop';
    $pageName = 'Shop';
    include('layout/topbar.php');
?>

<?php
    $query = "SELECT MAX(`Price`) MaxPrice, MIN(`Price`) MinPrice
            FROM `fooditem` 
            WHERE `IsAvailable` = 1 AND `IsActive` = 1";
    
    $priceSlab = mysqli_fetch_assoc(mysqli_query($con, $query));
    $minPrice = $priceSlab['MinPrice'];
    $maxPrice = $priceSlab['MaxPrice'];
?>

<?php
    function LatestProductItems($con)
    {
        $latestProduct = "SELECT * 
        FROM `fooditem` 
        WHERE `IsAvailable` = 1 AND `IsActive` = 1
        ORDER BY `CreatedDate` DESC
        LIMIT 3";
        $latestProductResult = mysqli_query($con, $latestProduct);
        while($row = mysqli_fetch_assoc($latestProductResult)){
            $foodItemId = $row['Id'];
            $name = $row['Name'];
            $price = number_format($row['Price'], 2) ;
            $displayPicture = $row['DisplayPicture'];

            echo 
            '<a href="shop-detail.php?foodItemId='.$foodItemId.'" class="latest-product__item">
                <div class="latest-product__item__pic">
                    <img src="../../'.$displayPicture.'" height = "15" width = "15" alt="">
                </div>
                <div class="latest-product__item__text">
                    <h6>'.$name.'</h6>
                    <span>৳'.$price.'</span>
                </div>
            </a>';

        }
    }
?>

    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="<?php echo $minPrice;?>" data-max="<?php echo $maxPrice;?>">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <?php LatestProductItems($con);?>

                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <?php LatestProductItems($con);?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">

                                <?php 
                                    $discountPrice = "SELECT FD.*, CT.Name CategoryName
                                    FROM fooditem FD
                                    INNER JOIN category CT ON CT.Id = FD.CategoryId
                                    WHERE FD.IsAvailable = 1 AND FD.IsActive = 1 AND FD.Discount > 1
                                    ORDER BY Discount DESC
                                    LIMIT 5";

                                    $discountPriceResult = mysqli_query($con, $discountPrice);

                                    while($row = mysqli_fetch_assoc($discountPriceResult)){
                                        $foodItemId = $row['Id'];
                                        $name = $row['Name'];
                                        $displayPicture = $row['DisplayPicture'];
                                        $categoryName = $row['CategoryName'];
                                        $discountPrice = $row['Discount'];
                                        $regularPrice = number_format($row['Price'], 2) ;
                                        $afterDiscount = number_format($row['Price']  - (($row['Price'] * $row['Discount']) / 100));

                                        echo '<div class="col-lg-4 col-sm-4 col-md-4">
                                                <div class="product__discount__item">
                                                    <div class="product__discount__item__pic set-bg"
                                                        data-setbg="../../'.$displayPicture.'">
                                                        <div class="product__discount__percent">-'.$discountPrice.'%</div>
                                                        <ul class="product__item__pic__hover">
                                                            <li><a href="shop-detail.php?foodItemId='.$foodItemId.'"><i class="fa fa-info-circle"></i></a></li>
                                                            <li><a href="../controller/CustomerController.php?favorites='.$foodItemId.'"><i class="fa fa-heart"></i></a></li>
                                                            <li><a href="../controller/CustomerController.php?removeCart='.$foodItemId.'"><i class="fa fa-retweet"></i></a></li>
                                                            <li><a href="../controller/CustomerController.php?foodItemId='.$foodItemId.'&&quantity=1"><i class="fa fa-shopping-cart"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="product__discount__item__text">
                                                        <span>'.$categoryName.'</span>
                                                        <h5><a href="#">'.$name.'</a></h5>
                                                        <div class="product__item__price">৳'.$afterDiscount.' <span>৳'.$regularPrice.'</span></div>
                                                    </div>
                                                </div>
                                            </div>';
                                    }

                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Latest to Old</option>
                                        <option value="1">Old to Latest</option>
                                        <option value="2">Price Low to High</option>
                                        <option value="3">Price High to Low</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>16</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <?php 
                            $foodItems = 'SELECT *
                            FROM fooditem 
                            WHERE IsAvailable = 1 AND IsActive = 1 ';
                            if(isset($_GET['categoryId'])){
                                $categoryId = $_GET['categoryId'];
                                $foodItems .= 'AND CategoryId = '.$categoryId.'';
                            }
                            $foodItems .= ' ORDER BY CreatedDate DESC';
                            $foodItemsResult = mysqli_query($con, $foodItems);

                            while($row = mysqli_fetch_assoc($foodItemsResult)){
                                $foodItemId = $row['Id'];
                                $displayPicture = $row['DisplayPicture'];
                                $name = $row['Name'];
                                $afterDiscount = number_format($row['Price']  - (($row['Price'] * $row['Discount']) / 100));
                                
                                echo '<div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="../../'.$displayPicture.'">
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="shop-detail.php?foodItemId='.$foodItemId.'"><i class="fa fa-info-circle"></i></a></li>
                                                    <li><a href="../controller/CustomerController.php?favorites='.$foodItemId.'"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="../controller/CustomerController.php?removeCart='.$foodItemId.'"><i class="fa fa-retweet"></i></a></li>
                                                    <li><a href="../controller/CustomerController.php?foodItemId='.$foodItemId.'&&quantity=1"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__item__text">
                                                <h6><a href="#">'.$name.'</a></h6>
                                                <h5>৳'.$afterDiscount.'</h5>
                                            </div>
                                        </div>
                                    </div>';

                            }
                        ?>
                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <input type = "hidden" id = 'CartAdded' value = "<?php echo isset($_SESSION['CartAdded']) ? $_SESSION['CartAdded'] : ''; unset($_SESSION['CartAdded']); ?>"/>
        <input type = "hidden" id = 'CartRemove' value = "<?php echo isset($_SESSION['CartRemove']) ? $_SESSION['CartRemove'] : ''; unset($_SESSION['CartRemove']); ?>"/>
        <input type = "hidden" id = 'Favorites' value = "<?php echo isset($_SESSION['Favorites']) ? $_SESSION['Favorites'] : ''; unset($_SESSION['Favorites']); ?>"/>
    
    </section>

<?php include('layout/footer.php');?>
<script src="../scripts/shopping-cart.js"></script>