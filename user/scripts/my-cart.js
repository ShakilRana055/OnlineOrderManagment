

(function () {
    let selector = {
        information: ".information",
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

})();