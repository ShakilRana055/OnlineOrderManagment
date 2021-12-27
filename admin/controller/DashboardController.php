<?php
    session_start();
    // database connection
    include("../../connection/DatabaseConnection.php");

    $userId = $_SESSION['user']['Id'];
    if(isset($_GET['search'])){
        try 
        {
            $today = date('Y-m-d');
            $month = date('n');
            $year = date('Y');
            $day = date('d');

            $initialThisMonth = $year.'-'.$month."-1";

            $days = $sales = $purchase = array();

            for($i = 1; $i <= $day; $i++){
                
                $sqlQuery = "SELECT Round(SUM(GrandTotal)) GrandTotal
                            FROM invoice
                            WHERE OrderDate = '$initialThisMonth' AND Status = 'Pending'";
                $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
                
                $days[] = $i; //$initialThisMonth;
                $purchase[] = $queryResult['GrandTotal']; //number_format($queryResult['GrandTotal'], 2, '.', ',');


                $sqlQuery = "SELECT Round(SUM(GrandTotal)) GrandTotal 
                            FROM invoice WHERE DeliveryDate = '$initialThisMonth' AND Status = 'Delivered'";
                $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));

                $sales[] = $queryResult['GrandTotal'];// number_format($queryResult['GrandTotal'], 2, '.', ',');

                $initialThisMonth = $year.'-'.$month."-".($i+1);
            }

            $jsonData = array(
                "days"            => $days,
                "order"        => $purchase,
                "deliver"           => $sales
                );
            echo json_encode($jsonData);
        } 
        catch (Throwable $th) {
            echo json_encode(false);
        }
    }

    if(isset($_GET['deliveryMan'])){
        try 
        {
            $today = date('Y-m-d');
            $month = date('n');
            $year = date('Y');
            $day = date('d');

            $initialThisMonth = $year.'-'.$month."-1";

            $days = $sales = $purchase = array();

            for($i = 1; $i <= $day; $i++){
                
                $sqlQuery = "SELECT COALESCE(COUNT(1), 0) TotalOrderTaken
                            FROM invoice
                            WHERE DeliveryManId = '$userId'
                            AND OrderTakenDate = '$initialThisMonth'
                            GROUP BY OrderTakenDate";
                $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
                
                $days[] = $i; 
                $purchase[] = $queryResult['TotalOrderTaken'] == null ? 0 : $queryResult['TotalOrderTaken'] ; 


                $sqlQuery = "SELECT COALESCE(COUNT(1), 0) TotalDelivery
                            FROM invoice
                            WHERE DeliveryManId = '$userId'
                            AND DeliveryDate = '$initialThisMonth'
                            GROUP BY DeliveryDate";
                $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));

                $sales[] = $queryResult['TotalDelivery'] == null ? 0 : $queryResult['TotalDelivery'];

                $initialThisMonth = $year.'-'.$month."-".($i+1);
            }

            $jsonData = array(
                "days"            => $days,
                "order"        => $purchase,
                "deliver"           => $sales
                );
            echo json_encode($jsonData);
        } 
        catch (Throwable $th) {
            echo json_encode(false);
        }
    }
?>