<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- SEO Meta Tags-->
    <meta name="description" content="OnlineShop - Buy everything online with jus few clicks">
    <meta name="keywords"
        content="E-commerce,Online SHop in South Africa, buy online in south africa, buy online in cape town, online shop in capetown">
    <meta name="author" content="Luqman Aoftwares">
    <!-- Viewport-->

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="stylesheet" href="{{ asset(env('PUBLIC_PATH' , '').'backend/assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset(env('PUBLIC_PATH' , '').'backend/assets/css/semi-dark.css') }}" />
    <!--plugins-->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset(env('PUBLIC_PATH' , '').'apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset(env('PUBLIC_PATH' , '').'favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset(env('PUBLIC_PATH' , '').'favicon-16x16.png') }}">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" color="#fe6a6a" href="safari-pinned-tab.svg">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Vendor Styles including: Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{ asset(env('PUBLIC_PATH' , '').'vendor/simplebar/dist/simplebar.min.css') }}" />
    <link rel="stylesheet" media="screen" href="{{ asset(env('PUBLIC_PATH' , '').'vendor/tiny-slider/dist/tiny-slider.css') }}" />
    <link rel="stylesheet" media="screen" href="{{ asset(env('PUBLIC_PATH' , '').'vendor/drift-zoom/dist/drift-basic.min.css') }}" />
    <link rel="stylesheet" media="screen"
        href="{{ asset(env('PUBLIC_PATH' , '').'vendor/lightgallery.js/dist/css/lightgallery.min.css') }}" />
    <!-- Main Theme Styles + Bootstrap-->
    <link rel="stylesheet" media="screen" href="{{ asset(env('PUBLIC_PATH' , '').'css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset(env('PUBLIC_PATH' , '').'vendor/css/toastr.min.css') }}" />

    <link rel="stylesheet" media="screen" href="{{ asset(env('PUBLIC_PATH' , '').'vendor/nouislider/dist/nouislider.min.css') }}"/>
    <title>{{ $page_title ?? 'FMS' }}</title>
    <style>
        .invalid{
            border:1px solid red;
        }
        .star-rating {
            position: relative;
            vertical-align: middle;
            display: inline-block;
            color: #b1b1b1;
            overflow: hidden;
        }

        .empty-stars:before,
        .full-stars:before {
            content: "\2605\2605\2605\2605\2605";
            font-size: 14px;
        }

        .empty-stars:before {
            -webkit-text-stroke: 1px #ddd;
            color: #ddd;
        }

        .full-stars {
            color: #ff5500;
        }

        .full-stars {
            position: absolute;
            left: 0;
            top: 0;
            white-space: nowrap;
            overflow: hidden;
            color: #ff5500;
        }

        .autocomplete {
            position: relative;
            display: block;
        }

        .autocomplete-items {
            position: absolute;
            border-top: none;
            z-index: 99;
            top: 100%;
            left: 0px;
            right: 0;
        }

        .autocomplete-items div {
            background-color: white;
            color: black;
        }

        .autocomplete-items div {
            padding: 5px;
            cursor: pointer;
            width: 95%;
            color: #fff;
            font-size: 15px;
            text-align: left;
        }

        .docname {
            width: 100% !important;
            border-bottom: 1px solid rgba(84, 82, 82, 0.09) !important;
        }

        .docname a {
            display: flex;
        }

        .docname a {
            color: #333;
        }

        .docname a img {
            width: 50px;
            height: 50px;
        }

        .docname a .search-content {
            flex: 1;
        }

        .docname a .search-content p {
            margin-bottom: 0px;
            font-size: 14px;
        }

        .logo-header .search-box .search-form {
            padding-left: 160px;
            position: relative;
        }

    </style>
    @yield('styles')
</head>

<!-- Body-->

<body class="handheld-toolbar-enabled">

    <!--start header -->
    @include("layouts.header")
    @yield('content')

    @include("layouts.footer")
    <!-- Toolbar for handheld devices (Default)-->
    <div class="handheld-toolbar">
        <div class="d-table table-layout-fixed w-100">
            <a class="d-table-cell handheld-toolbar-item" href="{{route('user.wishlist')}}">
                <span class="handheld-toolbar-icon"><i class="ci-heart"></i>
                </span>
                <span class="handheld-toolbar-label">Wishlist</span>
            </a>
            <a class="d-table-cell handheld-toolbar-item" href="javascript:void(0)" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse" onclick="window.scrollTo(0, 0)">
                <span class="handheld-toolbar-icon">
                    <i class="ci-menu"></i>
                </span>
                <span class="handheld-toolbar-label">Menu</span>
            </a>
            <a class="d-table-cell handheld-toolbar-item" href="{{route('front.products')}}">
                <span class="handheld-toolbar-icon">
                    <i class="ci-cart"></i>
                    <span class="badge bg-primary rounded-pill ms-1">4</span></span>
                <span
                    class="handheld-toolbar-label">$265.00</span>
            </a>
        </div>
    </div>

    <!-- Quick View Modal-->
    <div id="remoteModalContainer" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="exampleModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset(env('PUBLIC_PATH' , '').'vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset(env('PUBLIC_PATH' , '').'vendor/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset(env('PUBLIC_PATH' , '').'vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
    <script src="{{ asset(env('PUBLIC_PATH' , '').'vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js') }}"></script>
    <script src="{{ asset(env('PUBLIC_PATH' , '').'vendor/drift-zoom/dist/Drift.min.js') }}"></script>
    <script src="{{ asset(env('PUBLIC_PATH' , '').'vendor/lightgallery.js/dist/js/lightgallery.min.js') }}"></script>
    <script src="{{ asset(env('PUBLIC_PATH' , '').'vendor/lg-video.js/dist/lg-video.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Main theme script-->
    <script src="{{ asset(env('PUBLIC_PATH' , '').'vendor/nouislider/dist/nouislider.min.js') }}"></script>
    <script src="{{ asset(env('PUBLIC_PATH' , '').'js/theme.js?time=' . time()) }}"></script>
    <script src="{{ asset(env('PUBLIC_PATH' , '').'vendor/js/toastr.min.js') }}"></script>
    <script src="{{ asset(env('PUBLIC_PATH' , '').'vendor/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {

            // Load remote modal
            $(document).on('click', '[data-toggle="ajaxModal"]',
                function(e) {
                    e.preventDefault();
                    $('#remoteModalContainer').modal('show').find('.modal-dialog').load($(this).attr('href'));
                });
        });
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    </script>

    @yield("scripts")
</body>

</html>
