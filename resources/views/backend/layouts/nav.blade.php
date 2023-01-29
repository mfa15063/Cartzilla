<!--sidebar wrapper -->
<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Luqman Softwares</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li class="nav-item">

            <a href="{{url('/adminpanel')}}" class="nav-link {{empty(Request::query()) ?? 'active' }} ">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">{{__('Dashboard')}}</div>
            </a>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">{{__('Manage Users')}}</div>
            </a>

            <ul>
                <li> <a href="{{ url('adminpanel/users') }}"><i class="bx bx-right-arrow-alt @if(str_contains(Request::fullurl(),'users')) 'active' @endif}} "></i>{{__('View Users')}}</a>
                </li>

            </ul>
        </li>
        <hr>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">{{__('Manage Categories')}}</div>
            </a>

            <ul>
                <li> <a href="{{ url('adminpanel/categories') }}"><i class="bx bx-right-arrow-alt @if(str_contains(Request::fullurl(),'categories')) 'active' @endif}} "></i>{{__('View Categories')}}</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-badge"></i>
                </div>
                <div class="menu-title">{{__('Manage Brands')}}</div>
            </a>

            <ul>
                <li> <a href="{{ url('adminpanel/brands') }}"><i class="bx bx-right-arrow-alt @if(str_contains(Request::fullurl(),'brands')) 'active' @endif}} "></i>{{__('View Brands')}}</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bxl-product-hunt"></i>
                </div>
                <div class="menu-title">{{__('Manage Products')}}</div>
            </a>

            <ul>
                <li> <a href="{{ url('adminpanel/products') }}"><i class="bx bx-right-arrow-alt @if(str_contains(Request::fullurl(),'products')) 'active' @endif}} "></i>{{__('View Products')}}</a>
                </li>
                <li> <a href="{{ url('adminpanel/products/create') }}"><i class="bx bx-right-arrow-alt @if(str_contains(Request::fullurl(),'products/create')) 'active' @endif}} "></i>{{__('Add Product')}}</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bxl-android"></i>
                </div>
                <div class="menu-title">{{__('Manage Offers')}}</div>
            </a>

            <ul>
                <li> <a href="{{ url('adminpanel/offers') }}"><i class="bx bx-right-arrow-alt @if(str_contains(Request::fullurl(),'offers')) 'active' @endif}} "></i>{{__('View Offers')}}</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bxl-shopify"></i>
                </div>
                <div class="menu-title">{{__('Manage Orders')}}</div>
            </a>

            <ul>
                <li> <a href="{{ url('adminpanel/orders') }}"><i class="bx bx-right-arrow-alt @if(str_contains(Request::fullurl(),'orders')) 'active' @endif}} "></i>{{__('View Orders')}}</a>
                </li>

            </ul>
        </li>


        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-cloud-light-rain"></i>
                </div>
                <div class="menu-title">{{__('Website Settings')}}</div>
            </a>

            <ul>
                <li> <a href="{{ url('adminpanel/settings') }}"><i class="bx bx-right-arrow-alt @if(str_contains(Request::fullurl(),'settings')) 'active' @endif}} "></i>{{__('View Settings')}}</a>
                </li>

            </ul>
        </li>



    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
