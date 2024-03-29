<?php

 include('../../connection/DatabaseConnection.php');
 $indexPage = false;
 $shopPage = false;

$customerId = 0;
if(isset($_SESSION['customer'])) $customerId = $_SESSION['customer']['Id'];

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Food Order System</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../public/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../public/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/style.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="../public/bondi.jpg" height = "80" width = "300" alt=""></a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li><a href="#"><i class="fa fa-shopping-bag"></i> <span>3</span></a></li>
            </ul>
            <div class="header__cart__price">item: <span>$150.00</span></div>
        </div>
        
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Home</a></li>
                <li><a href="./shop-grid.html">Shop</a></li>
                <?php if(isset($_SESSION['customer']))
                        {?> 
                            <li><a href="./shoping-cart.html">Shoping Cart</a></li> 
                     <?php }?>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./contact.html">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> test@gmail.com</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-4">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> test@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="header__top__right">
                            <div class="header__top__right__auth">
                            <?php if(isset($_SESSION['customer']))
                                {?> 
                                    <a href="../controller/LoginActionController.php?logout=logout"><i class="fa fa-user"></i> Logout</a>
                                <?php }
                                else {?>
                                    <a href="CustomerLogin.php"><i class="fa fa-user"></i> Login</a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="header__top__right">
                            <div class="header__top__right__auth">
                            <?php if(isset($_SESSION['customer']) == false)
                                {?> 
                                    <a href="CustomerRegistration.php"><i class="fa fa-user"></i> Registration</a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="../public/bondi.jpg" height = "80" width = "300" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class = "<?php echo $indexPage == true ? "active" : ''; ?>" ><a href="index.php">Home</a></li>
                            <li class = "<?php echo $shopPage == true ? "active" : ''; ?>"><a href="shop.php">Shop</a></li>
                            <?php if(isset($_SESSION['customer']))
                                {?> 
                                    <li><a href="./shoping-cart.php">Shoping Cart</a></li> 
                                    <li><a href="./my-cart.php">My Cart</a></li>
                            <?php }?>
                            
                        </ul>
                    </nav>
                </div>
               
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero  hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All Categories</span>
                        </div>
                        <ul>
                            <?php 
                                $sql = "SELECT * FROM `category` WHERE IsActive = 1 ORDER BY Id DESC";
                                $queryResult = mysqli_query($con, $sql);
                                while($row = mysqli_fetch_assoc($queryResult)){
                                    $categoryName = $row['Name'];
                                    $categoryId = $row['Id'];
                                    echo '<li>
                                        <a href = "shop.php?categoryId='.$categoryId.'">'.$categoryName.'</a>
                                    </li>';
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>01776455789</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->
    <?php if($topBanner == true) {?>
    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="../public/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2><?php echo $title;?></h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <span><?php echo $pageName;?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <?php }?>