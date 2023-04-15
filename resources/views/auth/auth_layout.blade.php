
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>@yield('title')</title>
        <!-- Favicon -->

        <!-- ====================================== start css vito files ========================== -->
        <link href="{{asset('assets/plugins/vito/css/bootstrap.min.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/css/typography.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/css/style.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/css/responsive.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/css/custom-lang.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <!-- ====================================== end css vito files ============================ -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    </head>
    <body style="overflow-x: hidden;">
        <section class="sign-in-page">
            <div class="container p-0 mt-5 bg-white">
                <div class="row no-gutters">
                    <div class="col-sm-6 align-self-center">
                        @yield('content')
                    </div>
                    <div class="text-center col-sm-6">
                        <div class="text-white sign-in-detail" style="padding: 20px 100px;">
                            <div class="owl-carousel" data-autoplay="true" data-loop="true" data-nav="false" data-dots="true" data-items="1" data-items-laptop="1" data-items-tab="1" data-items-mobile="1" data-items-mobile-sm="1" data-margin="0">
                                <div class="item">
                                    <img src="{{asset('assets/images/login.png')}}" class="mb-4 img-fluid" alt="logo">
                                    {{--  <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>  --}}
                                </div>
                                <div class="item">
                                    <img src="{{asset('assets/images/login.png')}}" class="mb-4 img-fluid" alt="logo">
                                    {{--  <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>  --}}
                                </div>
                                <div class="item">
                                    <img src="{{asset('assets/images/login.png')}}" class="mb-4 img-fluid" alt="logo">
                                    {{--  <h4 class="mb-1 text-white">Manage your orders</h4>
                                    <p>It is a long established fact that a reader will be distracted by the readable content.</p>  --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ===============================  st'.app()->getLocale().'t vito js files =============================== -->
        <script src="{{asset('assets/plugins/vito/js/jquery-3.3.1.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/bootstrap.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/owl.carousel.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/jquery.magnific-popup.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/custom.js?v=8.0.3')}}"></script>
        @yield('scripts')
        <!-- ===============================  end vito js files ================================= -->
    </body>
</html>
