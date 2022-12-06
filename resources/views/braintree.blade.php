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
    <script src="https://js.braintreegateway.com/web/dropin/1.24.0/js/dropin.min.js"></script>
</head>

<body>
    <!-- WRAPPER START -->
    <div class="wrapper">

        @include('patient-portal/partials/header')
        <!-- content here -->
        <div class="py-12">
            <div id="dropin-container" style="display: flex;justify-content: center;align-items: center;"></div>
            <div style="display: flex;justify-content: center;align-items: center; color: white">
                <button id="submit-button"  class="btn btn-sm btn-success" href="{{ url('payment')}}">Pay Now</button>
            </div>

        </div>
        <!-- content here -->

        @include('patient-portal/partials/footer')


    </div>
    <!-- WRAPPER END -->
    @include('patient-portal/partials/footer-script')

    <script>
        var button = document.querySelector('#submit-button');
        braintree.dropin.create({
            authorization: '{{$token}}',
            container: '#dropin-container'
        }, function(createErr, instance) {
            button.addEventListener('click', function() {
                instance.requestPaymentMethod(
                    function(err, payload) {
                        (function($) {
                            $(function() {
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                    type: "POST",
                                    url: "/payment",
                                    data: {
                                        nonce: payload.nonce
                                    },
                                    success: function(data) {
                                        if(data[0].res == 200){
                                            location.href= "payment-success?order_id="+data[0].order_id+"&cartTotal="+data[0].cartTotal+"&payment_id="+data[0].payment_id;
                                        }else{
                                            location.href= "payment-fail";
                                        }
                                        console.log('success', payload.nonce)
                                    },
                                    error: function(data) {
                                        console.log('error', payload.nonce)
                                    }
                                });
                            });
                        })(jQuery);
                    }
                );
            });
        });
    </script>

</body>

</html>