
<main class="page-wrapper">
    <!-- Quick View Modal-->

    <!-- Navbar Electronics Store-->
    <header class="shadow-sm">
        <!-- Topbar-->

        <!-- Remove "navbar-sticky" class to make navigation bar scrollable with the page.-->
        <div class="navbar-sticky bg-light">
            <div class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <a class="navbar-brand d-none d-sm-block me-3 flex-shrink-0" href="{{ route('front.index') }}">
                        <img src="{{asset(env('PUBLIC_PATH' , '').'img/logo-dark.png')}}" width="142" alt="Cartzilla">
                    </a>
                    <a class="navbar-brand d-sm-none me-2" href="{{ route('front.index') }}">
                        <img src="{{asset(env('PUBLIC_PATH' , '').'img/logo-icon.png') }}" width="74" alt="{{ env('APP_NAME') }}">
                    </a>
                    <!-- Search-->
                    <div class="input-group d-none d-lg-flex flex-nowrap mx-4 logo-header search-box search-form"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                        <input class="form-control rounded-start w-100" data-route="{{route('front.products.search')}}" id="search_products" type="text" placeholder="Search for products">
                            <div id="myInputautocomplete-list" class="myInputautocomplete-list autocomplete-items">

                            </div>
                        <select class="form-select flex-shrink-0" id="header-cats" style="width: 10.5rem;">
                            <option value="0">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Toolbar-->
                    <div class="navbar-toolbar d-flex flex-shrink-0 align-items-center">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"><span class="navbar-toggler-icon"></span></button>
                        <a class="navbar-tool navbar-stuck-toggler" href="#"><span class="navbar-tool-tooltip">Toggle menu</span>
                            <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-menu"></i></div></a>

                        <div class="navbar-tool dropdown ms-3" >
                            <a class="navbar-tool-icon-box bg-secondary dropdown-toggle" id="cart"  href="{{route('front.cart')}}">
                                <span class="navbar-tool-label" id="cart-count">
                                    @php
                                        $cart = Session::has('cart')?Session::get('cart'): [];

                                    @endphp
                                    {{sizeof($cart)}}
                                </span><i class="navbar-tool-icon ci-cart"></i></a>
                            <span class="help-block">
                                Cart
                            </span>
                        </div>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown active">  <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="#">
                                    @if (!Auth::check())
                                        <a class="navbar-tool ms-1 ms-lg-0 me-n1 me-lg-2" href="{{ route('login') }}">
                                            <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
                                            <div class="navbar-tool-text ms-n3"><small>Hello, Sign in</small>My Account</div></a>
                                    @else
                                        <div class="navbar-tool-icon-box"><i class="navbar-tool-icon ci-user"></i></div>
                                    <div class="navbar-tool-text ms-n3"><small>Welcome, {{Auth::user()->first_name}}</small>My Account</div>

                                <ul class="dropdown-menu">
                                    <li class="dropdown position-static mb-0"><a class="dropdown-item py-2 border-bottom" href="{{route('user.profile')}}"><span class="d-block text-heading">{{__('Your Account')}}</span></a>

                                    </li>
                                    <li class="dropdown position-static mb-0"><a class="dropdown-item py-2 border-bottom" href="javascript:;" onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();" ><span class="d-block text-heading">{{__('Sign out')}}</span></a>
                                    </li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </ul>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="navbar navbar-expand-lg navbar-light navbar-stuck-menu mt-n2 pt-0 pb-2">
                <div class="container">
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <!-- Search-->
                        <div class="input-group d-lg-none my-3"><i class="ci-search position-absolute top-50 start-0 translate-middle-y ms-3"></i>
                            <input class="form-control rounded-start" type="text" placeholder="Search for products">
                        </div>
                        <!-- Departments menu-->
                        <ul class="navbar-nav navbar-mega-nav pe-lg-2 me-lg-2">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle ps-lg-0" href="#" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <i class="ci-menu align-middle mt-n1 me-2"></i>
                                Brands
                            </a>
                                <ul class="dropdown-menu">
                                    @foreach ($brands as $item)
                                    <li class="dropdown mega-dropdown">
                                        <a class="dropdown-item dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                            <i class="ci-laptop opacity-60 fs-lg mt-n1 me-2"></i>
                                            {{$item->name}}
                                        </a>
                                        @if ($item->products != null)

                                        <div class="dropdown-menu p-0">

                                            <div class="d-flex flex-wrap flex-sm-nowrap px-2">

                                                <div class="mega-dropdown-column pt-4 pb-0 py-sm-4 px-3">
                                                    <div class="widget widget-links">
                                                        <h6 class="fs-base mb-3">Products</h6>
                                                        <ul class="widget-list">
                                                            @foreach ($item->products as $pitem)
                                                            <li class="widget-list-item pb-1">
                                                                <a class="widget-list-link" href="{{route('front.product' , $pitem->slug)}}">{{$pitem->name}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <!-- Primary menu-->
                        <ul class="navbar-nav">
                            <li class="nav-item {{Route::is('front.index') ? 'active' : ''}}">
                                <a class="nav-link" href="{{route('front.index')}}">Home</a>
                            </li>
                            <li class="nav-item {{Route::is('front.products') ? 'active' : ''}}">
                                <a class="nav-link" href="{{route('front.products')}}">Shop</a>

                            </li>
                            <li class="nav-item {{Route::is('user.orders') || Route::is('user.profile') || Route::is('user.wishlist') ? 'active' : ''}}">
                                <a class="nav-link" href="{{route('user.profile')}}">Dashboard</a>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Hero (Banners + Slider)-->
    @if (Route::is('front.index'))
        <x-slider></x-slider>
    @endif
</main>
