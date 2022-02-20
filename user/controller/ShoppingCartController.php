<?php
    session_start();
    // database connection
    include("../../connection/DatabaseConnection.php");

    $customerId = 0;

    if(isset($_SESSION['customer'])) $customerId = $_SESSION['customer']['Id'];

    if($customerId == 0){
        header('Location: ../views/CustomerLogin.php');
    }

    if(isset($_GET['search']) && $_GET['search'] == 'getTempShoppingCart'){
        $sql = "SELECT sc.Id, fd.Name, fd.Price, fd.Discount, fd.DisplayPicture, sc.Quantity
                FROM `shoppingcart` sc
                INNER JOIN fooditem fd on fd.Id = sc.FoodItemId
                WHERE sc.UserId = '$customerId'";
        
        $result = mysqli_query($con, $sql);
        $tableRow = '';
        $sl = 1;
        foreach( $result as $row){
            $id = $row['Id']; $name = $row['Name']; $price = $row['Price']; $discount = $row['Discount'];
            $displayPicture = $row['DisplayPicture']; $quantity = $row['Quantity'];

            $quantityButton = '<input type="button" price ='.$price.' discount ='.$discount.' serialNumber = '.$sl.' value="-" class="minus btn-danger btn-sm">
                               <input type="number" price ='.$price.' discount ='.$discount.' serialNumber = '.$sl.' style = "text-align:center;" step="1" min="1" max="" name="quantity" value="'.$quantity.'" title="Qty" class="input-text qty text tempQuantity" size="3" pattern="" inputmode="">
                               <input type="button" price ='.$price.' discount ='.$discount.' serialNumber = '.$sl.' value="+" class="plus btn-sm btn-success">';
            $actionButton = '<button id = '.$id.' class="deleteBtn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>';

            $tableRow .= '<tr>
                <td>'.$sl.'</td>
                <td>'.$name.'</td>
                <td>'.$price.'৳</td>
                <td>'.$quantityButton.'</td>
                <td>'.$discount.'৳</td>
                <td><span serialNumber = '.$sl.' readonly class = "totalPrice"> </span> </td>
                <td>'.$actionButton.'</td>
            </tr>';
            $sl++;
        }
       echo $tableRow;
    }
?>