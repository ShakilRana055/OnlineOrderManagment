<?php
    session_start();
    // database connection
    include("../../connection/DatabaseConnection.php");

    $customerId = 0;

    if(isset($_SESSION['customer'])) $customerId = $_SESSION['customer']['Id'];

    if($customerId == 0){
        header('Location: ../views/CustomerLogin.php');
    }
   
    // 
    #region Added into shopping cart
    if(isset($_GET['foodItemId']) && isset($_GET['quantity'])){
        $foodItemId = $_GET['foodItemId'];
        $quantity = $_GET['quantity'];

        $sqlQuery = "SELECT * FROM `shoppingcart` WHERE `UserId` = '$customerId' AND `FoodItemId` = '$foodItemId'";
        $result = mysqli_query($con, $sqlQuery);

        if(mysqli_num_rows($result) == 0)
        {
            $sqlQuery = "INSERT INTO `shoppingcart`(`UserId`, `FoodItemId`, `Quantity`, `CreatedBy`) 
            VALUES ('$customerId','$foodItemId','$quantity','$customerId')";

            $result = mysqli_query($con, $sqlQuery);
            if($result != null){
                $_SESSION['CartAdded'] = 'success';
                header('Location: ../views/shop.php');
            }
            else{
                $_SESSION['CartAdded'] = 'failed';
                header('Location: ../views/shop.php');
            }
        }
        else{
            $_SESSION['CartAdded'] = 'taken';
            header('Location: ../views/shop.php');
        } 
    }
    #endregion

    #region Remove from shopping cart
    if(isset($_GET['removeCart'])){
        $foodItemId = $_GET['removeCart'];
        $sqlQuery = "SELECT * FROM `shoppingcart` WHERE `UserId` = '$customerId' AND `FoodItemId` = '$foodItemId'";
        $result = mysqli_query($con, $sqlQuery);
        if(mysqli_num_rows($result) > 0)
        {
            $sqlQuery = "DELETE FROM `shoppingcart` WHERE `UserId` = '$customerId' AND `FoodItemId` = '$foodItemId'";

            $result = mysqli_query($con, $sqlQuery);
            if($result != null){
                $_SESSION['CartRemove'] = 'success';
                header('Location: ../views/shop.php');
            }
            else{
                $_SESSION['CartRemove'] = 'failed';
                header('Location: ../views/shop.php');
            }
        }
        else{
            $_SESSION['CartRemove'] = 'taken';
            header('Location: ../views/shop.php');
        } 
    }
    #endregion

    #region Added into favorites cart
    if(isset($_GET['favorites'])){
        $foodItemId = $_GET['favorites'];
        $quantity = $_GET['quantity'];

        $sqlQuery = "SELECT * FROM `favorites` WHERE `UserId` = '$customerId' AND `FoodItemId` = '$foodItemId'";
        $result = mysqli_query($con, $sqlQuery);

        if(mysqli_num_rows($result) == 0)
        {
            $sqlQuery = "INSERT INTO `favorites`(`UserId`, `FoodItemId`) 
            VALUES ('$customerId','$foodItemId')";

            $result = mysqli_query($con, $sqlQuery);
            if($result != null){
                $_SESSION['Favorites'] = 'success';
                header('Location: ../views/shop.php');
            }
            else{
                $_SESSION['Favorites'] = 'failed';
                header('Location: ../views/shop.php');
            }
        }
        else{
            $_SESSION['Favorites'] = 'taken';
            header('Location: ../views/shop.php');
        } 
    }
    #endregion
?>