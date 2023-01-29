@extends('backend.layouts.modal')

@push('title')
    {{ empty($user) ? __('Add User') :  __('Edit User')  }}
@endpush
@section('content')
    <x-form method="{{empty($user) ? 'post' : 'put'}}"
            action="{{empty($user) ? url('adminpanel/users') : url('/adminpanel/users/'.$user->id) }}"
            class="bootstrap-modal-form ">
        @bind(@$user)
        <x-form-input-group>
            <x-form-input name="first_name"  label="First Name" floating required />
            <x-form-input name="last_name"    label="Last Name" floating required />
        </x-form-input-group>
        <x-form-input-group>
        <x-form-input type="email" name="email"  label="Email" floating required  />
        <x-form-input type="number" name="mobile_number"   label="Mobile #"  floating required  />
        </x-form-input-group>
        @endbind

        <x-form-input-group>
        <x-form-input type="password" name="password"  label="Password" floating  />
            @if(isset($user))
                @slot('help')
                    <small class="form-text text-danger">
                        Leave password fields  blank if to you don't want to change / update the password
                    </small>
                @endslot
            @endif
            <x-form-input type="password" name="password_confirmation"  label="Confirm Password" floating   />

        </x-form-input-group>



        <x-form-select name="state_id" id="state_id" label="Select Province (State)">
            @if(!empty($user->state_id))
                <option value="{{ $user->state_id }}"
                        selected="selected">{{ $user->state->name  }}</option>
            @endif
        </x-form-select>


        <x-form-select name="city_id" id="city_id"  label="Select City"  >
            @if(!empty($user->city_id))
                <option value="{{ $user->city_id }}"
                        selected="selected">{{ $user->city->name  }}</option>
            @endif
                @if(isset($user))
                    @slot('help')
                        <small class="form-text text-dark">
                            Please Reselect or Change Province  before changing city
                        </small>
                    @endslot
                @endif

        </x-form-select>

        @bind(@$user)
        <x-form-input-group>
        <x-form-input  name="post_code"   label="Post Code" floating  />

        <x-form-textarea name="address" label="Complete Address"  floating />
        </x-form-input-group>
        <hr>
        <x-form-submit class="float-end">
            <span class="text-green-500">{{ empty($user) ? __('Save') :__('Update') }}</span>
        </x-form-submit>
@endbind

    </x-form>
@endsection
@push('scripts')

<script src="{{ asset(env('PUBLIC_PATH' , '').'backend/assets/js/form-validation.js') }}"></script>

<script>

    $(document).ready(function() {

        $('#city_id').select2();
        @if(!isset($user))
        $("#city_id").prop("disabled", true);
        @endif
        $("#state_id").select2({

            ajax: {
                url: "{{ url('search-state') }}",
                dataType: 'json',
                delay: 50,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: false
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 2,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });

        function formatRepo(repo) {
            if (repo.loading) return repo.text;
            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.name + "</div>";
            "</div></div>";

            return markup;
        }

        function formatRepoSelection(repo) {
            if (typeof repo.name != 'undefined') {
                return repo.name;
            } else {
                return repo.text;
            }
        }


    });

    $('#state_id').on('select2:select', function (e)

    {

        $("#city_id").prop("disabled", false);
        $('#city_id').val(null).trigger('change');
        $('#city_id')
            .find('option')
            .remove()
            .end();

        $("#city_id").select2({

            ajax: {
                url: "{{ url('search-city') }}/" +   $('#state_id').val(),
                dataType: 'json',
                delay: 100,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;

                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: false
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 2,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
        function formatRepo(repo) {
            if (repo.loading) return repo.text;
            var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.name + "</div>";
            "</div></div>";

            return markup;
        }

        function formatRepoSelection(repo) {
            if (typeof repo.name != 'undefined') {
                return repo.name;
            } else {
                return repo.text;
            }
        }


    });

</script>
@endpush
<!-- End Modal -->
