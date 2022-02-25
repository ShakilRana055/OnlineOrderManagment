<?php
    session_start();
    // database connection
    include("../../connection/DatabaseConnection.php");

    $userId = $_SESSION['user']['Id'];

    if(isset($_GET['shipmentId'])){
        $id = $_GET['shipmentId'];
        $sql = "UPDATE invoice SET `Status` = 'Shipment', UpdatedDate = '$currentDate', UpdatedBy = '$userId' WHERE Id = '$id'";
        $result = mysqli_query($con, $sql);

        $sql = "INSERT INTO `invoicehistory`(`InvoiceId`, `UserId`, `Status`, `Remarks`) 
                VALUES ('$id', '$userId', '2', 'Placed for Shipment')";
        mysqli_query($con, $sql);

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
        $sql = "UPDATE invoice SET `Status` = 'Shipping', OrderTakenDate = '$currentDate', DeliveryManId = '$userId', UpdatedDate = '$currentDate', UpdatedBy = '$userId' WHERE Id = '$id'";
        $result = mysqli_query($con, $sql);

        $sql = "INSERT INTO `invoicehistory`(`InvoiceId`, `UserId`, `Status`, `Remarks`) 
                VALUES ('$id', '$userId', '3', 'Order Taken')";
        mysqli_query($con, $sql);

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
        $sql = "UPDATE invoice SET `Status` = 'Shipment', OrderTakenDate = '0000-00-00', DeliveryManId = '0', UpdatedDate = '$currentDate', UpdatedBy = '$userId' WHERE Id = '$id'";
        $result = mysqli_query($con, $sql);

        $sql = "INSERT INTO `invoicehistory`(`InvoiceId`, `UserId`, `Status`, `Remarks`) 
                VALUES ('$id', '$userId', '9', 'Order Cancel')";
        mysqli_query($con, $sql);

        if($result != null){
            $_SESSION['myShipmentList'] = 'orderCancel';
            header('Location: ../views/MyShipment.php');
        }
        else{
            $_SESSION['myShipmentList'] = 'failed';
            header('Location: ../views/MyShipment.php');
        }
    }

    if(isset($_GET['deliverOrder'])){
        $id = $_GET['deliverOrder'];
        $remarks = str_replace("_"," ", $_GET['remarks']);
        $sql = "UPDATE invoice SET `Status` = 'Delivered', DeliveryDate = '$currentDate', Remarks = '$remarks', UpdatedDate = '$currentDate', UpdatedBy = '$userId' WHERE Id = '$id'";
        $result = mysqli_query($con, $sql);

        $sql = "INSERT INTO `invoicehistory`(`InvoiceId`, `UserId`, `Status`, `Remarks`) 
                VALUES ('$id', '$userId', '4', '$remarks')";
        mysqli_query($con, $sql);

        if($result != null){
            $_SESSION['myShipmentList'] = 'delivered';
            header('Location: ../views/MyShipment.php');
        }
        else{
            $_SESSION['myShipmentList'] = 'failed';
            header('Location: ../views/MyShipment.php');
        }
    }
?>