<?php 
    $headerName = 'Shipment Status';
    include("layout/topbar.php");
    include("layout/sidebar.php");
    $userId = $_SESSION['user']['Id'];
?>

<div class="br-pageheader">
    <nav class="breadcrumb pd-0 mg-0 tx-12">
        <a class="breadcrumb-item" href="index.php">Dashboard</a>
        <a class="breadcrumb-item active" href="#">Shipment Status</a>
    </nav>
</div><!-- br-pageheader -->

<div id="datatable1_wrapper" class="dataTables_wrapper no-footer">
    <div class="br-pagebody">
        <div class="br-section-wrapper">
            <h6 class="br-section-label">Shipment Status</h6>
            <div class="table-wrapper">
                <table style="width:100%" id="shipmentStatusList" class="table display responsive nowrap tableStyle">
                    <thead>
                        <tr>
                            <th>Invoice No.</th>
                            <th>Delivery Man</th>
                            <th>Phone</th>
                            <th>Grand Total</th>
                            <th>Order Date</th>
                            <th>Delivery Charge</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "SELECT P.*, DE.Name DeliveryManName,DE.Address, DE.Phone
                                FROM invoice P
                                LEFT JOIN user DE ON DE.Id = P.DeliveryManId
                                WHERE Status in ('Shipping', 'Delivered')
                                ORDER BY Id DESC";
                            $queryResult = mysqli_query($con, $sql);
                            foreach ($queryResult as $row){
                                $id = $row['Id']; 
                                $invoiceNumber = $row['InvoiceNumber']; 
                                $deliveryManName = $row['DeliveryManName'];
                                $address = $row['Address'];
                                $Phone = $row['Phone'];
                                $grandTotal = $row['GrandTotal'];
                                $discount = $row['Discount'];
                                $orderDate = $row['OrderDate'];
                                $deliveryCharge = $row['DeliveryCharge'];
                                $Status = $row['Status'];

                                $whichStatus = '';
                                if($Status == 'Shipping') $whichStatus = '<span class="badge badge-primary">Shipping</span>';
                                else if($Status == 'Delivered') $whichStatus = '<span class="badge badge-success">Delivered</span>'; 
                               
                                $buttons = "<button class = 'btn btn-info btn-sm btnInfo' title = 'Info' invoiceId='$id' ><i class='fa fa-info-circle'></i></button>";
                                $buttons .= "<button class = 'btn btn-success btn-sm btnHistory' title = 'Info' invoiceId='$id' ><i class='fa fa-history'></i></button>";
                                echo '<tr>
                                        <td>'.$invoiceNumber.'</td>
                                        <td>'.$deliveryManName.'</td>
                                        <td>'.$Phone.'</td>
                                        <td>'.$grandTotal.'</td>
                                        <td>'.$orderDate.'</td>
                                        <td>'.$deliveryCharge.'</td>
                                        <td>'.$whichStatus.'</td>
                                        <td>'.$buttons.'</td>
                                    </tr>';
                            }
                        ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("layout/footer.php");?>
<script>
    (function(){
        let selector = {
            btnInfo: '.btnInfo',
            btnHistory : '.btnHistory'
        };
        let ajaxOperation = new AjaxOperation();
        let modalOperation = new ModalOperation();
        let modal = {
            informationModal: "#informationModal",
            modalHeading: $("#modalHeading"),
            informationModalDiv: "#informationModalDiv",
        };

        function PopulateTableData(){
            var shipmentStatusList = $("#shipmentStatusList").dataTable({
                "processing": true,
                "serverSide": false,
                "filter": true,
                "pageLength": 10,
                "autoWidth": false,
                'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
                "order": [[7, "desc"]],
            });
        }

        window.onload = PopulateTableData();

        $(document).on("click", selector.btnInfo, function () {
            let invoiceId = $(this).attr('invoiceId');
            let response = ajaxOperation.GetAjaxHtmlByValue('./htmlHelper/invoiceDetail.php', invoiceId);
            modal.modalHeading.text('Invoice Details');
            modalOperation.ModalStatic(modal.informationModal);
            modalOperation.ModalOpenWithHtml(modal.informationModal, modal.informationModalDiv, response);
        });

        
        $(document).on("click", selector.btnHistory, function () {
            let invoiceId = $(this).attr('invoiceId');
            let response = ajaxOperation.GetAjaxHtmlByValue('./htmlHelper/invoiceHistory.php', invoiceId);
            modal.modalHeading.text('Invoice History');
            modalOperation.ModalStatic(modal.informationModal);
            modalOperation.ModalOpenWithHtml(modal.informationModal, modal.informationModalDiv, response);
        });

    })();
</script>