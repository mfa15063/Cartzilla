@extends("backend.layouts.app")
@section("styles")

@endsection
@section("wrapper")
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            @include('backend.layouts.breadcrumbs')
            <h6 class="mb-0 text-uppercase">{{$page_heading ?? ''}}</h6>
            <hr/>
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive sm-2">
                        @if(sizeOf($orders))
                        <table id="example" class="table table-striped table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th class="text-center">Order By</th>
                                <th class="text-center">Total Bill</th>
                                <th class="text-center">Total Quantity</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <td class="text-center">{{ $order->user->first_name , $order->user->last_name}}
                                </td>

                                <td class="text-center">
                                    {{ $order->amount}}

                                </td>
                                <td class="text-center">
                                    {{$order->quantity}}
                                </td>
                                <td class="text-center">

                                    <select id="{{$order->id}}" onchange="changeStatus({{$order->id}})" name="status" class="form-select">
                                        <?php $status= old('status', @$order->status); ?>
                                        <option value="pending" @if(($order->status=='pending')) selected="selected" @endif>Pending</option>
                                        <option value="approved" @if(($order->status=='approved')) selected="selected" @endif>Approved</option>
                                        <option value="cancelled" @if($order->status=='cancelled') selected="selected" @endif>Cancelled</option>
                                        <option value="dispatched" @if($order->status=='dispatched') selected="selected" @endif>Dispatched</option>
                                        <option value="delivered" @if($order->status=='delivered') selected="selected" @endif>Delivered</option>
                                    </select>

                                </td>

                                <td class="text-center">
                                    <a title="View Invoice" target="_blank" href="{{ route('order.invoice' , $order->id) }}"
                                       class="btn btn-xs btn-success">Invoice<i class="fa fa-invoice"></i></a>

                                    <a title="Modify" href="{{Request::url()}}/{{$order->id}}"
                                       class="btn btn-xs btn-info">Detail<i class="fa fa-details"></i></a>
                                    @if(!($order->status=="dispatched" || $order->status=="delivered"))

                                        <a href="#!" title="Delete" class="btn btn-link delete-user" id="{{$order->id}}"  ><i
                                                class="fa fa-trash fa-xs"></i> </a>
                                    @endif
                                </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        @else
                            <div class="alert alert-danger">
                                Sorry, No record found !
                            </div>
                        @endif

                        {{ $orders->appends(Request::query())->render() }}


                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--end page wrapper -->
@endsection

@section("scripts")
    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        @if(session('success'))
        swal({
            title: "Success !",
            text: "{{session('success')}}",
            icon: "success",
            timer: 2000
        });

        @endif
        $(document).on('click', '.delete-user', function (e) {

            e.preventDefault();

            var id = $(this).attr('id');

            swal({
                title: "{{__('Are you sure?')}}",
                text: "{{__('Are you sure that you want to delete this order')}}" ,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'DELETE',
                            url: '{{url("adminpanel/orders/")}}/' + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (data) {
                                if (data.status == 1) {
                                    swal("{{__('order Has been deleted')}}", {
                                        icon: "success",
                                        timer: 2000
                                    });
                                    $('#' + id).closest("tr").remove();
                                }
                             else{
                                    swal("{{__('Order cannot be deleted') }}",  {
                                        icon: "error",
                                        timer: 2500
                                    });
                                }

                            }

                        });

                    }
                });


        });
        function changeStatus(id){
            var status= $('#'+id).children("option:selected").val();

            swal({
                title: "{{__('Are you sure?')}}",
                text: "{{__('Are you sure that you want to change the order status to ')}} " +status ,
                icon: "warning",
                buttons: ["No", "Yes"],
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $('.form-control').prop('disabled', true);

                        const url2 = '{{ url('adminpanel/changeOrderStatus') }}';

                        $.ajax({
                            url: url2,
                            type: "POST",
                            data:"id=" + id +"&status=" + status + "&_token={{ csrf_token() }}",
                            cache: false,
                            success: function (data) {
                                if (data.status == 1) {

                                    $('.form-control').prop('disabled', false);
                                    swal("{{__('Order status has been changed to ') }}" + status, {
                                        icon: "success",
                                        timer: 3000
                                    });
                                }
                                else if (data.status == 403) {

                                    $('.form-control').prop('disabled', false);
                                    swal("{{__('Order status cannot be changed to ') }}" + status, {
                                        icon: "error",
                                        timer: 2500
                                    });
                                    setTimeout(function() {
                                        location.reload();
                                    }, 3000);

                                }
                                else if (data.status == 400) {

                                    $('.form-control').prop('disabled', false);
                                    alert(data.orderstatus);

                                }
                                else {

                                    swal("{{__('Something went wrong ') }}", {
                                        icon: "error",
                                        timer: 3000
                                    });
                                }
                            }
                        });
                    }
                })
        }
    </script>

@endsection


