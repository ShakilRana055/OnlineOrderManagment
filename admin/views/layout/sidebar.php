
<div class="br-logo"><a href="#"><span></span>Online Food Service<span></span></a></div>
    <div class="br-sideleft sideleft-scrollbar">
        
        <ul style="margin-top:20px;" class="br-sideleft-menu">
            <li class="br-menu-item">
                <a href="index.php" class="br-menu-link">
                    <i class="menu-item-icon icon ion-ios-home-outline tx-24"></i>
                    <span class="menu-item-label">Dashboard</span>
                </a> 
            </li> 
            <?php if($_SESSION['user']['RoleName'] == 'SuperAdmin' || $_SESSION['user']['RoleName'] == 'Admin'){?>
                <li class="br-menu-item dummy_company_menu companyCls"  >
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon icon fas fa-users tx-18"></i>
                    <span class="menu-item-label">User Management</span>
                </a> 
                <ul class="br-menu-sub dummy_sub_company_menu">
                    <?php if($_SESSION['user']['RoleName'] == 'SuperAdmin'){
                        echo '<li class="sub-item dummy_sub_company_company subcompany"><a href="AllUser.php" class="sub-link">All User</a></li>';
                    }
                    ?>
                    <?php if($_SESSION['user']['RoleName'] == 'Admin'){
                        echo '<li class="sub-item dummy_sub_company_company subcompany"><a href="DeliveryMan.php" class="sub-link">Delivery Man</a></li>';
                    }
                    ?>
                    
                    
                </ul> 

            </li>
            <?php }
            ?>
            
            <?php if($_SESSION['user']['RoleName'] == 'SuperAdmin' || $_SESSION['user']['RoleName'] == 'Admin'){?>
                <li class="br-menu-item dummy_company_menu companyCls"  >
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon icon fas fa-drumstick-bite tx-18"></i>
                    <span class="menu-item-label">Food Management</span>
                </a> 
                <ul class="br-menu-sub dummy_sub_company_menu">
                    <li class="sub-item dummy_sub_company_company subcompany"><a href="Category.php" class="sub-link">Food Category</a></li>
                    <li class="sub-item dummy_sub_company_company subcompany"><a href="SubCategory.php" class="sub-link">Food Sub Category</a></li>
                    <li class="sub-item dummy_sub_company_company subcompany"><a href="FoodItem.php" class="sub-link">Food Items</a></li>
                
                </ul> 

            </li>
            <?php }
            ?>
            

            <li class="br-menu-item dummy_company_menu companyCls"  >
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon icon fas fa-wallet tx-18"></i>
                    <span class="menu-item-label">Order Management</span>
                </a> 
                <ul class="br-menu-sub dummy_sub_company_menu">
                    <li class="sub-item dummy_sub_company_company subcompany"><a href="PendingOrder.php" class="sub-link">Order List</a></li>
                    <?php 
                    if($_SESSION['user']['RoleName'] == 'DeliveryMan'){
                        echo '<li class="sub-item dummy_sub_company_company subcompany"><a href="myShipment.php" class="sub-link">My Shipment</a></li>';
                    }
                    if($_SESSION['user']['RoleName'] == 'Admin' || $_SESSION['user']['RoleName'] == 'SuperAdmin'){
                        echo '<li class="sub-item dummy_sub_company_company subcompany"><a href="ShipmentStatus.php" class="sub-link">Shipment Status</a></li>';
                    }
                    ?>
                </ul> 
                
            </li>

            <li class="br-menu-item dummy_company_menu companyCls"  >
                <a href="#" class="br-menu-link with-sub">
                    <i class="menu-item-icon icon fas fa-user-cog tx-18"></i>
                    <span class="menu-item-label">Settings</span>
                </a> 
                <ul class="br-menu-sub dummy_sub_company_menu">
                    <li class="sub-item dummy_sub_company_company subcompany"><a href="UpdateProfile.php" class="sub-link">Update Profile</a></li>
                    <li class="sub-item dummy_sub_company_company subcompany"><a href="ChangePassword.php" class="sub-link">Change Password</a></li>
                </ul> 
            </li>

            <li class="br-menu-item dummy_poc_menu">
                <a href="../logout.php" class="br-menu-link">
                    <img src="../public/logout.png" alt="logo" class="logo-default logout-logo-width" />
                    <span class="menu-item-label">Log Out</span>
                </a>
            </li>
        </ul>

    </div>
    <div class="br-header">
        <div class="br-header-left">
            <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href="#"><i class="icon ion-navicon-round"></i></a></div>
            <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href="#"><i class="icon ion-navicon-round"></i></a></div>

        </div>
        <div class="br-header-right">
            <nav class="nav">

            </nav>
            <nav class="">
                <a href="#" class="nav-link nav-link-profile" data-toggle="dropdown">
                    <label id="lblGreetings"></label> <span class="logged-name hidden-md-down" style="color: black !important; font-size: 14px !important;"><?php echo $_SESSION['user']['Name'];?></span>
                    <img src="../public/bondi.jpg" alt="logo" class="logo-default header-logo-width" />
                </a>
            </nav>
        </div>
    </div>
    <div class="br-mainpanel">