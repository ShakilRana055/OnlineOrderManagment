(function(){
    let selector = {
        subCategoryList : $("#subCategoryList"),
        subCategoryMessage :$("#subCategoryMessage"),
    }
    function PopulateTableData(){
        var categoryList = selector.subCategoryList.dataTable({
            "processing": true,
            "serverSide": false,
            "filter": true,
            "pageLength": 10,
            "autoWidth": false,
            'dom': "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" + "<'row'<'col-sm-12'tr>>" + "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "lengthMenu": [[10, 50, 100, 150, 200, 500], [10, 50, 100, 150, 200, 500]],
            "order": [[3, "desc"]],
        });
    }

    window.onload = function (){
        PopulateTableData();
        var errorMessage = selector.subCategoryMessage.val();
        selector.subCategoryMessage.val('');
        
        if (errorMessage && errorMessage =="success") {
            Success('Sub Category Created Successfully');
        }
        else if(errorMessage && errorMessage =="update"){
            Success('Sub Category Updated Successfully');
        }
        else if(errorMessage && errorMessage =="failed"){
            Failed('Name is already taken');
        }
        
    }
})();