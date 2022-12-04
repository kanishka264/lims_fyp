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
                <form id="register_form">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="customer-login text-left">
                                <h4 class="title-1 title-border text-uppercase mb-30">new Patient</h4>
                                <p class="text-gray">If you have an account with us, <a href="{{url('login')}}">Please login!</a></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>First Name</label>
                                        <input type="text" placeholder="Your first name here..." name="first_name">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Last Name</label>
                                        <input type="text" placeholder="Your last name here..." name="last_name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>NIC</label>
                                        <input type="text" placeholder="Your NIC here..." name="nic">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Mobile (<small>Please enter the 9 digit mobile number e.g 77xxxxxxx, 76xxxxxxx, 78xxxxxxx, 71xxxxxxx.</small>)</label>
                                        <input type="text" placeholder="Your mobile no here..." name="mobile">

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="email" placeholder="Your email  here..." name="email">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Date of Birth</label>
                                        <input type="date" placeholder="" name="dob">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Gender</label>
                                        <select name="gender">
                                            <option>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>

                                    </div>
                                </div>


                                <button type="submit" data-text="regiter" class="button-one submit-button mt-15">regiter</button>
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
        $('#register_form').on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                type: "POST",
                url: '/register-patient',
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