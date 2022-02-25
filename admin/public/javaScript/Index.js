(function () {
    let selector = {
        labels: [],
        order: [],
        deliver: [],
        userRole: $("#userRole"),
    }
    let deliverySelector = {
        labels: [],
        order: [],
        deliver:[],
    }
    function GenerateChart() {
        new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: {
                labels: selector.labels,
                datasets: [
                    {
                        label: "Order",
                        backgroundColor: "#00ff99",
                        data: selector.order,
                    }, {
                        label: "Deliver",
                        backgroundColor: "#ff1a1a",
                        data: selector.deliver,
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Order & Deliver'
                }
            }
        });
    }
    function GenerateDeliveryChart()
    {
        new Chart(document.getElementById("bar-chart-deliveryMan"), {
            type: 'bar',
            data: {
                labels: deliverySelector.labels,
                datasets: [
                    {
                        label: "Order",
                        backgroundColor: "#00ff99",
                        data: deliverySelector.order,
                    }, {
                        label: "Deliver",
                        backgroundColor: "#ff1a1a",
                        data: deliverySelector.deliver,
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Order & Deliver'
                }
            }
        });
    }

    function GatheringInformationForChart() {
         $.ajax({
            url: "../controller/DashboardController.php",
            method: "GET",
            data: ({'search': 'search'}),
            async: false,
            success: function(response){
                let conversion = JSON.parse(response);
                selector.labels = conversion.days;
                selector.order = conversion.order;
                selector.deliver = conversion.deliver;
                GenerateChart();
            }
        })
    }
    function GatheringInformationForDeliveryMan()
    {
        $.ajax({
            url: "../controller/DashboardController.php",
            method: "GET",
            data: ({ 'deliveryMan': 'deliveryMan' }),
            async: false,
            success: function (response) {
                let conversion = JSON.parse(response);
                deliverySelector.labels = conversion.days;
                deliverySelector.order = conversion.order;
                deliverySelector.deliver = conversion.deliver;
                GenerateDeliveryChart();
            }
        });
    }
    function ShowTime() {
        var dt = new Date();
        document.getElementById("dateTime")
            .innerHTML = dt.toLocaleTimeString();
    }  
    window.onload = function () {
        console.log(selector.userRole.val());
        if (selector.userRole.val() != 'DeliveryMan') {
            GatheringInformationForChart();
        }
        else {
            GatheringInformationForDeliveryMan();
        }
        setInterval(ShowTime, 1000);
    }
})();