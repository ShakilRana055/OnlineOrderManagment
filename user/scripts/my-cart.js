

(function () {
    let selector = {
        information: ".information",
        delete: ".delete",
    };

    let modal = {
        informationModal: "#informationModal",
        modalHeading: $("#modalHeading"),
        informationModalDiv: "#informationModalDiv",
    }

    let ajaxOperation = new AjaxOperation();
    let modalOperation = new ModalOperation();

    $(document).on("click", selector.information, function () {
        let invoiceId = $(this).attr('invoiceId');
        let response = ajaxOperation.GetAjaxHtmlByValue('./htmlHelper/invoiceDetail.php', invoiceId);
        modal.modalHeading.text('Invoice Details');
        modalOperation.ModalStatic(modal.informationModal);
        modalOperation.ModalOpenWithHtml(modal.informationModal, modal.informationModalDiv, response);
    });
    $(document).on("click", selector.delete, function(){
        let invoiceId = $(this).attr('invoiceId');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    let response = ajaxOperation.DeleteAjaxById('../controller/MyCartController.php', invoiceId);
                    if(response == 1){
                        Success('Your Order has been Removed');
                        location.href = "my-cart.php";
                    }
                    else{
                        Failed('Something went wrong!.');
                    }
                }
            });

    })
})();