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
                                <li><a class="active" href="#check-out" data-bs-toggle="tab">check out</a></li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- shopping-cart start -->
                                <div class="tab-pane active" id="check-out">
                                    <form action="#">
                                        <div class="shop-cart-table check-out-wrap">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="billing-details pr-20">
                                                        <h4 class="title-1 title-border text-uppercase mb-30">billing details</h4>
                                                        <input type="text" value="<?php echo( ucfirst($loggedUser->first_name) .' '. ucfirst($loggedUser->last_name)) ?>" readonly>
                                                        <input type="text" value="{{ $loggedUser->email }}" readonly>
                                                        <input type="text" value="{{ $loggedUser->nic }}" readonly>
                                                        <input type="text" value="{{ $loggedUser->mobile }}" readonly>
                                                        
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="our-order payment-details mt-60 pr-20">
                                                        <h4 class="title-1 title-border text-uppercase mb-30">our order</h4>
                                                        <table>
                                                            <thead>
                                                                <tr>
                                                                    <th><strong>Product</strong></th>
                                                                    <th class="text-end"><strong>Total</strong></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($cartItemArray as $item)
                                                                <tr>
                                                                    <td><?php echo $item->test_title . '(' . strtoupper($item->test_code) . ')' ?></td>
                                                                    <td class="text-end">LKR <?php echo $item->amount ?></td>
                                                                </tr>
                                                                
                                                                @endforeach
                                                                
                                                                <tr>
                                                                    <td>Order Total</td>
                                                                    <td class="text-end">LKR {{$cartTotal}}</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <a  href="javascript:;" class="button-one submit-button mt-15" data-text="place order"  onclick="submitOrder()">place order</a>

                                                    </div>
                                                </div>
                                                <!-- payment-method -->

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

    <script>
        function submitOrder() {
            $.ajax({
                type: "POST",
                url: '/place-order',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'id=',
                success: function(msg) {

                    if (msg[0].response_code == 200) {
                        location.href = 'pay-online';
                        
                    } else {
                        swal({
                            title: 'Error!',
                            text: msg[0].response_text,
                            icon: 'error',
                            timer: 2000,
                            button: false
                        }).then(
                            function() {},
                            function(dismiss) {
                                if (dismiss === 'timer') {}
                            }
                        )
                    }

                }
            });
        }
    </script>

</body>

</html>