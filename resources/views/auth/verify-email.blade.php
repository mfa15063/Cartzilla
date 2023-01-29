@extends('backend.layouts.auth')
@section('content')
    <!--wrapper-->
    <div class="container" id="verifyEmailContainer">
        <div class="card">
        <div class="card-header">
        <div class="card-title text-center text-dark">
            <b> {{__('Email verification is required')}} </b>
        </div>
        </div>
            <div class="card-body">
        <div class="alert alert-info m-5 d-flex align-items-center justify-content-center text-dark">

            @if (session('status') == 'verification-link-sent')
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            @else
                {{ __('Before getting started, could you please verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}

            @endif
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <button class="btn btn-success">
                        {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="btn btn-danger m-3">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
                <div class="card-footer bg-white text-center text-dark">
                    <b>
                        Copyright © {{date('Y')}}. All right reserved by <a href="https://www.luqmansoftwares.com/" class="card-link" target="_blank">Luqman Softwares</a>
                    </b>
                </div>
            </div>
    </div>
@endsection

