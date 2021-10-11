<?php 
    $headerName = '- Dashboard';
    include("layout/topbar.php");
    include("layout/sidebar.php");
?>


<div class="row">
    <div class="col-md-12">
        <form id="barChart" enctype="multipart/form-data">
            <div class="card">
                <div id="headingOne" class="card-header bg-blue1">
                    <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                        <h5 class="m-0 p-0" style="color: #fff;">Summary</h5>
                    </button>
                </div>
                <div class="card-body">
                    <div id="headingOne" class="collapse show">
                        <div class="row">
                            <canvas id="bar-chart-grouped" width="800" height="200"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Todays Purchase</h5>
                </button>
            </div>
            <div class="card-body">
                <div id="headingTwo" class="collapse show">
                    <div class="row">
                        <h3 id="todayTotalPurchase">
                            <?php
                                $date = date('Y-m-d');
                                $sqlQuery = "SELECT Round(SUM(GrandTotal)) GrandTotal
                                            FROM purchase
                                            WHERE PurchaseDate = '$date'";
                                $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
                                echo number_format($queryResult['GrandTotal'], 2, '.', ',') ."/-";
                            ?>
                        </h3>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div id="headingTwo" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Current Time</h5>
                </button>
            </div>
            <div class="card-body">
                <div id="headingTwo" class="collapse show">
                    <div class="row">
                        <h3 id="dateTime"></h3>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div id="headingThree" class="card-header bg-blue1">
                <button type="button" data-toggle="collapse" data-target="#Collapse" aria-expanded="true" class="text-left m-0 p-0 btn btn-block" style="box-shadow: none;">
                    <h5 class="m-0 p-0" style="color: #fff;">Todays Sales</h5>
                </button>
            </div>
            <div class="card-body">
                <div id="headingThree" class="collapse show">
                    <div class="row">
                        <h3 id="todaysSale">
                            <?php
                                $date = date('Y-m-d');
                                $sqlQuery = "SELECT Round(SUM(GrandTotal)) GrandTotal 
                                            FROM invoice WHERE InvoiceDate = '$date'";
                                $queryResult = mysqli_fetch_assoc(mysqli_query($con, $sqlQuery));
                                echo number_format($queryResult['GrandTotal'], 2, '.', ',') ."/-";
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
        let ajaxOperation = new AjaxOperation();
        let selector = {
            todayTotalPurchase: $("#todayTotalPurchase"),
            todaysSale: $("#todaysSale"),
            labels: [],
            purchase: [],
            sales:[],
        }

        function GenerateChart() {
            new Chart(document.getElementById("bar-chart-grouped"), {
                type: 'bar',
                data: {
                    labels: selector.labels,
                    datasets: [
                        {
                            label: "Purchase",
                            backgroundColor: "#00ff99",
                            data: selector.purchase,
                        }, {
                            label: "Sales",
                            backgroundColor: "#ff1a1a",
                            data: selector.sales,
                        }
                    ]
                },
                options: {
                    title: {
                        display: true,
                        text: 'Purchase & Sales'
                    }
                }
            });
        }
        function GatheringInformationForChart() {
            let response = ajaxOperation.GetAjaxByValue("../controller/Dashboard.php", "search");
            
            let conversion = JSON.parse(response);
            selector.labels = conversion.days;
            selector.purchase = conversion.purchase;
            selector.sales = conversion.sales;
        }
        function ShowTime() {
            var dt = new Date();
            document.getElementById("dateTime")
                .innerHTML = dt.toLocaleTimeString();
        }  
        window.onload = function () {
            setInterval(ShowTime, 1000);
            GatheringInformationForChart();
            GenerateChart();
        }
    })();
</script>