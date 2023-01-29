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

                <div class="card-body">

                        <x-form method="{{empty($product) ? 'post' : 'put'}}"
                                action="{{empty($product) ? url('adminpanel/products') : url('/adminpanel/products/'.$product->id) }}"
                                class="bootstrap-modal-form" enctype="multipart/form-data">
                            <div class="row">
                    <div class="col-3">
                        <img id="img" src="{{empty($product->product_image) ? asset(env('PUBLIC_PATH' , '').'images/icon_male.jpg'):asset(env('DYNAMIC_PATH' , '').'products/'.$product->product_image)}}"
                             class="img-rounded" alt="" width="200">
                        <div class="mb-3">
                            <label for="image_selector" class="form-label">Select Product Picture</label>
                            <input class="form-control form-control-sm" id="image_selector" name="product_image" type="file">
                            @if ($errors->has('product_image'))
                                <span class="help-block text-left">
                                <strong>{{ $errors->first('product_image') }}
                                <hr>
                                Required Dimensions (min width=500, min height=512,max width:600, max height:750)</strong>
                            </span>
                                @endif
                        </div>
                    </div>
                        <div class="col">

                        <x-form-select name="category_id" id="cat" label="Select Category">
                            @foreach($categories as $cat)
                                <?php
                                $selected = old('category_id', @$product->category_id) == $cat->id ? 'selected="selected"' : '';
                                ?>
                            <option value="{{$cat->id}}" {{$selected}}>{{$cat->name}}</option>
                            @endforeach
                        </x-form-select>
                            <x-form-select name="brand_id" id="brand" label="Select Brand">
                                @foreach($brands as $brand)
                                    <?php
                                    $selected = old('brand_id', @$product->brand_id) == $brand->id ? 'selected="selected"' : '';
                                    ?>

                                    <option value="{{$brand->id}}" {{$selected}}>{{$brand->name}}</option>

                                @endforeach
                            </x-form-select>


                            @bind(@$product)
                        <x-form-input-group>
                            <x-form-input name="name"  label="Product Name" floating required />
                            <x-form-input name="weight"  label="Weight" floating  />
                        </x-form-input-group>
                        <x-form-input-group>

                            <x-form-input type="text" name="measuring_unit"  label="Unit(KG,Litre,mg,g)" floating  />
                            <x-form-input type="text" name="standard"  label="Standard Price" floating required  />

                        </x-form-input-group>


                        <x-form-input-group>
                            <x-form-input type="text" name="premium"   label="Premium Price"  floating  required />
                            <x-form-input type="text" name="gold"   label="Gold Price"  floating required />

                        </x-form-input-group>
                            <x-form-textarea name="description" label="Write Product description" />
                            <textarea id='description' name="description">{!!  @$product->description !!}</textarea>

                            @endbind
                        <x-form-input-group>
                        <div class="form-check form-switch">
                            <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                            <input name="status" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if(@$product->status==1) checked @endif>
                        </div>
                            <div class="form-check form-switch ms-4">
                                <label class="form-check-label" for="flexSwitchCheckChecked">In Stock</label>
                                <input name="in_stock" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if(@$product->in_stock==1) checked @endif>
                            </div>
                        </x-form-input-group>
                        <x-form-input-group>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="flexSwitchCheckChecked">Featured</label>
                                <input name="is_featured" class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" @if(@$product->is_featured==1) checked @endif>
                            </div>

                        </x-form-input-group>
                        <x-form-input-group>
                            <div class="form-check form-switch">
                                <label class="form-check-label" for="colorcheck">Color</label>
                                <input name="is_colored" class="form-check-input" type="checkbox" id="colorcheck"
                                    @if(@$product->is_colored == 1)
                                        checked
                                    @endif

                                >
                            </div>

                        </x-form-input-group>

                        <div class="row colors-row"
                            @if(@$product->is_colored == 0)
                                style="display: none"
                            @endif
                        >
                        <div class="col-12">
                            <div class="main-crow row">
                                @if(@$product->is_colored == 1)
                                    @foreach ($product->getColors() as $key=>$value)
                                        @if (!empty($value))
                                            <div class="col-3">
                                                <div class="form-check">
                                                    <span class="text-danger remove"><i class="fa fa-close"></i></span>
                                                    <label class="form-check-label" for="colors{{$key}}">Select Color</label>
                                                    <input name="colors[]" class="form-control" value="{{trim($key)}}" type="color" id="colors{{$key}}" >
                                                </div>
                                                <div class="form-check">
                                                    <label class="form-check-label" for="colors{{$value}}">Select Color</label>
                                                    <input name="color_img[]" value="{{trim($value)}}" type="file" id="colors{{$value}}" >
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div class="col-3">
                                        <div class="form-check">
                                            <span class="text-danger remove"><i class="fa fa-close"></i></span>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Select Color</label>
                                            <input name="colors[]" class="form-control" type="color" id="colors" >
                                        </div>

                                        <div class="form-check">
                                            <label class="form-check-label" for="color_img">Select Color</label>
                                            <input name="color_img[]" class="color_img" type="file" id="color_img" >
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">

                            <button type="button" class="btn btn-primary add-color mt-5">Add New Color <i class="fa fa-plus"></i></button>
                            <hr>
                        </div>
                        </div>

                        <x-form-submit class="float-end">
                            <span class="text-green-500">{{ empty($product) ? __('Save') :__('Update') }}</span>
                        </x-form-submit>


                        </div>

                    </div>
                        </x-form>
                </div>
            </div>
        </div>
    </div>


    <!--end page wrapper -->
@endsection

@section("scripts")
    <script defer src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">

        $(document).on('click' , '.add-color' , function(){
            var output = `<div class="col-3">
                            <div class="form-check">
                                <span class="text-danger remove"><i class="fa fa-close"></i></span>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Select Color</label>
                                <input name="colors[]" class="form-control" type="color" id="colors" >
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="color_img">Select Color</label>
                                <input name="color_img[]" class="color_img" type="file" id="color_img" required>
                            </div>
                        </div>
                        `;
            $('.main-crow').append(output);

        });
        $(document).on('click' , '.remove' , function(){
            console.log($(this).parent('.form-check').parent('.col-3'));
            $(this).parent('.form-check').parent('.col-3').remove();

        });
        $(document).ready(function() {

            $('#cat').select2();
            $('#brand').select2();

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);

                }
            }

            $("#image_selector").change(function () {
                readURL(this);
            });
        });
        $(document).on('click' , '#colorcheck' , function(){
            if($(this).is(":checked")){
                $('.colors-row').show();
                $('.color_img').attr('required' , true);
            }else{
                $('.colors-row').hide();
                $('.color_img').attr('required' , false);
            }
        })
    summerNoteRefresh($('#description'));
    function summerNoteRefresh(el) {
        if (el.length) {
            $(el).summernote({
                tabsize: 2,
                height: 350,
                callbacks: {
                    onImageUpload: function(files) {
                        sendFile(files[0] , el);
                    }
                }
            });
            $(".summernote").summernote('code', $('#description').val())
        }
    }

        //uploading image on summerNote
    function sendFile(file , el) {
        var data = new FormData();
        data.append('files', file);
        var upload_url = '/adminpanel/settings/upload/image';
        $.ajax({
            data: data,
            type: 'POST',
            url: upload_url,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(res) {
                if (res.error) {} else {
                    el.summernote("insertImage", res.url);
                }
            }
        })
    }
    </script>



@endsection


