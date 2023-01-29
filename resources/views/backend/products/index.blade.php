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
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="table-responsive sm-2">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <th class="text-center">Name</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">SP</th>
                            <th class="text-center">PP</th>
                            <th class="text-center">GP</th>
                            <th class="text-center">In Stock</th>
                            <th class="text-center">Actions</th>
                            </thead>
                            @foreach($products as $product)
                                <td class="text-center"><a href="{{url('products/'.$product->id)}}"
                                                           title="View Product details">
                                        {{ $product->name }}
                                    </a>             </td>

                                <td class="text-center">
                                    {{ !empty($product->brand->name) ? $product->brand->name : 'N/A'  }}
                                </td>
                                <td>
                                    {{$product->standard}}
                                </td>
                                <td>
                                   {{$product->premium ?? ''}}
                                </td>
                                <td>
                                    {{$product->gold ?? ''}}
                                </td>
                                <td class="text-center">
                                    @if($product->in_stock == 0)
                                        <span class="btn btn-xs btn-danger">Out of Stock</span>
                                    @else
                                        <span class="btn btn-xs btn-success ">In Stock</span>
                                    @endif
                                </td>
                                <td class="text-center">

                                    <a title="View or add item pics" href="{{Request::url()}}/{{$product->id}}/images"
                                       class="btn btn-xs btn-info"><i class="fa fa-picture-o fa-1x"></i>
                                    </a>


                                    <a title="Edit Product" href="{{Request::url()}}/{{$product->id}}/edit"
                                       class="btn btn-xs btn-info"><i class="fa fa-edit"></i></a>

                                    <a href="#!" title="Delete" class="btn btn-link delete-product" id="{{$product->id}}" data-name="{{ $product->name}}" ><i
                                            class="fa fa-trash fa-xs"></i> </a>

                                </td>
                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                        {{ $products->links() }}

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--end page wrapper -->
@endsection

@section("scripts")
<script>
    @if(session('success'))
    swal({
        title: "Success !",
        text: "{{session('success')}}",
        icon: "success",
        timer: 2000
    });

    @endif
    $(document).on('click', '.delete-product', function (e) {

        e.preventDefault();

        var name = $(this).data('name');
        var id = $(this).attr('id');
        console.log(id);
        swal({
            title: "{{__('Are you sure?')}}",
            text: "{{__('Are you sure that you want to delete')}} :" + name ,
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: 'DELETE',
                        url: '{{url("adminpanel/products/")}}/' + id,
                        data: {
                            "_token": "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            swal("{{__('Product Has been deleted')}}", {
                                icon: "success",
                                timer: 2000
                            });
                            $('#' + id).closest("tr").remove();

                        }

                    });

                }
            });


    });
</script>
@endsection


