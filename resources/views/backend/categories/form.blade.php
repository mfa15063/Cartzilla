@extends('backend.layouts.modal')

@push('title')
    {{ empty($category) ? __('Add Category') :  __('Edit Category')  }}
@endpush
@section('content')
    <x-form method="{{empty($category) ? 'post' : 'put'}}"
            action="{{empty($category) ? url('adminpanel/categories') : url('/adminpanel/categories/'.$category->id) }}"
            class="bootstrap-modal-form ">

        <div class="form-floating">
            <input id="cat" type="text" value="{{ old('name', @$category->name) }}"  name="name" class="form-control" required>
            <label for="cat">Category Name</label>
        </div>
        <hr>
        <x-form-submit class="float-end">
            <span class="text-green-500">{{ empty($Category) ? __('Save') :__('Update') }}</span>
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
