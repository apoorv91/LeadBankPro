
<?php
include_once '../system/autoloader.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Giovanne Oliveira">
    <link rel="shortcut icon" href="<?php echo ASSETS_URL;?>/img/favicon.png">

     <title><?php echo PRODUCT_NAME;?> Re-Send Mail</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo ASSETS_URL;?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo ASSETS_URL;?>/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo ASSETS_URL;?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!--toastr-->
    <link href="<?php echo ASSETS_URL;?>/toastr-master/toastr.css" rel="stylesheet" type="text/css" />

    <!-- Custom styles for this template -->

    <link href="<?php echo ASSETS_URL;?>/css/style.css" rel="stylesheet">
    <link href="<?php echo ASSETS_URL;?>/css/style-responsive.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL;?>/bootstrap-datepicker/css/datepicker.css" />

    <script src="<?php echo ASSETS_URL;?>/js/html5shiv.js"></script>
    <script src="<?php echo ASSETS_URL;?>/js/respond.min.js"></script>

</head>

<body>

    <section id="container" >
        <!--header start-->
        <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div>
            <!--logo start-->
            <a href=".././" class="logo"><?php echo $logo_name; ?></a>
            <!--logo end-->
        </header>
        <section >
            <section class="wrapper">
                <div class="row">
                 <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <!--work progress start-->
                        <section class="panel">
                            <div class="panel-body progress-panel">
                                <div class="task-progress">
                                    <h1> Re-Send Login Credentials</h1><br>
                                </div>
                            </div>
                            <form role="form" id="frmsendmail">
                               <div class="form-group">
                                <label for="txtCustomerEmail">Enter the email you used to purchase your product below*</label>
                                <input type="email" class="form-control" id="txtCustomerEmail" placeholder="Customer E-mail">
                            </div>
                            <button type="submit" id="btnSubmit" class="btn btn-info">Send Email</button>
                        </form>
                    </section>
                    <!--work progress end-->
                </div>
                 <div class="col-md-3"></div>  
            </section>
        </section>
        <!--main content end-->

        <!--footer start-->
        <?php include '../assets/inc/footer.php';?>
        <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo ASSETS_URL;?>/js/jquery.js"></script>
    <script src="<?php echo ASSETS_URL;?>/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo ASSETS_URL;?>/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo ASSETS_URL;?>/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo ASSETS_URL;?>/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_URL;?>/js/jquery.sparkline.js" type="text/javascript"></script>
    <script src="<?php echo ASSETS_URL;?>/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
    <script src="<?php echo ASSETS_URL;?>/js/owl.carousel.js" ></script>
    <script src="<?php echo ASSETS_URL;?>/js/jquery.customSelect.min.js" ></script>
    <script src="<?php echo ASSETS_URL;?>/js/respond.min.js" ></script>

    <!--right slidebar-->
    <script src="<?php echo ASSETS_URL;?>/js/slidebars.min.js"></script>

    <!--common script for all pages-->
    <script src="<?php echo ASSETS_URL;?>/js/common-scripts.js"></script>

    <!--script for this page-->
    <script src="<?php echo ASSETS_URL;?>/js/sparkline-chart.js"></script>
    <script src="<?php echo ASSETS_URL;?>/js/easy-pie-chart.js"></script>
    <script src="<?php echo ASSETS_URL;?>/js/count.js"></script>
    <script type="text/javascript" src="<?php echo ASSETS_URL;?>/fuelux/js/spinner.min.js"></script>

    <script type="text/javascript" src="<?php echo ASSETS_URL;?>/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <?php
    include '../assets/inc/changepwd.php';
    ?>
    <script>
    $(function () {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        $("#frmsendmail").submit(function (e) {
            e.preventDefault();


            var customer_email = $("#txtCustomerEmail").val();

            $.ajax({

                type: "POST",
                data: {
                    customer_email:customer_email,
                    handler: 'sendMailNewPage'
                },

                url: "../ajax/",
                dataType: "json",
                success: function (result) {

                    if(result.status == 200)
                    {
                        $("#btnSubmit").html('Send Mail');
                         $("#txtCustomerEmail").html('');
                        toastr[result.message.type](result.message.text, result.message.header);
                        $("#btnSubmit").removeClass('disabled');
                    }else{
                        $("#btnSubmit").html('Send Mail');
                        //swal(result.message.header, result.message.text, result.message.type);
                        toastr[result.message.type](result.message.text, result.message.header);
                        $("#btnSubmit").removeClass('disabled');
                    }
                },
                beforeSend: function () {

                    $("#btnSubmit").html('Processing...');
                    $("#btnSubmit").addClass('disabled');

                },
                error: function () {
                    $("#btnSubmit").removeClass('disabled');
                    $("#btnSubmit").html('Send Mail');
                    toastr['error']("Unknown Error. Contact the support team.", "Oops!");
                }
            });
return false;
});
});

</script>
</body>
</html>
