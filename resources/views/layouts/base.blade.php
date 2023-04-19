
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta char set="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{__('Task Management System')}} | @yield('title')</title>
        <!-- Favicon -->
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <!-- ==================== start codeediotr calendar =============================== -->
        <!-- <link rel='stylesheet' href="{{asset('assets/plugins/ckeditor/samples/css/samples.css')}}" /> -->
        <link rel='stylesheet' href="{{asset('assets/plugins/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css')}}" />
        <!-- ==================== end codeediotr calendar =============================== -->
        <!-- ====================================== start css vito files ========================== -->
        <link href="{{asset('assets/plugins/vito/css/bootstrap.min.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/css/typography.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/css/style.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/css/responsive.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/datatable/css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/plugins/vito/css/custom-lang.css?v=8.0.3')}}" rel="stylesheet" type="text/css" />
        <!-- ====================================== end css vito files ============================ -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@400;700;800&display=swap" rel="stylesheet">
        <!-- ====================================== start css js files ============================ -->
        <link href="{{asset('assets/plugins/jstree/dist/themes/default/style.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- ====================================== end css vito files ============================ -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
        <div class="wrapper">
            @include('include.header')
            @include('include.sidebar')
            <div id="content-page" class="content-page">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('include.footer')
        <script src="{{ asset('assets/js/map-input.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAUUCAis48Os0t-HFvIbhR6P0ZKU7JShXU&libraries=places&callback=initialize"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//js.pusher.com/3.1/pusher.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script type="text/javascript" src="{{asset('assets/js/notifications.js')}}"></script>

        <!-- ===============================  start vito js files =============================== -->
        <script src="{{asset('assets/plugins/vito/js/jquery.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/jquery-3.3.1.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/popper.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/bootstrap.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/jquery.appear.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/countdown.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/waypoints.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/jquery.counterup.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/wow.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/apexcharts.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/slick.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/select2.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/owl.carousel.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/jquery.magnific-popup.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/smooth-scrollbar.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/lottie.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/bodymovin.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/core.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/charts.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/animated.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/highcharts.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/highcharts-3d.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/highcharts-more.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/kelly.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/maps.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/morris.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/morris.min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/raphael-min.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/worldLow.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/en/js/chart-custom.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/vito/js/custom.js?v=8.0.3')}}"></script>
        <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>

        <script>
            $(document).ready(function() {

                $('.iq-menu-bt-sidebar').on('click' , function(){
                    if($('.logo-text').hasClass('delete-logo-text')){
                        $('.logo-text').removeClass('delete-logo-text');
                    }else{
                        $('.logo-text').addClass('delete-logo-text');
                    }
                });

                $('.iq-sidebar').on('mouseleave' , function(){
                    if($('.logo-text').hasClass('delete-logo-text')){
                        $('.logo-text').fadeOut(300);
                    }
                });

                $('.iq-sidebar').on('mouseenter' , function(){
                    if($('.logo-text').hasClass('delete-logo-text')){
                        $('.logo-text').fadeIn(300);
                    }
                });


            } );
        </script>
        <!--End of Tawk.to Script-->
        @yield('script')

        <!-- ===============================  end vito js files ================================= -->
    </body>
</html>
