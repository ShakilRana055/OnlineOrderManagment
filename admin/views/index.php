<?php 
    $headerName = 'Dashboard';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="#">Dashboard</a>
    </nav>
</div>

<div class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Summary</h6>
            <div class="table-wrapper">
                <canvas id="bar-chart-grouped" width="800" height="200"></canvas>
            </div>
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
                                $sqlQuery = "SELECT ROUND(SUM(SubTotal)) SubTotal 
                                            FROM invoice 
                                            WHERE OrderDate = '$date' AND Status = 'Pending' 
                                            GROUP BY OrderDate";
                                $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
                                echo number_format($queryResult['SubTotal'], 2, '.', ',') ."/-";
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
                                $sqlQuery = "SELECT ROUND(SUM(SubTotal)) SubTotal 
                                            FROM invoice 
                                            WHERE DeliveryDate = '$date' AND Status = 'Delivered' 
                                            GROUP BY OrderDate";
                                $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
                                echo number_format($queryResult['SubTotal'], 2, '.', ',') ."/-";
                            ?>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php");?>

<script>
    (function () {
        let selector = {
            labels: [],
            order: [],
            deliver:[],
        }

        function GenerateChart() {
            new Chart(document.getElementById("bar-chart-grouped"), {
                type: 'bar',
                data: {
                    labels: selector.labels,
                    datasets: [
                        {
                            label: "Order",
                            backgroundColor: "#00ff99",
                            data: selector.order,
                        }, {
                            label: "Deliver",
                            backgroundColor: "#ff1a1a",
                            data: selector.deliver,
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Order & Deliver'
                    }
                }
            });
        }
        function GatheringInformationForChart() {
             $.ajax({
                url: "../controller/DashboardController.php",
                method: "GET",
                data: ({'search': 'search'}),
                success: function(response){
                    let conversion = JSON.parse(response);
                    selector.labels = conversion.days;
                    selector.order = conversion.order;
                    selector.deliver = conversion.deliver;
                    GenerateChart();
                }
            })
            
        }
        function ShowTime() {
            var dt = new Date();
            document.getElementById("dateTime")
                .innerHTML = dt.toLocaleTimeString();
        }  
        window.onload = function () {
            GatheringInformationForChart();
            setInterval(ShowTime, 1000);
        }
    })();
</script>
