<?php 
    $headerName = 'Dashboard';
    include("layout/topbar.php");
    include("layout/sidebar.php");
    $userRole = $_SESSION['user']['RoleName'];
    $userId = $_SESSION['user']['Id'];
?>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="#">Dashboard</a>
    </nav>
</div>

<input type= "hidden" value = "<?php echo $userRole;?>" id="userRole" />

<div class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Summary</h6>
            <?php if($userRole == 'Admin' || $userRole == 'SuperAdmin'){?>
            <div class="table-wrapper">
                <canvas id="bar-chart-grouped" width="800" height="200"></canvas>
            </div>
            <?php }?>
            <?php if($userRole == 'DeliveryMan'){?>
            <div class="table-wrapper">
                <canvas id="bar-chart-deliveryMan" width="800" height="200"></canvas>
            </div>
            <?php }?>
        </div>
    </div>
</div>

<div class = "row">
<div class = "col-md-4 col-lg-4 col-sm-4">
        <div class="dataTables_wrapper no-footer">
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <h6 class="br-section-label">Todays Order</h6>
                    <div class="table-wrapper">
                        <h3 id="todaysOrder" style = "text-align:center;">
                            <?php
                            $date = date('Y-m-d');
                                if($userRole == 'Admin' || $userRole == 'SuperAdmin'){
                                    $sqlQuery = "SELECT ROUND(SUM(SubTotal)) SubTotal 
                                    FROM invoice 
                                    WHERE OrderDate = '$date'
                                    GROUP BY OrderDate";
                                    $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
                                    echo number_format($queryResult == null ? 0 : $queryResult['SubTotal'], 2, '.', ',') ."/-";
                                }
                                if($userRole == 'DeliveryMan'){
                                    $sqlQuery = "SELECT COUNT(1) Total
                                                FROM invoice
                                                WHERE DeliveryManId = '$userId'
                                                AND OrderTakenDate = '$date'
                                                GROUP BY DeliveryManId";
                                    $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
                                    echo number_format($queryResult == null ? 0: $queryResult['Total'], 2, '.', ',');
                                }
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class = "col-md-4 col-lg-4 col-sm-4">
        <div class="dataTables_wrapper no-footer">
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <h6 class="br-section-label">Current Time</h6>
                    <div class="table-wrapper">
                        <h3 id="dateTime" style = "text-align:center;"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class = "col-md-4 col-lg-4 col-sm-4">
        <div class="dataTables_wrapper no-footer">
            <div class="br-pagebody">
                <div class="br-section-wrapper">
                    <h6 class="br-section-label">Todays Delivered</h6>
                    <div class="table-wrapper">
                        <h3 id="todayDelivered" style = "text-align:center;">
                            <?php
                                $date = date('Y-m-d');
                                if($userRole == 'Admin' || $userRole == 'SuperAdmin'){
                                    $sqlQuery = "SELECT ROUND(SUM(SubTotal)) SubTotal 
                                                FROM invoice 
                                                WHERE DeliveryDate = '$date' AND Status = 'Delivered' 
                                                GROUP BY DeliveryDate";
                                    $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
                                    echo number_format( $queryResult == null ? 0 : $queryResult['SubTotal'], 2, '.', ',') ."/-";
                                }
                                if($userRole == 'DeliveryMan'){
                                    $sqlQuery = "SELECT COUNT(1) Total
                                                FROM invoice
                                                WHERE DeliveryManId = '$userId'
                                                AND DeliveryDate = '$date' AND Status = 'Delivered' 
                                                GROUP BY DeliveryDate";
                                    $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
                                    echo number_format($queryResult == null ? 0 : $queryResult['Total'], 2, '.', ',');
                                }
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php");?>
<script src="../public/javaScript/Index.js"></script>
