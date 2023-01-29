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
    <link rel="stylesheet" href="{{asset(env('PUBLIC_PATH' , '').'backend/css/summernote-bs4.min.css')}}" />
    <title>{{$page_title ?? 'FMS'}}</title>
    @yield('styles')
    <style>
        #printdiv{
            margin-left:0px;
        }
    </style>
<body>
    <!--wrapper-->
    <div class="wrapper">
    <!--start page wrapper -->
        <div class="page-wrapper" id="printdiv">
            <div class="page-content">
                <!--breadcrumb-->
                @include('backend.layouts.breadcrumbs')
                <h6 class="mb-0 text-uppercase">{{$page_heading ?? ''}}</h6>
                <hr/>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Shipping Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive sm-2">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name:</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">City</th>
                                        <th class="text-center">Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{$order->checkout_fname}} {{$order->checkout_lname}}</td>
                                        <td class="text-center">{{$order->checkout_email}}</td>
                                        <td class="text-center">{{$order->checkout_phone}}</td>
                                        <td class="text-center">{{$order->city->name}}</td>
                                        <td class="text-center">{{$order->checkout_address}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Order Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive sm-2">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td class="text-center"><strong>Order ID</strong></td>
                                    <td class="text-center">{{$order->id}}</td>
                                    <td class="text-center"><strong>Placed On</strong></td>
                                    <td class="text-center" >{{$order->created_at}}</td>

                                </tr>
                                <tr>
                                    <th class="text-center">Product</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Total</th>
                                </tr>
                                @foreach($order->items as $detail)
                                    <tr>
                                        <td class="text-center">{{$detail->product->name}}</td>
                                        <td class="text-center">{{$detail->product_price}}</td>
                                        <td class="text-center">{{$detail->quantity}}</td>

                                        <td class="text-center">{{$detail->quantity * $detail->product_price}}</td>
                                    </tr>

                                @endforeach

                                <tr class="info">
                                    <td class="text-center"><strong>Total Qty</strong></td>
                                    <td class="text-center">{{$order->quantity}}</td>
                                    <td class="text-center"><strong>Total Bill</strong></td>
                                    <td class="text-center">{{$order->amount}}</td>
                                </tr>

                                <tr>
                                    <th class="text-center">
                                        Client  Instructions
                                    </th>
                                    <th class="text-center" colspan="3">
                                        {{$order->notes}}
                                    </th>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<!-- Bootstrap JS -->
<script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/js/jquery.min.js')}}"></script>
<script src="{{asset(env('PUBLIC_PATH' , '').'backend/js/summernote-bs4.min.js')}}"></script>
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
        window.print();
    });
</script>

</body>

</html>
