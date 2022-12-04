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
    <div class="wrapper">

        @include('patient-portal/partials/header')

        <div class="login-area  pb-80">
            <div class="container">
                <form id="login_form">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="customer-login text-left">
                                <h4 class="title-1 title-border text-uppercase mb-30">Registered customers</h4>
                                <p class="text-gray">If you have an account with us, Please login!</p>
                                <input type="text" placeholder="Mobile here..." name="mobile">
                                <button type="submit" data-text="login" class="button-one submit-button mt-15">login</button>
                            </div>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        @include('patient-portal/partials/footer')


    </div>
    <!-- WRAPPER END -->
    @include('patient-portal/partials/footer-script')
    <script>
        $('#login_form').on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                type: "POST",
                url: '/login',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $(this).serialize(),
                success: function(msg) {
                    
                    if (msg[0].response_code == 200) {
                        location.href = '/otp?mobile='+msg[0].mobile;
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

        });
    </script>
</body>

</html>