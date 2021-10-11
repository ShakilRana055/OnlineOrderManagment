

class AjaxOperation {
    constructor() { }
    SaveAjax(destination, jsonData) {
        let data;
        $.ajax({
            url: destination,
            type: "post",
            data: jsonData,
            async: false,
            processData: false,
            contentType: false,
            success: function (response) {
                data = response;
            }
        });
        return data;
    }

    SavePostAjax(destination, jsonData) {
        let data;
        $.ajax({
            url: destination,
            type: "POST",
            data: jsonData,
            async: false,
            success: function (response) {
                data = response;
            }
        });
        return data;
    }

    DeleteAjaxById(destination, jsonData) {
        let data;
        $.ajax({
            url: destination,
            data: ({ "id": jsonData }),
            async: false,
            success: function (response) {
                data = response;
            }
        });
        return data;
    }

    GetAjax(destination) {
        let getAjax;
        $.ajax({
            url: destination,
            method: "GET",
            dataType: "JSON",
            async: false,
            success: function (response) {
                getAjax = response;
            }
        });
        return getAjax;
    }

    GetAjaxByValue(destination, value) {
        let getAjaxByValue;
        $.ajax({
            url: destination,
            method: "GET",
            data: ({ "search": value }),
            async: false,
            success: function (response) {
                getAjaxByValue = response;
            }
        });
        return getAjaxByValue;
    }

    GetAjaxHtml(destination) {
        let getAjaxHtml;
        $.ajax({
            url: destination,
            method: "GET",
            dataType: "html",
            async: false,
            success: function (response) {
                getAjaxHtml = response;
            }
        });
        return getAjaxHtml;
    }

    GetAjaxHtmlByValue(destination, value) {
        let getAjaxHtmlByValue;
        $.ajax({
            url: destination,
            method: "GET",
            data: ({ "search": value }),
            dataType: "html",
            async: false,
            success: function (response) {
                getAjaxHtmlByValue = response;
            }
        });
        return getAjaxHtmlByValue;
    }
    GetAjaxHtmlByJson(destination, jsonData) {
        let getAjaxHtmlByValue;
        $.ajax({
            url: destination,
            method: "GET",
            data: jsonData,
            dataType: "html",
            async: false,
            success: function (response) {
                getAjaxHtmlByValue = response;
            }
        });
        return getAjaxHtmlByValue;
    }
}


class ModalOperation {
    constructor() { }

    ModalHide(modalId) {
        $(modalId).modal("hide");
    }

    ModalShow(modalId) {
        $(modalId).modal("show");
    }

    ModalOpenWithHtml(modalId, modalDiv, htmlData) {
        $(modalId).modal("show");
        $(modalDiv).html(htmlData);
    }

    ModalClose(modalId, modalDiv) {
        $(modalId).modal("hide");
        $(modalDiv).html("");
    }

    ModalStatic(modalId) {
        $(modalId).modal({
            backdrop: 'static',
            keyboard: false
        });
    }
}