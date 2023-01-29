@extends('backend.layouts.modal')

@push('title')
    {{ empty($brand) ? __('Add Brand') :  __('Edit Brand')  }}
@endpush
@section('content')
    <x-form method="{{empty($brand) ? 'post' : 'put'}}"
            action="{{empty($brand) ? url('adminpanel/brands') : url('/adminpanel/brands/'.$brand->id) }}"
            class="bootstrap-modal-form ">

        <div class="form-floating">
            <input id="cat" type="text" value="{{ old('name', @$brand->name) }}"  name="name" class="form-control" required>
            <label for="cat">Brand Name</label>
        </div>
        <hr>
        <x-form-submit class="float-end">
            <span class="text-green-500">{{ empty($brand) ? __('Save') :__('Update') }}</span>
        </x-form-submit>


    </x-form>
@endsection
@push('scripts')

    <script src="{{ asset(env('PUBLIC_PATH' , '').'backend/assets/js/form-validation.js') }}"></script>
    <script>
        $('#cat').focus();
    </script>
@endpush
<!-- End Modal -->
