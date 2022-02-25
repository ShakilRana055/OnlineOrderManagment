</div>
    <script src="../public/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        var pathURL = window.location.pathname; 
        var pageURL = window.location.href;    
        var basedURL = window.location.origin; 
    </script>
    <script src="https://kendo.cdn.telerik.com/2021.1.330/js/kendo.all.min.js"></script>
    <script src="../public/jquery-ui/ui/widgets/datepicker.js"></script>
    <script src="../public/bootstrapSwitch/bootstrap-switch.js"></script>
    <script src="../public/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../public/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../public/moment/min/moment.min.js"></script>
    <script src="../public/peity/jquery.peity.min.js"></script>
    <script src="../public/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="../public/jquery-validation-unobtrusive/jquery.validate.unobtrusive.min.js"></script>
    <script src="../public/highlightjs/highlight.pack.min.js"></script>
    <script src="../public/parsleyjs/parsley.min.js"></script>
    <script src="../public/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../public/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="../public/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../public/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.15.7/sweetalert2.min.js"></script>
    <script src="../public/bracket/bracket.js"></script>
    <script src="../public/notify/notify.js"></script>
    <script src="../public/select2/select2.min.js"></script>
    <script src="../public/chartjs/chart.min.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

    <script src="../public/javaScript/notification.js"></script>
    <script src="../../ajax-library/AjaxOperation.js"></script>

    <script src=" https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
   
    <script type="text/javascript">
        $(document).ready(function () {
            var myDate = new Date();
            var hrs = myDate.getHours();

            var greet;

            if (hrs < 12)
                greet = 'Good Morning';
            else if (hrs >= 12 && hrs <= 17)
                greet = 'Good Afternoon';
            else if (hrs >= 17 && hrs <= 20)
            greet = 'Good Evening';
            else if (hrs >= 20 && hrs <= 24)
                greet = 'Good Night';

            document.getElementById('lblGreetings').innerHTML =
                '<b>' + greet + '</b>';
        });
    </script>
    <script src="~/js/site.js" asp-append-version="true"></script>
    <div id="informationModal" class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="exampleModalLabel"><i class="fa fa-universal-access"><span id="modalHeading">Add Role</span> </i></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="informationModalDiv">

                </div>
            </div>
        </div>
    </div>
</body>
</html>
