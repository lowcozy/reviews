<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" prefix="og: http://ogp.me/ns#">
   
    <meta property="og:description" content="South Jersey Aerial Photography is South Jersey's premier aerial photography and aerial videography company. Fully licensed and insured. Contact us today!"/>
    <meta property="og:image" content="https://media-cdn.tripadvisor.com/media/photo-s/08/20/75/0d/hotel-contessa.jpg" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

     <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Bootstrap  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('stylesheets/bootstrap.css') }}" >

    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('stylesheets/style.css') }}">

    <!-- Responsive -->
    <link rel="stylesheet" type="text/css" href="{{ asset('stylesheets/responsive.css') }}">

    <!-- REVOLUTION LAYERS STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/layers.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('revolution/css/settings.css') }}">
    
    <!-- Animation Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('stylesheets/animate.css') }}">

    <!-- Favicon and touch icons  -->
    <link href="{{ asset('icon/apple-touch-icon-48-precomposed.png') }}" rel="apple-touch-icon-precomposed" sizes="48x48">
    <link href="{{ asset('icon/apple-touch-icon-32-precomposed.png') }}" rel="apple-touch-icon-precomposed">
    <link href="{{ asset('icon/favicon.png') }}" rel="shortcut icon">


    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js') }}">
    </script>
    <script src="{{ asset('js/jquery.matchHeight.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.star-rating-svg.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/star-rating-svg.css') }}">

    <style>
        #profile-grid { overflow: auto; white-space: normal; }
        #profile-grid .profile { padding-bottom: 40px; }
        #profile-grid .panel { padding: 0 }
        #profile-grid .panel-body { padding: 15px }
        #profile-grid .profile-name { font-weight: bold; }
        #profile-grid .thumbnail {margin-bottom:6px;}
        #profile-grid .panel-thumbnail { overflow: hidden; }
        #profile-grid .img-rounded { border-radius: 4px 4px 0 0;}
    </style>
</head>
<body class="header_sticky">

     <!-- Preloader -->
    <section class="loading-overlay">
        <div class="Loading-Page">
            <h2 class="loader">Loading</h2>
        </div>
    </section> 

    <!-- Boxed -->
    <div class="boxed">
        
   <!-- Header -->  
    @include('Front_end.includes.header')

    @yield('header_title')
    <!-- Section -->
    @yield('content')
   


    <!-- Footer -->
    @include('Front_end.includes.footer')

    <!-- Modal Popup Login Register -->
    @include('Front_end.includes.modal')
    <!-- End Modal Login Register -->

    <!-- Go Top -->
    <a class="go-top">
        <i class="fa fa-angle-up"></a>
    </a>
    @yield('js')
    
    @yield('modal')
    </div>

    @yield('js_lib')
   

</body>
</html>
