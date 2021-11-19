
(function(){
    let selector = {
        pendingOrderList : $("#pendingOrderList"),
        pendingOrderListMessage :$("#pendingOrderListMessage"),
        shipmentMessage :$("#shipmentMessage"),
        orderProcess: '.orderProcess',
    }
    function PopulateTableData(){
        var categoryList = selector.pendingOrderList.dataTable({
            "processing": true,
            "serverSide": false,
            "filter": true,
            "pageLength": 10,
            "autoWidth": false,
            'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
            "order": [[9, "desc"]],
        });
    }
    class Process {
        Proceed(url, buttonName, message){
            Swal.fire({
                title: message,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: buttonName
              }).then((result) => {
                if (result.value) {
                    window.location.href=url, true;
                }
            });
        }
        
    }
    let process = new Process();
    window.onload = function (){
        PopulateTableData();
        var errorMessage = selector.pendingOrderListMessage.val();
        selector.pendingOrderListMessage.val('');
        
        if (errorMessage && errorMessage =="shipment") {
            Success('Successfully Shipped');
        }
        else if(errorMessage && errorMessage =="orderTaken"){
            Success('Order Taken Successfully');
        }
        else if(errorMessage && errorMessage =="failed"){
            Failed('Something went wrong!');
        }
    }
    
    $(document).on("click", selector.orderProcess, function(){
        let url = $(this).attr("url");
        let action = $(this).attr('action');
        if( action == 'shipment')
            process.Proceed(url, 'Yes! Ship it', 'Are you sure to Ship?');
        else if(action == 'takeOrder')
            process.Proceed(url, 'Yes! Take it', 'Are you sure to Take Order?');
        
    });
})();