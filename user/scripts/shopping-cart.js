
(function(){
    let ajaxOperation = new AjaxOperation();
    let shoppingDetail = [];
    let selector = {
        shoppingCartList : $("#shoppingCartList"),
        grandTotal: $("#grandTotal"),
        deliveryDate : $("#deliveryDate"),
        confirmOrder : $("#confirmOrder"),
        phone : $("#phone"),
        address : $("#address"),

        minus : '.minus',
        plus : '.plus',
        tempQuantity : '.tempQuantity',
        deleteBtn : '.deleteBtn',
    }
    class Process{
        constructor() { }

        CalculateDiscount(data){
            let final = (data.quantity * data.price) - Math.round(((data.quantity * data.price * data.discount) / 100));
            return final;
        }
        SetGrandTotal(){
            let totalPrice = 0;
            $('.totalPrice').each(function(){
                totalPrice += Number($(this).text());
            });
            selector.grandTotal.text(totalPrice);
        }
        UpdateTotalPrice(data){
            let serialNumber = data.serialNumber;
            let totalprice = this.CalculateDiscount(data);
            $('.totalPrice').each(function(){
                if(Number($(this).attr('serialNumber')) == serialNumber){
                    $(this).text(totalprice);
                }
            });
            this.SetGrandTotal();
        }
        
        UpdateQuantity(data){
            let serialNumber = data.serialNumber;
            $('.tempQuantity').each(function(){
                if(Number($(this).attr('serialNumber')) == serialNumber){
                    $(this).val(data.quantity);
                }
            });
        }

        FillTotalPrice(){
            let self = this;
            $("#shoppingCartList tr").each(function(i, row){
                let id = Number($(this).find('td .tempQuantity').attr('id'));
                let foodItemId = Number($(this).find('td .tempQuantity').attr('foodItemId'));
                let price = Number($(this).find('td .tempQuantity').attr('price'));
                let quantity = Number($(this).find('td .tempQuantity').val());
                let discount = Number($(this).find('td .tempQuantity').attr('discount'));
                let serialNumber = Number($(this).find('td .tempQuantity').attr('serialNumber'));
                let jsonData = {
                    id,
                    foodItemId,
                    price,
                    discount,
                    serialNumber,
                    quantity
                };
                shoppingDetail.push(jsonData);
                self.UpdateTotalPrice(jsonData);
            });
        }

        PopulateShoppingCart(){
            shoppingDetail = [];
            let response = ajaxOperation.GetAjaxHtmlByValue('../controller/ShoppingCartController.php', 'getTempShoppingCart');
            selector.shoppingCartList.html(response);
            if (selector.shoppingCartList.length > 0)
                this.FillTotalPrice();
        }
        SaveUpdateQuantity(data){

            let formData = new FormData();
            formData.append("updateQuantity", "updateQuantity");
            formData.append("id",data.id);
            formData.append("quantity",data.quantity);
            let response = ajaxOperation.SaveAjax('../controller/ShoppingCartController.php', formData);
        }

        SaveInvoice(data) {
            let response = ajaxOperation.SavePostAjax('../controller/ShoppingCartController.php', data);
            if (response == 1) {
                Success('Order Confirmed!');
                location.href = "shop.php";
            }
            else{
                Failed('Something went wrong!');
            }
        }
    }

    let process = new Process();
    document.getElementById('deliveryDate').valueAsDate = new Date();
    window.onload = function(){
        process.PopulateShoppingCart();
    }

    $(document).on("click", selector.minus, function(){
        let serialNumber = Number($(this).attr('serialNumber'));
        let eventIndex = shoppingDetail.findIndex(item => item.serialNumber == serialNumber);
        if(shoppingDetail[eventIndex].quantity > 1){
            shoppingDetail[eventIndex].quantity--;
            process.UpdateQuantity(shoppingDetail[eventIndex]);
            process.UpdateTotalPrice(shoppingDetail[eventIndex]);
            process.SaveUpdateQuantity(shoppingDetail[eventIndex]);
        }
    });

    $(document).on("click", selector.plus, function(){
        let serialNumber = Number($(this).attr('serialNumber'));
        let eventIndex = shoppingDetail.findIndex(item => item.serialNumber == serialNumber);
        shoppingDetail[eventIndex].quantity++;
        process.UpdateQuantity(shoppingDetail[eventIndex]);
        process.UpdateTotalPrice(shoppingDetail[eventIndex]);
        process.SaveUpdateQuantity(shoppingDetail[eventIndex]);
    });

    $(document).on("click", selector.deleteBtn, function(e){
        e.preventDefault();
        let id = $(this).attr('id');
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
                let response = ajaxOperation.DeleteAjaxById('../controller/ShoppingCartController.php', id);
                if(response == 1){
                    Success('Your file has been deleted');
                    process.PopulateShoppingCart();
                }
                else{
                    Failed('Something went wrong!.');
                }
            }
        });
    });

    selector.confirmOrder.click(function(){
        
        let isOk = true;
        let invoiceDetail = [];
        let subTotal = 0;
        for(let i = 0; i < shoppingDetail.length; i++){
            let item = {
                foodItemId: shoppingDetail[i].foodItemId,
                unitPrice: shoppingDetail[i].price,
                discount: shoppingDetail[i].discount,
                quantity: shoppingDetail[i].quantity,
                totalPrice: process.CalculateDiscount(shoppingDetail[i])
            };
            subTotal += (item.unitPrice * item.quantity);
            invoiceDetail.push(item);
        }
        let formData = {
            confirmOrder: 'confirmOrder',
            grandTotal: selector.grandTotal.text(),
            subTotal: subTotal,
            deliveryDate: selector.deliveryDate.val(),
            phone: selector.phone.val(),
            address: selector.address.val(),
            invoiceDetail: invoiceDetail
        };

        if(selector.phone.val() == ""){
            selector.phone.css('border-color', '#f00');
            isOk = false;
        }
        if(selector.address.val() == ""){
            selector.address.css('border-color', '#f00');
            isOk = false;
        }
        if(isOk){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm it!'
            }).then((result) => {
                if (result.value) {
                    process.SaveInvoice(formData);
                }
            });

        }
    });

    const MinDateToday = function(){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();

        if (dd < 10) {
        dd = '0' + dd;
        }

        if (mm < 10) {
        mm = '0' + mm;
        } 
        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("deliveryDate").setAttribute("min", today);
    }

    $(document).ready(function(){
        MinDateToday();
    });

})();
