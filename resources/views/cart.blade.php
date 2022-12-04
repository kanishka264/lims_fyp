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
        <!-- SHOPPING-CART-AREA START -->
        <div class="shopping-cart-area pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shopping-cart">
                            <!-- Nav tabs -->
                            <ul class="cart-page-menu nav row clearfix mb-30">
                                <li><a class="active" href="#shopping-cart" data-bs-toggle="tab">shopping cart</a></li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- shopping-cart start -->
                                <div class="tab-pane active" id="shopping-cart">
                                    <form action="#">
                                        <div class="shop-cart-table">
                                            <div class="table-content table-responsive">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">Test</th>
                                                            <th class="product-price">Price</th>
                                                            <th class="product-remove">Remove</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($cartItemArray as $item)
                                                        
                                                        <tr>
                                                            <td class="product-thumbnail  text-left">
                                                                <!-- Single-product start -->
                                                                <div class="single-product">
                                                                    <div class="product-info">
                                                                        <h4 class="post-title"><a class="text-light-black" href="#"><?php echo $item->test_title .'('. strtoupper($item->test_code).')' ?></a></h4>
                                                                    </div>
                                                                </div>
                                                                <!-- Single-product end -->
                                                            </td>
                                                            <td class="product-price">LKR <?php echo $item->amount ?></td>

                                                            <td class="product-remove">
                                                                <a href="#"><i class="zmdi zmdi-close"></i></a>
                                                            </td>
                                                        </tr>
                                                        @endforeach


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <div class="customer-login payment-details mt-30">
                                                    <h4 class="title-1 title-border text-uppercase">payment details</h4>
                                                    <table>
                                                        <tbody>
                                                            
                                                            <tr>
                                                                <td class="text-left">Order Total</td>
                                                                <td class="text-end">LKR {{$cartTotal}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <a type="submit" data-text="Proceed to Checkout" class="button-one submit-button mt-15">Proceed to Checkout</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                                <!-- shopping-cart end -->
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SHOPPING-CART-AREA END -->
        <!-- content here -->

        @include('patient-portal/partials/footer')


    </div>
    <!-- WRAPPER END -->
    @include('patient-portal/partials/footer-script')

</body>

</html>