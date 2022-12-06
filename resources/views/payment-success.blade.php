<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laboratory management system | Suhada Laboratories</title>
    <meta name="description" content="Hurst – Furniture Store eCommerce HTML Template is a clean and elegant design – suitable for selling flower, cookery, accessories, fashion, high fashion, accessories, digital, kids, watches, jewelries, shoes, kids, furniture, sports….. It has a fully responsive width adjusts automatically to any screen size or resolution.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('website/assets/img/favicon.ico')}}">
    <!-- Place favicon.ico in the root directory -->

    @include('patient-portal/partials/head-css')
</head>

<body>
    <!-- WRAPPER START -->
    <div class="wrapper bg-dark-white">

        @include('patient-portal/partials/header')
        <!-- content here -->
        <div class="shopping-cart-area  pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shopping-cart">
                            <!-- Nav tabs -->
                            <ul class="cart-page-menu nav row clearfix mb-30">
                                <li><a class="active" href="#order-complete" data-bs-toggle="tab">order complete</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">

                                <!-- order-complete start -->
                                <div class="tab-pane active" id="order-complete">
                                    <form action="#">
                                        <div class="thank-recieve bg-white mb-30">
                                            <p>Thank you. Your order has been received.</p>
                                        </div>
                                        <div class="order-info bg-white text-center clearfix mb-30">
                                            <div class="single-order-info">
                                                <h4 class="title-1 text-uppercase text-light-black mb-0">order no</h4>
                                                <p class="text-uppercase text-light-black mb-0"><strong><?php echo ('TO' . sprintf('%08d', $_GET['order_id'])) ?></strong></p>
                                            </div>
                                            <div class="single-order-info">
                                                <h4 class="title-1 text-uppercase text-light-black mb-0">Date</h4>
                                                <p class="text-uppercase text-light-black mb-0"><strong><?php echo date('M d, Y') ?> </strong></p>
                                            </div>
                                            <div class="single-order-info">
                                                <h4 class="title-1 text-uppercase text-light-black mb-0">Total</h4>
                                                <p class="text-uppercase text-light-black mb-0"><strong><?php echo $_GET['cartTotal'] ?></strong></p>
                                            </div>
                                            <div class="single-order-info">
                                                <h4 class="title-1 text-uppercase text-light-black mb-0">payment referance</h4>
                                                <p class="text-uppercase text-light-black mb-0"><a href="#"><strong><?php echo $_GET['payment_id'] ?></strong></a></p>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                                <!-- order-complete end -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content here -->

        @include('patient-portal/partials/footer')


    </div>
    <!-- WRAPPER END -->
    @include('patient-portal/partials/footer-script')

</body>

</html>