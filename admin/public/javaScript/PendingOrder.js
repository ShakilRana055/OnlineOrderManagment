(function(){
    let selector = {
        pendingOrderList : $("#pendingOrderList"),
        pendingOrderListMessage :$("#pendingOrderListMessage"),
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

    window.onload = function (){
        PopulateTableData();
        var errorMessage = selector.pendingOrderListMessage.val();
        selector.pendingOrderListMessage.val('');
        
        if (errorMessage && errorMessage =="success") {
            Success('Successfully Assigned');
        }
        else if(errorMessage && errorMessage =="failed"){
            Failed('Something went wrong!');
        }
    }
})();