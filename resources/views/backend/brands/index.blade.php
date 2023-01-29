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
                    <a class="btn btn-primary btn-sm float-end me-2" href="{{ url('adminpanel/brands/create') }}"
                       data-toggle="ajaxModal">
                        <i class="ti ti-plus mr-1"></i> Add New Brand
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive sm-2">
                        <table id="example" class="table table-striped table-bordered">
                            <thead class="table-light">
<tr>
                                <th class="text-center">Name</th>
                                <th class="text-center">Created at</th>
                                <th class="text-center">Actions</th>
</tr>
                            </thead>

                            <tbody>
                            @foreach($brands as $brand)
                                <td class="text-center">{{$brand->name}}
                                </td>
                                <td class="text-center">
                                    {{$brand->created_at}}
                                </td>

                                <td class="text-center">

                                    <a title="Modify" href="{{Request::url()}}/{{$brand->id}}/edit"
                                       class="btn btn-link" data-toggle="ajaxModal"><i
                                            class="fa fa-edit fa-xs"></i></a>
                                    <a href="#!" title="Delete" class="btn btn-link delete-category" id="{{$brand->id}}" data-name="{{ $brand->name}}" ><i
                                            class="fa fa-trash fa-xs"></i> </a>

                                </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>



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
            timer: 1400
        });

        @endif
        $(document).on('click', '.delete-category', function (e) {

            e.preventDefault();

            var name = $(this).data('name');
            var id = $(this).attr('id');

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
                            url: '{{url("adminpanel/brands/")}}/' + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (data) {
                                swal("{{__('Brand has been deleted')}}", {
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


