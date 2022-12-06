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
        <!-- content here -->
        <!-- ORDER-AREA START -->
        <div class="shopping-cart-area  pt-80 pb-80">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shopping-cart">
                            <!-- Nav tabs -->
                            <ul class="cart-page-menu nav row clearfix mb-30">
                                <li><a class="active" href="#order-complete" data-bs-toggle="tab">order History</a></li>
                                <li><a href="#check-out" data-bs-toggle="tab">My profile</a></li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- order-complete start -->
                                <div class="tab-pane active" id="order-complete">
                                    <form action="#">
                                        <div class="shop-cart-table">
                                            <div class="table-content table-responsive">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th class="product-thumbnail">Test</th>
                                                            <th class="product-price">Paid Amount</th>
                                                            <th class="product-stock">Appointment Date</th>
                                                            <th class="product-add-cart">Report Status</th>
                                                            <th class="product-remove"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($orderHistory as $test)
                                                        <tr>
                                                            <td class="product-thumbnail  text-left">
                                                                <!-- Single-product start -->
                                                                <div class="single-product">
                                                                    
                                                                    <div class="product-info">
                                                                        <h4 class="post-title"><a class="text-light-black" href="#">{{ $test->test_title }} ({{ $test->test_code }})</a></h4>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <!-- Single-product end -->
                                                            </td>
                                                            <td class="product-price">LKR {{ $test->fee }}</td>
                                                            <td class="product-stock">{{ $test->appointment_time }}</td>
                                                            <td class="product-add-cart">
                                                                pending
                                                            </td>
                                                            <td class="product-remove">
                                                                <a href="#">View Report</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- order-complete end -->

                                <!-- check-out start -->
                                <div class="tab-pane" id="check-out">
                                    <form id="register_form">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="customer-login text-left">
                                                    <h4 class="title-1 title-border text-uppercase mb-30">profile</h4>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>First Name</label>
                                                            <input type="text" placeholder="Your first name here..." name="first_name" value="{{ $loggedUser->first_name }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Last Name</label>
                                                            <input type="text" placeholder="Your last name here..." name="last_name" value="{{ $loggedUser->last_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>NIC</label>
                                                            <input type="text" placeholder="Your NIC here..." name="nic" value="{{ $loggedUser->nic }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Mobile (<small>Please enter the 9 digit mobile number e.g 77xxxxxxx, 76xxxxxxx, 78xxxxxxx, 71xxxxxxx.</small>)</label>
                                                            <input type="text" placeholder="Your mobile no here..." name="mobile" value="{{ $loggedUser->mobile }}">

                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label>Email</label>
                                                            <input type="email" placeholder="Your email  here..." name="email" value="{{ $loggedUser->email }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Date of Birth</label>
                                                            <input type="date" placeholder="" name="dob" value="{{ $loggedUser->date_of_birth }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Gender</label>
                                                            <select name="gender">
                                                                <option>Select Gender</option>
                                                                <option value="Male" <?php echo (($loggedUser->gender == 'male') ? 'selected' : '') ?>>Male</option>
                                                                <option value="Female" <?php echo (($loggedUser->gender == 'female') ? 'selected' : '') ?>>Female</option>
                                                            </select>

                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $loggedUser->id }}">
                                                    </div>


                                                    <button type="submit" data-text="regiter" class="button-one submit-button mt-15">update</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- check-out end -->
                                
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ORDER-AREA END -->
        <!-- content here -->

        @include('patient-portal/partials/footer')


    </div>
    <!-- WRAPPER END -->
    @include('patient-portal/partials/footer-script')
    <script>
        $('#register_form').on('submit', function(e) {

            e.preventDefault();

            $.ajax({
                type: "POST",
                url: '/update-patient',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $(this).serialize(),
                success: function(msg) {
                    
                    if (msg[0].response_code == 200) {
                        swal({
                            title: 'Success!',
                            text: msg[0].response_text,
                            icon: 'success',
                            timer: 2000,
                            button: false
                        })
                    } else {
                        swal({
                            title: 'Error!',
                            text: msg[0].response_text,
                            icon: 'error',
                            timer: 3000,
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