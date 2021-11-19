<?php
    session_start();
    // database connection
    include("../../connection/DatabaseConnection.php");

    $userId = $_SESSION['user']['Id'];

    if(isset($_GET['shipmentId'])){
        $id = $_GET['shipmentId'];
        $sql = "UPDATE invoice SET `Status` = 'Shipment', UpdatedDate = '$currentDate', UpdatedBy = '$userId' WHERE Id = '$id'";
        echo $sql;
        $result = mysqli_query($con, $sql);
        if($result != null){
            $_SESSION['PendingOrderList'] = 'shipment';
            header('Location: ../views/PendingOrder.php');
        }
        else{
            $_SESSION['PendingOrderList'] = 'failed';
            header('Location: ../views/PendingOrder.php');
        }
    }
    if(isset($_GET['takeOrder'])){
        $id = $_GET['takeOrder'];
        $sql = "UPDATE invoice SET `Status` = 'Shipping', DeliveryManId = '$userId', UpdatedDate = '$currentDate', UpdatedBy = '$userId' WHERE Id = '$id'";
        echo $sql;
        $result = mysqli_query($con, $sql);
        if($result != null){
            $_SESSION['PendingOrderList'] = 'orderTaken';
            header('Location: ../views/PendingOrder.php');
        }
        else{
            $_SESSION['PendingOrderList'] = 'failed';
            header('Location: ../views/PendingOrder.php');
        }
    }

    if(isset($_GET['orderCancel'])){
        $id = $_GET['orderCancel'];
        $sql = "UPDATE invoice SET `Status` = 'Shipment', DeliveryManId = '0', UpdatedDate = '$currentDate', UpdatedBy = '$userId' WHERE Id = '$id'";
        echo $sql;
        $result = mysqli_query($con, $sql);
        if($result != null){
            $_SESSION['myShipmentList'] = 'orderCancel';
            header('Location: ../views/MyShipment.php');
        }
        else{
            $_SESSION['myShipmentList'] = 'failed';
            header('Location: ../views/MyShipment.php');
        }
    }
?>