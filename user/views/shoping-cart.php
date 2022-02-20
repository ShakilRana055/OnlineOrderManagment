<?php 
    $topBanner = true;
    $shopPage = true;
    $title = 'Online Food Service - Shoping- Cart';
    $pageName = 'Shoping Cart';
    include('layout/topbar.php');
?>

<style>
    #shopping-cart thead tr th, tbody tr td{
        text-align : center;
    }
</style>


    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <table class = 'table table-hover table-bordered' id = 'shopping-cart'>
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Total Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id = 'shoppingCartList'>
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-4 col-md-4">
                    
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->
  
<?php include('layout/footer.php');?>

<script>
    (function(){
        let ajaxOperation = new AjaxOperation();
        let shoppingDetail = [];
        let selector = {
            shoppingCartList : $("#shoppingCartList"),
        }
        class Process{
            constructor() { }

            CalculateDiscount(data){
                let final = data.price - Math.round(((data.price * data.discount) / 100));
                return final;
            }

            UpdateTotalPrice(data){
                let serialNumber = data.serialNumber;
                let totalprice = this.CalculateDiscount(data);
                $('.totalPrice').each(function(){
                    if(Number($(this).attr('serialNumber')) == serialNumber){
                        $(this).text(totalprice);
                    }
                });
            }
            
            FillTotalPrice(){
                let self = this;
                $("#shoppingCartList tr").each(function(i, row){
                    let price = Number($(this).find('td .tempQuantity').attr('price'));
                    let quantity = Number($(this).find('td .tempQuantity').val());
                    let discount = Number($(this).find('td .tempQuantity').attr('discount'));
                    let serialNumber = Number($(this).find('td .tempQuantity').attr('serialNumber'));
                    let jsonData = {
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
                let response = ajaxOperation.GetAjaxHtmlByValue('../controller/ShoppingCartController.php', 'getTempShoppingCart');
                selector.shoppingCartList.html(response);
                this.FillTotalPrice();
            }

        }
    
        let process = new Process();

        window.onload = function(){
            process.PopulateShoppingCart();
        }

    })();
</script>
