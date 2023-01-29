@extends('backend.layouts.auth')
@section('content')
<!-- wrapper -->
<div class="wrapper">
    <div class="authentication-forgot d-flex align-items-center justify-content-center">
        <div class="card forgot-box">
            <div class="card-body">

                <div class="p-4 rounded  border">
                    <div class="text-center">
                        <img src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/images/icons/forgot-2.png')}}" width="120" alt="" />
                    </div>
                    <h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <p class="fw-bold text-dark"> {{session('status') ? session('status') : __('No problem ,Just let us know your email address')}}<br>
                            @if(!session('status'))
                            {{__('and we will email you a password reset link that will allow you to choose a new password.') }}</p>
                        @endif
                        <div class="my-4">
                            <label for="emailValidation" class="form-label">Email id</label>
                            <input type="email" name="email" value="{{ old('email') }}" aria-describedby="emailValidation" class="form-control form-control-lg" placeholder="example@gmail.com" required autofocus />

                            @if ($errors->any())
                                <p class="help-block text-danger mt-2">
                                    @foreach ($errors->all() as $error)
                                   {{ $error }}
                                    @endforeach
                                </p>
                                @endif

                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-info btn-md">  {{ __('Email Password Reset Link') }}</button> <a href="{{ url('login') }}" class="btn btn-light btn-lg"><i class='bx bx-arrow-back me-1'></i>Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end wrapper -->
@endsection
