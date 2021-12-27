
(function(){
    let selector = {
        myShipmentList : $("#myShipmentList"),
        myShipmentListMessage :$("#myShipmentListMessage"),
        shipmentMessage :$("#shipmentMessage"),
        orderProcess: '.orderProcess',
    }
    function PopulateTableData(){
        var categoryList = selector.myShipmentList.dataTable({
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
        var errorMessage = selector.myShipmentListMessage.val();
        selector.myShipmentListMessage.val('');
        
        if (errorMessage && errorMessage =="orderCancel") {
            Success('Order Cancelled successfully');
        }
        else if(errorMessage && errorMessage =="delivered"){
            Success('Order Delivered Successfully');
        }
        else if(errorMessage && errorMessage =="failed"){
            Failed('Something went wrong!');
        }
    }
    
    $(document).on("click", selector.orderProcess, function(){
        let url = $(this).attr("url");
        let action = $(this).attr('action');
        if( action == 'cancel')
            process.Proceed(url, 'Yes! Cancel it', 'Are you sure to Cancel?');
        else if(action == 'deliver'){
            Swal.fire({
                title: 'Remarks',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delivered',
                html: '<textarea id="remarks-swal" cols="3" class="swal2-input"></textarea>',
                preConfirm: function () {
                    let remarks = Swal.getPopup().querySelector('#remarks-swal').value;
                    if (remarks == '' || remarks == null)
                        Swal.showValidationMessage('Remarks is required');
                    else {
                        return new Promise(function (resolve, reject) {
                            resolve([
                                $('#remarks-swal').val(),
                            ]);
                        })
                    }
                },
                onOpen: function () {
                    $('#remarks-swal').focus()
                }
            }).then(function (result) {
                if (result) {
                    let remarks = result.value[0];
                    remarks = remarks.replaceAll(' ','_');
                    url += "&remarks="+remarks;
                    window.location = url, true;
                }
            }).catch(swal.noop)
        }
        
    });
})();