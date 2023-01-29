@extends('layouts.app')
@section('content')
<!-- Page Title-->

<x-dashboard-header  subpage="Profile Info" mainpage="Account"></x-dashboard-header>
<div class="container pb-5 mb-2 mb-md-4">
  <div class="row">
      @include('user.includes.sidebar')
      <section class="col-lg-8">
        <!-- Toolbar-->
        <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
            <h6 class="fs-base text-light mb-0">Update you profile details below:</h6>
        </div>
          <!-- Profile form-->
          <form action="{{route('user.profile.update')}}" method="post" class="form">
            @csrf
            <div class="row gx-4 gy-3">
              <div class="col-sm-6">
                <label class="form-label" for="account-fn">First Name</label>
                <input class="form-control" name="first_name" type="text" value="{{Auth::user()->first_name}}" id="account-fn">
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="account-ln">Last Name</label>
                <input class="form-control" name="last_name" type="text" id="account-ln" value="{{Auth::user()->last_name}}">
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="account-email">Email Address</label>
                <input class="form-control" disabled type="email" id="account-email" value="{{Auth::user()->email}}">
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="account-phone">Phone Number</label>
                <input class="form-control" name="mobile_number" type="text" id="account-phone" value="{{Auth::user()->mobile_number}}">
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="account-phone">State</label>
                <select data-url="{{ route('front.state.cities') }}" class="form-select" id="state" name="state_id">
                    <option value="">--Select State--</option>
                    @foreach (App\Models\State::get() as $item)
                        <option @if (Auth::user()->state_id == $item->id) selected @endif
                            value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
              </div>
              <div class="col-sm-6">

                <label class="form-label" for="city">City</label>
                @if (Auth::user()->city_id != "")
                    <select class="form-select" id="city" name="city_id">
                        @foreach (App\Models\City::whereStateId(Auth::user()->state_id)->get() as $item)
                            <option @if (Auth::user()->city_id == $item->id) selected @endif
                                value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                @else
                    <select class="form-select" id="city" name="city_id">
                    </select>
                @endif
              </div>

              <div class="col-sm-6">
                <label class="form-label" for="postal_code">Postal Code</label>
                <input class="form-control" name="postal_code" type="text" id="postal_code" value="{{Auth::user()->post_code}}">
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="address">Address</label>
                <input class="form-control" name="address" type="text" id="address" value="{{Auth::user()->address}}">
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="account-pass">New Password</label>
                <div class="password-toggle">
                  <input class="form-control" name="password" type="password" id="account-pass">
                  <label class="password-toggle-btn" aria-label="Show/hide password">
                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                  </label>
                </div>
              </div>
              <div class="col-sm-6">
                <label class="form-label" for="account-confirm-pass">Confirm Password</label>
                <div class="password-toggle">
                  <input class="form-control" name="password_confirmation" type="password" id="account-confirm-pass">
                  <label class="password-toggle-btn" aria-label="Show/hide password">
                    <input class="password-toggle-check" type="checkbox"><span class="password-toggle-indicator"></span>
                  </label>
                </div>
              </div>
              <div class="col-12">
                <hr class="mt-2 mb-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center">

                  <button class="btn btn-primary mt-3 mt-sm-0" type="submit">Update profile</button>
                </div>
              </div>
            </div>
          </form>
      </section>
  </div>
</div>
@endsection
@section('scripts')
    <script>

      $(document).on('change' , '#state' , function(){
            var id = $(this).val();
            var url = $(this).data('url')+"/"+id;
            $.get(url , function(res){
                $('#city').html(res);
            })
        } )
    </script>
@endsection
