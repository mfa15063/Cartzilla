<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--plugins-->
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
    <!-- loader-->
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/pace.min.css')}}" rel="stylesheet" />
    <script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/app.css')}}" rel="stylesheet">
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/icons.css')}}" rel="stylesheet">

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/dark-theme.css')}}" />
    <link rel="stylesheet" href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/semi-dark.css')}}" />
    <link rel="stylesheet" href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/header-colors.css')}}" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <title>{{$page_title ?? 'FMS'}}</title>
    @yield('styles')
</head>

<body>
<!--wrapper-->
<div class="wrapper">
    <!--start header -->
@include("backend.layouts.header")
<!--end header -->
    <!--navigation-->
@include("backend.layouts.nav")
<!--end navigation-->
    <!--start page wrapper -->
@yield("wrapper")
<!--end page wrapper -->
    <!--start overlay-->
    <div class="overlay toggle-icon"></div>
    <!--end overlay-->
    <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->
    <footer class="page-footer">
        <p class="mb-0">Copyright © {{date('Y')}}.All right reserved by <a href="https://www.luqmansoftwares.com/" class="btn btn-link" target="_blank">Luqman Softwares</a></p>
    </footer>
</div>
<!--end wrapper-->
<!--start switcher-->
<div class="switcher-wrapper">
    <div class="switcher-btn"> <i class='bx bx-cog bx-spin'></i>
    </div>
    <div class="switcher-body">
        <div class="d-flex align-items-center">
            <h5 class="mb-0 text-uppercase">Theme Customizer</h5>
            <button type="button" class="btn-close ms-auto close-switcher" aria-label="Close"></button>
        </div>
        <hr/>
        <h6 class="mb-0">Theme Styles</h6>
        <hr/>
        <div class="d-flex align-items-center justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="lightmode" checked>
                <label class="form-check-label" for="lightmode">Light</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="darkmode">
                <label class="form-check-label" for="darkmode">Dark</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="flexRadioDefault" id="semidark">
                <label class="form-check-label" for="semidark">Semi Dark</label>
            </div>
        </div>
        <hr/>
        <div class="form-check">
            <input class="form-check-input" type="radio" id="minimaltheme" name="flexRadioDefault">
            <label class="form-check-label" for="minimaltheme">Minimal Theme</label>
        </div>
        <hr/>
        <h6 class="mb-0">Header Colors</h6>
        <hr/>
        <div class="header-colors-indigators">
            <div class="row row-cols-auto g-3">
                <div class="col">
                    <div class="indigator headercolor1" id="headercolor1"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor2" id="headercolor2"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor3" id="headercolor3"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor4" id="headercolor4"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor5" id="headercolor5"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor6" id="headercolor6"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor7" id="headercolor7"></div>
                </div>
                <div class="col">
                    <div class="indigator headercolor8" id="headercolor8"></div>
                </div>
            </div>
        </div>
        <hr/>
        <h6 class="mb-0">Sidebar Colors</h6>
        <hr/>
        <div class="header-colors-indigators">
            <div class="row row-cols-auto g-3">
                <div class="col">
                    <div class="indigator sidebarcolor1" id="sidebarcolor1"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor2" id="sidebarcolor2"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor3" id="sidebarcolor3"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor4" id="sidebarcolor4"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor5" id="sidebarcolor5"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor6" id="sidebarcolor6"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor7" id="sidebarcolor7"></div>
                </div>
                <div class="col">
                    <div class="indigator sidebarcolor8" id="sidebarcolor8"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end switcher-->
<div class="modal-quick-view modal fade" id="remoteModalContainer" tabindex="-1">
    <div class="modal-dialog modal-xl">

    </div>
</div>
<!-- Bootstrap JS -->
<script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/js/jquery.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="https://kit.fontawesome.com/7319dab320.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<!--app JS-->
<script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/js/app.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {

        // Load remote modal
        $(document).on('click', '[data-toggle="ajaxModal"]',
            function (e) {
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
