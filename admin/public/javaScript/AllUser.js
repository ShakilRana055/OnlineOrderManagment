(function(){
    let selector = {
        allUserList : $("#allUserList"),
        allUserMessage :$("#allUserMessage"),
    }
    function PopulateTableData(){
        var allUserList = selector.allUserList.dataTable({
            "processing": true,
            "serverSide": false,
            "filter": true,
            "pageLength": 10,
            "autoWidth": false,
            'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
            "order": [[5, "desc"]],
        });
    }

    window.onload = function (){
        PopulateTableData();
        var errorMessage = selector.allUserMessage.val();
        selector.allUserMessage.val('');
        
        if (errorMessage && errorMessage =="success") {
            Success('User Created Successfully');
        }
        else if(errorMessage && errorMessage =="update"){
            Success('User Updated Successfully');
        }
        else if(errorMessage && errorMessage =="failed"){
            Failed('Email is already taken');
        }
        
    }
})();