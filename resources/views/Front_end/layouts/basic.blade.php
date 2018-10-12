<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml"
>
    <meta property="og:title" content="The Rock"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="http://www.imdb.com/title/tt0117500/"/>
    <meta property="og:image" content="http://ia.media-imdb.com/rock.jpg"/>
    <meta property="og:site_name" content="IMDb"/>
    <meta property="fb:admins" content="USER_ID"/>
    <meta property="og:description"
    content="A group of U.S. Marines, under command of
               a renegade general, take over Alcatraz and
               threaten San Francisco Bay with biological
               weapons."/>

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
