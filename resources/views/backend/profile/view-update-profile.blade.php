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
                    <x-form method="post"
                            action="{{url('adminpanel/user-profile')}}"
                            class="bootstrap-modal-form">

                        <x-form-group>
                            <x-form-input name="first_name"  value="{{old('first_name', Auth::user()->first_name) }}"  label="First Name" floating required />
                            <x-form-input name="last_name"   value="{{ old('last_name',Auth::user()->last_name) }}"    label="Last Name" floating required />
                        </x-form-group>
                        <x-form-group>
                            <x-form-input type="email" name="email"  value="{{old('email',  Auth::user()->email) }}"   label="Email" floating required  />
                            <x-form-input type="number" name="mobile_number"  value="{{old('mobile_number',  Auth::user()->mobile_number) }}"    label="Mobile #"  floating required  />
                        </x-form-group>


                        <x-form-select name="state_id" id="state_id" label="Select Province (State)">
                            @if(!empty(Auth::user()->state_id))
                                <option value="{{ old('state_id',Auth::user()->state_id) }}"
                                        selected="selected">{{ Auth::user()->state->name  }}</option>
                            @endif
                        </x-form-select>


                        <x-form-select name="city_id" id="city_id"  label="Select City"  >
                            @if(!empty(Auth::user()->city_id))
                                <option value="{{old('city_id',  Auth::user()->city_id ) }}"
                                        selected="selected">{{ Auth::user()->city->name  }}</option>
                            @endif
                            @if(isset($user))
                                @slot('help')
                                    <small class="form-text text-dark">
                                        Please Reselect or Change Province  before changing city
                                    </small>
                                @endslot
                            @endif

                        </x-form-select>

                        <x-form-group>
                            <x-form-input  name="post_code" value="{{old('post_code', Auth::user()->post_code)}}"  label="Post Code" floating  />

                        </x-form-group>
                        <x-form-input name="address" value="{{old('address', Auth::user()->address ) }}"  label="Complete Address"  >

                        </x-form-input>
                        <hr>
                        <x-form-submit class="float-end">
                            <span class="text-green-500">Update Profile</span>
                        </x-form-submit>


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

    <script>

        $(document).ready(function() {
            @if(session('success'))
            swal({
                title: "Success !",
                text: "{{session('success')}}",
                icon: "success",
                timer: 2000
            });

            @endif
            $('#city_id').select2();

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


@endsection


