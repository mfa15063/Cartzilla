@extends('backend.layouts.auth')
@push('title')Reset Password
    @endpush
@section('content')
    <div class="wrapper">
        <div class="authentication-reset-password d-flex align-items-center justify-content-center">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-lg-5 border-end">
                                <div class="card-body">
                                    <div class="p-5">
                                        <form class="row g-3" method="post" action="{{url('reset-password')}}">

                                            @csrf
                                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                                            <div class="text-start">
                                                <img src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/images/logo-img.png')}}" width="180" alt="">
                                            </div>
                                            <h4 class="mt-5 font-weight-bold">Genrate New Password</h4>
                                            <p class="text-muted">We received your reset password request. Please enter your new password!</p>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <input type="email" name="email" value="{{old('email')}}" class="form-control" id="inputEmailAddress" placeholder="Email Address" required autofocus />
                                            </div>
                                            <span class="text-danger">
                                              {{$errors->first('email') ? $errors->first('email') :""}}
                                          </span>
                                            <div class="mb-3">
                                                <label class="form-label">New Password</label>
                                                <input type="password" name="password" class="form-control" placeholder="Enter new password" required />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" name="password_confirmation"  class="form-control" placeholder="Confirm password" required />
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary">Change Password</button> <a href="{{ route('login') }}" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Back to Login</a>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-7">
                                <img src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/images/login-images/reset-password.jpg') }}" class="card-img login-img h-100" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


