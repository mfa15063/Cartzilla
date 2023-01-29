@extends("backend.layouts.app")
    @section("wrapper")
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            @include('backend.layouts.breadcrumbs')
            <h6 class="mb-0 text-uppercase">{{$page_heading ?? ''}}</h6>
            <hr/>
            <div class="card">
                <div class="card-header">
                  <strong class="text-dark">  Please be careful: Any changes made here will affect the live website.</strong>
                </div>
                <div class="card-body">
                <form method="POST" action="{{url(Request::path())}}" class="form-horizontal">
                    <div class="table-responsive sm-2">
                        <table class="table table-striped table-hover">
                            <tr>
                                <th class="col-md-2 text-left">Setting</th>
                                <th>Value</th>
                                <th>Last updated at</th>
                            </tr>

                            <tr>
                                <td class="text-left">{{$address->setting_name}}</td>
                                <td><input class="form-control" type="text" id="address" name="address" value="{{$address->setting_value}}"></td>
                                <td>{{$address->updated_at}}</td>
                            </tr>

                            <tr>
                                <td class="text-left">{{$phone_number->setting_name}}</td>
                                <td><input class="form-control" type="text" id="phone_number" name="phone_number" value="{{$phone_number->setting_value}}"></td>
                                <td>{{$phone_number->updated_at}}</td>
                            </tr>
                            <tr>
                                <td class="text-left">{{$mobile_number->setting_name}}</td>
                                <td><input class="form-control" type="text" id="mobile_number" name="mobile_number" value="{{$mobile_number->setting_value}}"></td>
                                <td>{{$mobile_number->updated_at}}</td>
                            </tr>

                            <tr>
                                <td class="text-left">{{$instagram_account->setting_name}}</td>
                                <td><input class="form-control" type="text" id="instagram_account" name="instagram_account" value="{{$instagram_account->setting_value}}"></td>
                                <td>{{$instagram_account->updated_at}}</td>
                            </tr>


                            <tr>
                                <td class="text-left">{{$email_address->setting_name}}</td>
                                <td><input class="form-control" type="text" id="email_address" name="email_address" value="{{$email_address->setting_value}}"></td>
                                <td>{{$email_address->updated_at}}</td>
                            </tr>

                            <tr>
                                <td class="text-left">{{$twitter_account->setting_name}}</td>
                                <td><input class="form-control" type="text" id="twitter_account" name="twitter_account" value="{{$twitter_account->setting_value}}"></td>
                                <td>{{$twitter_account->updated_at}}</td>
                            </tr>

                            <tr>
                                <td class="text-left">{{$facebook_account->setting_name}}</td>
                                <td><input class="form-control" type="text" id="facebook_account" name="facebook_account" value="{{$facebook_account->setting_value}}"></td>
                                <td>{{$facebook_account->updated_at}}</td>
                            </tr>
                            @php
                                // dd($privacy_policy->setting_name);
                            @endphp
                            <tr>
                                <td class="text-left">{{$privacy_policy->setting_name}}</td>
                                <td>
                                    <textarea id="privacy_policy" name="privacy_policy" class="summernote">{!! $privacy_policy->setting_value !!}</textarea>
                                </td>
                                <td>{{$terms_and_condition->updated_at}}</td>
                            </tr>

                            <tr>
                                <td class="text-left">{{$terms_and_condition->setting_name}}</td>
                                <td>
                                    <textarea id="terms" name="terms_and_condition" class="summernote">{!! $terms_and_condition->setting_value !!}</textarea>
                                </td>
                                <td>{{$terms_and_condition->updated_at}}</td>
                            </tr>

                            <tr>
                                <td class="text-left">{{@$return_policy->setting_name}}</td>
                                <td>
                                    <textarea id="return_policy" name="return_policy" class="summernote">{!! @$return_policy->setting_value !!}</textarea>
                                </td>
                                <td>{{@$return_policy->updated_at}}</td>
                            </tr>



                            <tr>
                                <td class="text-left">{{@$paypal_mode->setting_name ? @$paypal_mode->setting_name : "Paypal Mode"}}</td>
                                <td>
                                    <select class="form-control" name="paypal_mode">
                                        <option value="" >Select</option>
                                        <option value="live" @if(@$paypal_mode->setting_value == "live") selected @endif>Live</option>
                                        <option value="sandbox" @if(@$paypal_mode->setting_value == "sandbox") selected @endif>Sandbox</option>
                                    </select>
                                </td>
                                <td>{{@$paypal_mode->updated_at}}</td>
                            </tr>
                            <tr>
                                <td class="text-left">{{@$paypal_username->setting_name ? @$paypal_username->setting_name : "Paypal Username"}}</td>
                                <td>
                                    <input type="text" class="form-control" id="paypal_username" name="paypal_username" value="{!! @$paypal_username->setting_value !!}">
                                </td>
                                <td>{{@$paypal_username->updated_at}}</td>
                            </tr>

                            <tr>
                                <td class="text-left">{{@$paypal_password->setting_name ? @$paypal_password->setting_name : "Paypal Password"}}</td>
                                <td>
                                    <input type="password" class="form-control" id="paypal_password" name="paypal_password" value="{!! @$paypal_password->setting_value !!}">
                                </td>
                                <td>{{@$paypal_password->updated_at}}</td>
                            </tr>
                            <tr>
                                <td class="text-left">{{@$paypal_secret->setting_name ? @$paypal_secret->setting_name : "Paypal Secret"}}</td>
                                <td>
                                    <input type="password" id="paypal_secret" name="paypal_secret" class="form-control" value="{!! @$paypal_secret->setting_value !!}" >
                                </td>
                                <td>{{@$paypal_secret->updated_at}}</td>
                            </tr>
                            <tr>
                                <td class="text-left">{{@$stripe_key->setting_name ? @$stripe_key->setting_name : "Stripe Key"}}</td>
                                <td>
                                    <input type="password" id="f_stripe_key" name="stripe_key" class="form-control" value="{!! @$stripe_key->setting_value !!}" >
                                </td>
                                <td>{{@$stripe_key->updated_at}}</td>
                            </tr>
                            <tr>
                                <td class="text-left">{{@$stripe_secret->setting_name ? @$stripe_secret->setting_name : "Stripe Secret"}}</td>
                                <td>
                                    <input type="password" id="stripe_secret" name="stripe_secret" class="form-control" value="{!! @$stripe_secret->setting_value !!}" >
                                </td>
                                <td>{{@$stripe_secret->updated_at}}</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="text-left" colspan="3"><button type="submit" class="btn btn-success ms-4">Update</button></td>
                            </tr>
                        </table>
                    </div>
                    {!! method_field('PUT') !!}
                    {!! csrf_field() !!}
                </form>


        </div><!-- /.box-body -->
    </div><!-- /.box -->
        </div>
    </div>

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
    summerNoteRefresh($('#privacy_policy'));
    summerNoteRefresh($('#terms'));
    summerNoteRefresh($('#return_policy'));
    function summerNoteRefresh(el) {
        if (el.length) {
            $(el).summernote({
                tabsize: 2,
                height: 350,
            });
            $(".summernote").summernote('code', $('#description').val())
        }
    }

    //     //uploading image on summerNote
    // function sendFile(file , el) {
    //     var data = new FormData();
    //     data.append('files', file);
    //     var upload_url = '/adminpanel/settings/upload/image';
    //     $.ajax({
    //         data: data,
    //         type: 'POST',
    //         url: upload_url,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         dataType: "JSON",
    //         success: function(res) {
    //             if (res.error) {} else {
    //                 el.summernote("insertImage", res.url);
    //             }
    //         }
    //     })
    // }

    </script>

@endsection
