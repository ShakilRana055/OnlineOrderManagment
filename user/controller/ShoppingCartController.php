<?php
    session_start();
    include('Autogenerate.php');
    // database connection
    include("../../connection/DatabaseConnection.php");

    $customerId = 0;

    if(isset($_SESSION['customer'])) $customerId = $_SESSION['customer']['Id'];

    if($customerId == 0){
        header('Location: ../views/CustomerLogin.php');
    }

    if(isset($_GET['search']) && $_GET['search'] == 'getTempShoppingCart' && $customerId > 0 ){
        $sql = "SELECT sc.Id, fd.Name, sc.FoodItemId, fd.Price, fd.Discount, fd.DisplayPicture, sc.Quantity
                FROM `shoppingcart` sc
                INNER JOIN fooditem fd on fd.Id = sc.FoodItemId
                WHERE sc.UserId = '$customerId'
                ORDER BY sc.CreatedDate DESC";
        
        $result = mysqli_query($con, $sql);
        $tableRow = '';
        $sl = 1;
        foreach( $result as $row){
            $id = $row['Id']; $name = $row['Name']; $price = $row['Price']; $discount = $row['Discount'];
            $foodItemId = $row['FoodItemId']; $quantity = $row['Quantity']; 

            $quantityButton = '<input type="button" serialNumber = '.$sl.' value="-" class="minus btn-danger btn-sm">
                                    <input type="number" price ='.$price.' id = '.$id.' foodItemId ='.$foodItemId.' discount ='.$discount.' serialNumber = '.$sl.' style = "text-align:center; width: 40px" readonly step="1" min="1" max="" name="quantity" value="'.$quantity.'" title="Qty" class="input-text qty text tempQuantity" size = "2">
                               <input type="button" serialNumber = '.$sl.' value="+" class="plus btn-sm btn-success">';
            $actionButton = '<button id = '.$id.' class="deleteBtn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>';

            $tableRow .= '<tr>
                <td>'.$sl.'</td>
                <td>'.$name.'</td>
                <td>'.$price.'<span>৳</span></td>
                <td>'.$quantityButton.'</td>
                <td>'.$discount.'৳</td>
                <td><span serialNumber = '.$sl.' class = "totalPrice"> </span> <span>৳</span></td>
                <td>'.$actionButton.'</td>
            </tr>';
            $sl++;
        }
       echo $tableRow;
    }

    if(isset($_GET['id']) && $customerId > 0 ){
        $id = $_GET['id'];
        $sql = "DELETE FROM `shoppingcart` WHERE `Id` = '$id'";
        $result = mysqli_query($con, $sql);
        if($result != null){
            echo 1;
        }
        else{
            echo 0;
        }
    }

    if(isset($_POST['updateQuantity']) && $customerId > 0 ){
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $sql = "UPDATE `shoppingcart` SET `Quantity`='$quantity',`UpdatedBy`='$customerId',`UpdatedDate`='$currentDate' WHERE Id = '$id'";

        $result = mysqli_query($con, $sql);

        if($result != null){
            echo 1;
        }
        else {
            echo 0;
        }
    }

    if($_POST['confirmOrder'] && $customerId > 0 ){
        $phone = $_POST['phone']; $address = $_POST['address'];
        $deliveryDate = $_POST['deliveryDate']; $invoiceDetail = $_POST['invoiceDetail'];
        $subTotal = $_POST['subTotal']; $grandTotal = $_POST['grandTotal'];

        $sql = "SELECT InvoiceNumber FROM `invoice` ORDER BY Id DESC LIMIT 1";
        $result = mysqli_query($con, $sql);
        $rowNumber = mysqli_num_rows($result);
        $info = mysqli_fetch_assoc(mysqli_query($con, $sql));
        $invoiceNumber = AutoGenerate::InvoiceNumber($rowNumber == 0 ? "0" : $info['InvoiceNumber'], "INV-");
        
        $sql = "INSERT INTO invoice (`InvoiceNumber`, `CustomerId`, `Phone`, `Address`, `DeliveryDate`,`SubTotal`, `GrandTotal`, `DeliveryCharge`, `Status`, `Remarks`, `CreatedBy`)
                VALUES('$invoiceNumber', '$customerId', '$phone', '$address', '$deliveryDate', '$subTotal', '$grandTotal', '60', 'Pending', 'Initialy Order Place', '$currentDate' )";
        
        $result = mysqli_query($con, $sql);
        $invoiceId = mysqli_insert_id($con);
        if($result != null){
            for($i = 0; $i < Count($invoiceDetail); $i++ ){
                $foodItemId = $invoiceDetail[$i]['foodItemId'];
                $unitPrice = $invoiceDetail[$i]['unitPrice'];
                $quantity = $invoiceDetail[$i]['quantity'];
                $discount = $invoiceDetail[$i]['discount'];
                $totalPrice = $invoiceDetail[$i]['totalPrice'];

                $sql = "INSERT INTO `invocedetail`(`InvoiceId`, `InvoiceNumber`, `FoodItemId`, `UnitPrice`, `Quantity`, `Discount`, `Price`) 
                        VALUES ('$invoiceId', '$invoiceNumber', '$foodItemId', '$unitPrice', '$quantity', '$discount', '$totalPrice')";
                mysqli_query($con, $sql);
            }

            $sql = "INSERT INTO `invoicehistory`(`InvoiceId`, `UserId`, `Status`, `Remarks`) 
                    VALUES ('$invoiceId', '$customerId', 1, 'Order Placed By Customer')";
            mysqli_query($con, $sql);

            $sql = "DELETE FROM `shoppingcart` WHERE `UserId` = '$customerId'";
            mysqli_query($con, $sql);
        }

        echo 1;
        

    }
?>