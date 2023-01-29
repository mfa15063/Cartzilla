@extends("backend.layouts.app")

@section("styles")
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/basic.min.css')}}" rel="stylesheet">
    <style>
        .dz-message{
            margin: 20px 0px;
        }
    </style>
<style>
    .dz-message{
        margin: 20px 0px;
    }
</style>
@stop

@section("wrapper")
<!-- Content -->
<div class="page-wrapper">
    <div class="page-content">

        <div class="card">
            <div class="card-title m-5">
            <h3 class="box-title">Images for {{$product->name}}  </h3>
            <h4>
                <a href="./images" class="btn btn-primary btn-sm pull-right" title="Refresh page">Refresh</a>
                <br>
            </h4>
        </div>
<div class="card-body">
        <form action="{{url('adminpanel/products/' . Request::segment('3') . '/images')}}" class="dropzone" id="image-upload-dropzone" method="POST">
            <div class="dz-message needsclick panel panel-default text-center "  style="min-height:300px;margin-top: 0px;margin-bottom: 0px;">
                <strong>  Drop files here or click to upload
                </strong>
            </div>
            <input type="hidden" id="image-uploadify"  name="product_id" value="{{$product->id}}">

            {!! csrf_field() !!}
        </form>
</div>
        </div>
        <div class="clearfix"><br></div>

        @if (sizeof($images))

            <div class="container">
                <div class="row">
                    @foreach($images as $image)
                    <div class="col-4 mt-4">
                        @php
                            $url = asset(env('DYNAMIC_PATH' , '').'products/dropzone/'. $image->image_url)
                        @endphp

                            <a href="{{$url}}" data-featherlight="image">
                                <img src="{{$url}}" alt="" width="220" height="220"></a>
                            <div>

                                <a href="{{$url}}" target="_blank">{{basename($image->image_url)}}</a><br>
                                {{date('d M Y H:i:s', strtotime($image->created_at))}}<br>

                                <a href="#!" title="Delete" class="btn btn-link delete-image" id="{{$image->id}}" ><button
                                        class="btn btn-sm btn-danger">Delete</button> </a>
                    </div>
                    </div>

                    @endforeach

            </div>


            </div>

        @else
        Records not found.
        @endif

        <div class="clearfix"></div>
    </div>
</div>
@stop

@section("scripts")
    <script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/js/dropzone.js')}}" defer></script>
    <script>
        @if(session('success'))
        swal({
            title: "Success !",
            text: "{{session('success')}}",
            icon: "success",
            timer: 2000
        });

        @endif
        $(document).on('click', '.delete-image', function (e) {

            e.preventDefault();

            var id = $(this).attr('id');

            swal({
                title: "{{__('Are you sure?')}}",
                text: "{{__('Are you sure that you want to delete the image')}} "  ,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: 'DELETE',

                            url: '{{url("adminpanel/products/" . Request::segment('3') . '/images/' )}}/' + id,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function (data) {
                                swal("{{__('Image Has been deleted')}}", {
                                    icon: "success",
                                    timer: 2000
                                });
                                location.reload();

                            }

                        });

                    }
                });


        });

    </script>
@stop
