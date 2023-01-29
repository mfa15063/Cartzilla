@extends('backend.layouts.modal')

@push('title')
    {{ empty($offer) ? __('Add Offer') : __('Edit Offer') }}
@endpush
<link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet"/>
<link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet"/>

@section('content')
    <x-form method="{{ empty($offer) ? 'post' : 'put' }}"
            @csrf
        action="{{ empty($offer) ? url('adminpanel/offers') : url('/adminpanel/offers/' . $offer->id) }}"
        class="bootstrap-modal-form" enctype="multipart/form-data">
        @bind(@$offer)
         <x-form-input-group>
            <x-form-input name="name" id="offer" label="Offer Name" floating required />
            <x-form-input name="price" label="Offer Price" floating required />
         </x-form-input-group>
         <x-form-input-group>

                    <select name="product_id" class="form-control select2" required floating>
                        <option value="">---Select Product---</option>
                        @foreach($products as $product)
                            <?php
                            if (isset($offer))
                            $selected = old('product_id', @$product->id) == $offer->product_id ? 'selected="selected"' : '';
                            else {
                                $selected = "";
                            }
                            ?>
                        <option value="{{$product->id}}" {{$selected}}>{{$product->name}}</option>
                        @endforeach
                    </select>

        </x-form-input-group>

        <x-form-textarea name="description" placeholder="Describe Offer details" required />
        <span id="desc-error" class="help-block text-danger"></span>
        <div>
            <img id="img"
                src="{{ empty($offer->offer_image) ? asset(env('PUBLIC_PATH' , '').'images/icon_male.jpg') : asset(env('DYNAMIC_PATH' , '').'products/' . $offer->offer_image) }}"
                class="img-thumbnail" alt="">
        </div>
        <div>

            <label for="formFileLg" class="form-label">
                @if (empty($offer))
                    Select Offer picture
                @else
                    want to change offer picture, Upload a new one and click Update
                @endif
            </label>
            <input class="form-control form-control-lg" id="formFileLg" name="offer_image" type="file">
            <span id="offer-error" class="help-block text-danger"></span>
        </div>
        @endbind
        <hr>
        <x-form-submit class="float-end">
            <span class="text-green-500">{{ empty($offer) ? __('Save') : __('Update') }}</span>
        </x-form-submit>


    </x-form>

@endsection
@push('scripts')
    <script src="{{ asset(env('PUBLIC_PATH' , '').'backend/assets/js/form-validation.js') }}"></script>
    <script src="{{ asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/select2/js/select2.min.js') }}"></script>

    <script>

        $(document).ready(function(){
            $('.select2').select2({
                dropdownParent: $('#remoteModalContainer')
            });
        });

        $('#offer').focus();

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);

            }
        }

        $("#formFileLg").change(function() {
            readURL(this);
        });
    </script>
@endpush
<!-- End Modal -->
