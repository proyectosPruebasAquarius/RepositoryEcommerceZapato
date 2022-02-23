<!DOCTYPE HTML>
<html>

<head>
    <title>@yield('title', ENV('APP_NAME'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Rokkitt:100,300,400,700" rel="stylesheet">

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.css') }}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{ asset('frontend/css/icomoon.css') }}">
    <!-- Ion Icon Fonts-->
    <link rel="stylesheet" href="{{ asset('frontend/css/ionicons.min.css') }}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{ asset('frontend/css/flexslider.css') }}">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.min.css') }}">

    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-datepicker.css') }}">
    <!-- Flaticons  -->
    <link rel="stylesheet" href="{{ asset('frontend/fonts/flaticon/font/flaticon.css') }}">

    <!-- Theme style  -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
    @livewireStyles
</head>

<body>

    <div class="colorlib-loader"></div>

    <div id="page">
        @include('frontend.partials.navbar')
        
        @yield('content')
        
        @include('frontend.partials.footer')
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="ion-ios-arrow-up"></i></a>
    </div>

    @livewireScripts
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
    <x-livewire-alert::scripts />

    <!-- jQuery -->
    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <!-- popper -->
    <script src="{{ asset('frontend/js/popper.min.js') }}"></script>
    <!-- bootstrap 4.1 -->
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <!-- jQuery easing -->
    <script src="{{ asset('frontend/js/jquery.easing.1.3.js') }}"></script>
    <!-- Waypoints -->
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <!-- Flexslider -->
    <script src="{{ asset('frontend/js/jquery.flexslider-min.js') }}"></script>
    <!-- Owl carousel -->
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <!-- Magnific Popup -->
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/magnific-popup-options.js') }}"></script>
    <!-- Date Picker -->
    <script src="{{ asset('frontend/js/bootstrap-datepicker.js') }}"></script>
    <!-- Stellar Parallax -->
    <script src="{{ asset('frontend/js/jquery.stellar.min.js') }}"></script>
    <!-- Main -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/perfect-scrollbar.min.js') }}"></script>
    @stack('scripts')
</body>

</html>