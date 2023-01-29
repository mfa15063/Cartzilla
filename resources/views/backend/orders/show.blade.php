@extends("backend.layouts.app")
@section("styles")

@endsection
@section("wrapper")
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
        <button onclick="printDiv()">Print</button>
    </div>
    


    <!--end page wrapper -->
@endsection



@section('scripts')
    <script>
    function printDiv() {
        window.print();
    }
    </script>
@endsection