<?php 
    session_start();
    include("../../connection/DatabaseConnection.php");
    if(isset($_SESSION['user'])){}
    else{
        header('Location: ../index.php');
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?php echo $headerName;?> - Online Food Service</title>
    <style>
        .dt-button {
            background-color: #ffcb24 !important;
            color: black !important;
            border: none !important;
        }
        .tableStyle tr td, tr th{
            text-align: center;
        }
    </style>

    <!-- vendor css -->
    <link href="../public/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2021.1.330/styles/kendo.default-v2.min.css" />
    <link href="../public/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="../public/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="../public/ionicons/css/ionicons.min.css" rel="stylesheet">
    <link href="../public/highlightjs/styles/github.css" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.7/sweetalert2.css'>
    <link href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" rel="stylesheet" />

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="../public/bootstrapSwitch/bootstrap-switch.css">
    <link rel="stylesheet" href="../public/css/bracket.css">
    <link rel="stylesheet" href="../public/css/site.css">
    <link rel="stylesheet" href="../public/select2/select2.min.css">
    <script src="../public/jquery/jquery.min.js"></script>
    
    <script src="../public/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../public/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css" rel="stylesheet" />
</head>
<body>