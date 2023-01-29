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

                <div class="card-body">
                    <x-form method="post"
                            action="{{url('adminpanel/change-password')}}"
                            class="bootstrap-modal-form">
                        <x-form-input type="password" name="current_password"  label="Password" floating  />
                        <x-form-input-group>
                        <x-form-input type="password" name="password"  label="New Password" floating  />

                        <x-form-input type="password" name="password_confirmation"  label="Confirm New Password" floating   />

                        </x-form-input-group>

                        <hr>
                        <x-form-submit class="float-end">
                            <span class="text-green-500">Change Password</span>
                        </x-form-submit>


                    </x-form>

                </div>
            </div>
        </div>
    </div>


    <!--end page wrapper -->
@endsection

@section("scripts")



@endsection


