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

        <!-- SLIDER-BANNER-AREA START -->
        <section class="slider-banner-area clearfix">
            <!-- Sidebar-social-media start -->
            <div class="sidebar-social d-none d-md-block">
                <div class="table">
                    <div class="table-cell">
                        <ul>
                            <li><a href="#" target="_blank" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a></li>
                            <li><a href="#" target="_blank" title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                            <li><a href="#" target="_blank" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>
                            <li><a href="#" target="_blank" title="Linkedin"><i class="zmdi zmdi-linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Sidebar-social-media start -->
            <div class="banner-left floatleft">
                <!-- Slider-banner start -->
                <div class="slider-banner">
                    <div class="single-banner banner-1">
                        <a class="banner-thumb" href="#"><img src="{{asset('website/assets/img/banner/1.jpg')}}" alt="" /></a>
                        <span class="pro-label new-label">new</span>
                        <span class="price">$50.00</span>
                        <div class="banner-brief">
                            <h2 class="banner-title"><a href="#">Product name</a></h2>
                            <p class="mb-0">Furniture</p>
                        </div>
                        <a href="#" class="button-one font-16px" data-text="Buy now">Buy now</a>
                    </div>
                    <div class="single-banner banner-2">
                        <a class="banner-thumb" href="#"><img src="{{asset('website/assets/img/banner/2.jpg')}}" alt="" /></a>
                        <div class="banner-brief">
                            <h2 class="banner-title"><a href="#">New Product 2021</a></h2>
                            <a href="#" class="button-one font-16px" data-text="Buy now">Buy now</a>
                        </div>
                    </div>
                </div>
                <!-- Slider-banner end -->
            </div>
            <div class="slider-right floatleft">
                <!-- Slider-area start -->
                <div class="slider-area">
                    <div class="bend niceties preview-2">
                        <div id="ensign-nivoslider" class="slides">
                            <img src="{{asset('website/assets/img/slider/slider-1/1.jpg')}}" alt="" title="#slider-direction-1" />
                            <img src="{{asset('website/assets/img/slider/slider-1/2.jpg')}}" alt="" title="#slider-direction-2" />
                            <img src="{{asset('website/assets/img/slider/slider-1/3.jpg')}}" alt="" title="#slider-direction-3" />
                        </div>
                        <!-- direction 1 -->
                        <div id="slider-direction-1" class="t-cn slider-direction">
                            <div class="slider-progress"></div>
                            <div class="slider-content t-lfl s-tb slider-1">
                                <div class="title-container s-tb-c title-compress">
                                    <div class="layer-1">
                                        <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.5s">
                                            <h2 class="slider-title3 text-uppercase mb-0">welcome to our</h2>
                                        </div>
                                        <div class="wow fadeIn" data-wow-duration="1.5s" data-wow-delay="1.5s">
                                            <h2 class="slider-title1 text-uppercase mb-0">furniture</h2>
                                        </div>
                                        <div class="wow fadeIn" data-wow-duration="2s" data-wow-delay="2.5s">
                                            <h3 class="slider-title2 text-uppercase">gallery 2021</h3>
                                        </div>
                                        <div class="wow fadeIn" data-wow-duration="2.5s" data-wow-delay="3.5s">
                                            <a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- direction 2 -->
                        <div id="slider-direction-2" class="slider-direction">
                            <div class="slider-progress"></div>
                            <div class="slider-content t-lfl s-tb slider-1">
                                <div class="title-container s-tb-c title-compress">
                                    <div class="layer-1">
                                        <div class="wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.5s">
                                            <h2 class="slider-title3 text-uppercase mb-0">welcome to our</h2>
                                        </div>
                                        <div class="wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.5s">
                                            <h2 class="slider-title1 text-uppercase">furniture</h2>
                                        </div>
                                        <div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
                                            <p class="slider-pro-brief">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
                                        </div>
                                        <div class="wow fadeInUpBig" data-wow-duration="2.5s" data-wow-delay="0.5s">
                                            <a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- direction 3 -->
                        <div id="slider-direction-3" class="slider-direction">
                            <div class="slider-progress"></div>
                            <div class="slider-content t-lfl s-tb slider-1">
                                <div class="title-container s-tb-c title-compress">
                                    <div class="layer-1">
                                        <div class="wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.5s">
                                            <h2 class="slider-title3 text-uppercase mb-0">welcome to our</h2>
                                        </div>
                                        <div class="wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.5s">
                                            <h2 class="slider-title1 text-uppercase mb-0">furniture</h2>
                                        </div>
                                        <div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
                                            <h3 class="slider-title2 text-uppercase">gallery 2021</h3>
                                        </div>
                                        <div class="wow fadeInUpBig" data-wow-duration="2.5s" data-wow-delay="0.5s">
                                            <p class="slider-pro-brief">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable</p>
                                        </div>
                                        <div class="wow fadeInUpBig" data-wow-duration="3s" data-wow-delay="0.5s">
                                            <a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Slider-area end -->
            </div>
            <!-- Sidebar-social-media start -->
            <div class="sidebar-account d-none d-md-block">
                <div class="table">
                    <div class="table-cell">
                        <ul>
                            <li><a class="search-open" href="#" title="Search"><i class="zmdi zmdi-search"></i></a></li>
                            <li><a href="{{ url('/login') }}" title="Login"><i class="zmdi zmdi-lock"></i></a></li>
                            <li><a href="{{ url('/my-portal') }}" title="My-Account"><i class="zmdi zmdi-account"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Sidebar-social-media start -->
        </section>
        <!-- End Slider-section -->
        <!-- sidebar-search Start -->
        <div class="sidebar-search animated slideOutUp">
            <div class="table">
                <div class="table-cell">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 offset-md-2 p-0">
                                <div class="search-form-wrap">
                                    <button class="close-search"><i class="zmdi zmdi-close"></i></button>
                                    <form action="#">
                                        <input type="text" placeholder="Search here..." />
                                        <button class="search-button" type="submit">
                                            <i class="zmdi zmdi-search"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- sidebar-search End -->
        <!-- PRODUCT-AREA START -->
        <div class="product-area pt-80 pb-35">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2 class="title-border">Featured Lab Testing</h2>
                        </div>
                        <div class="product-slider style-1 arrow-left-right">
                            @foreach($lab_testing_list as $test):
                            <!-- Single-product start -->
                            <div class="single-product">
                                <div class="product-img">
                                    <a href=""><img src="{{asset('website/assets/img/product/1.jpg')}}" alt="" /></a>
                                    <div class="product-action clearfix">
                                        <a href="javascript:;" onclick="addItemToCart('{{ $test->id }}')" data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
                                    </div>
                                </div>
                                <div class="product-info clearfix">
                                    <div class="fix">
                                        <h4 class="post-title floatleft"><a href="#">{{ $test->test_title }}({{ $test->test_code }})</a></h4>
                                    </div>
                                    <div class="fix">
                                        <span class="pro-price floatleft">LKR {{ $test->amount }}</span>

                                    </div>
                                </div>
                            </div>
                            <!-- Single-product end -->


                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- PRODUCT-AREA END -->

        @include('patient-portal/partials/footer')


    </div>
    <!-- WRAPPER END -->
    @include('patient-portal/partials/footer-script')

    <script>
        function addItemToCart($id) {
            $.ajax({
                type: "POST",
                url: '/add-item-to-cart',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: 'id='+$id,
                success: function(msg) {

                    if (msg[0].response_code == 200) {
                        swal({
                            title: 'Success!',
                            text: msg[0].response_text,
                            icon: 'success',
                            timer: 2000,
                            button: false
                        });
                        $('#cartCount').html(msg[0].cartCount);
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