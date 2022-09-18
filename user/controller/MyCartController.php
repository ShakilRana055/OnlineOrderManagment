<?php
    session_start();
    // database connection
    include("../../connection/DatabaseConnection.php");

    $customerId = 0;

    if(isset($_SESSION['customer'])) {
        $customerId = $_SESSION['customer']['Id'];
    }

    if($customerId == 0){
        header('Location: ../views/CustomerLogin.php');
    }

    if(isset($_GET["id"]) && $customerId > 0 ){
        $invoiceId = $_GET["id"];
        $historyDelete = "DELETE FROM `invoicehistory` WHERE `InvoiceId` = '$invoiceId'";
        mysqli_query($con, $historyDelete);
        $invoiceDetailDelete = "DELETE FROM `invocedetail` WHERE `InvoiceId` = '$invoiceId'";
        mysqli_query($con, $invoiceDetailDelete);
        $invoiceDelete = "DELETE FROM `invoice` WHERE Id = '$invoiceId'";
        $result  = mysqli_query($con, $invoiceDelete);
        if($result){
            echo 1;
        }
        else
            echo 0;
    }

?>