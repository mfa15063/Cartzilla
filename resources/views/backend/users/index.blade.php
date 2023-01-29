@extends("backend.layouts.app")
@section("styles")
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet"/>
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
                    <a class="btn btn-primary btn-sm float-end me-2" href="{{ url('adminpanel/users/create') }}"
                       data-toggle="ajaxModal">
                        <i class="ti ti-plus mr-1"></i> Add New User
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive sm-2">
                        <table id="example" class="table table-striped table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th>Full Name</th>
                                <th>Mobile #</th>
                                <th>Email</th>
                                <th>Price Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->first_name}} {{$user->last_name}}</td>
                                    <td>{{$user->mobile_number}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-center">

                                        <select id="{{$user->id}}" onchange="changeCategory({{$user->id}})"
                                                name="category" data-name="{{ $user->first_name}}" class="form-select">
                                            <?php $category = old('category', @$user->price_category); ?>
                                            <option value="standard"
                                                    @if(($user->price_category=='standard')) selected="selected" @endif>
                                                Normal
                                            </option>
                                            <option value="premium"
                                                    @if(($user->price_category=='premium')) selected="selected" @endif>
                                                Premium
                                            </option>
                                            <option value="gold"
                                                    @if($user->price_category=='gold') selected="selected" @endif>Gold
                                            </option>
                                        </select>

                                    </td>
                                    <td>{{$user->status=="1" ? 'Active' :'Inactive'}}</td>

                                    <td class="text-center">
                                        @if($user->is_admin)
                                            <span class="btn btn-xs btn-success">Admin</span>

                                        @else

                                            <a title="Modify" href="{{Request::url()}}/{{$user->id}}/edit"
                                               class="btn btn-link" data-toggle="ajaxModal"><i
                                                    class="fa fa-edit fa-xs"></i></a>
                                            <a href="#!" title="Delete" class="btn btn-link delete-user" id="{{$user->id}}" data-name="{{ $user->first_name}}" ><i
                                                    class="fa fa-trash fa-xs"></i> </a>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>

                        {{ $users->links() }}

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
                            url: '{{url("adminpanel/users/")}}/' + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (data) {
                                swal("{{__('User Has been deleted')}}", {
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
<script>
    function changeCategory(id){
        var name = $('#'+id).data('name');
        swal({
            title: "{{__('Are you sure?')}}",
            text: "{{__('Are you sure that you want to Update price Category for')}} :" + name ,
            icon: "warning",
            buttons: ["Cancel", "Yes"],
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $('.form-control').prop('disabled', true);
                    var category = $('#' + id).children("option:selected").val();
                    const url2 = '{{ url('adminpanel/changePriceCategory') }}';

                    $.ajax({
                        url: url2,
                        type: "POST",
                        data: "id=" + id + "&price_category=" + category + "&_token={{ csrf_token() }}",
                        cache: false,
                        success: function (data) {
                            if (data.status == 1) {

                                $('.form-control').prop('disabled', false);
                                swal("{{__('User price category has been changed')}}", {
                                    icon: "success",
                                    timer: 2000
                                });
                            } else {
                                swal("{{__('User price category has been changed')}}", {
                                    icon: "error",
                                    timer: 2000
                                });
                            }
                        }
                    });
                }
            })
    }
</script>
@endsection


