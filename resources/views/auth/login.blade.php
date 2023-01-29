@extends('backend.layouts.auth')
@push('title')
    {{env('APP_NAME')}}-Login
@endpush
@section('content')

    <div class="wrapper">
        <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                    <div class="col mx-auto">
                        <div class="mb-4 text-center">
                            <img src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/images/logo-img.png')}}" width="180" alt=""/>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="border p-4 rounded">
                                    <div class="text-center">
                                        <h3 class="">Sign in</h3>
                                        <p>Don't have an account yet? <a href="{{ url('register') }}">Sign up here</a>
                                        </p>
                                    </div>
                                    <div class="d-grid">
                                        <a class="btn my-4 shadow-sm btn-white" href="{{url('/google-auth')}}"> <span
                                                class="d-flex justify-content-center align-items-center">
                          <img class="me-2" src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/images/icons/search.svg')}}" width="16"
                               alt="Image Description">
                          <span>Sign in with Google</span>
											</span>
                                        </a> <a href="{{url('/fb-auth')}}" class="btn btn-facebook"><i
                                                class="bx bxl-facebook"></i>Sign in with Facebook</a>
                                    </div>
                                    <div class="login-separater text-center mb-4"><span>OR SIGN IN WITH EMAIL</span>
                                        <hr/>
                                    </div>
                                    @if (session('status'))
                                        <div class="alert alert-success text-dark">
                                        {{session('status')}}
                                        </div>
                                        @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="form-body">
                                        <form class="row g-3" method="post" action="{{url('login')}}">
                                            @csrf
                                            <div class="col-12">
                                                <label for="inputEmailAddress" class="form-label">Email Address</label>
                                                <input type="email" name="email" value="{{ old('email') }}"
                                                       class="form-control" id="inputEmailAddress"
                                                       placeholder="Email Address" required autofocus/>
                                                <span class="text-danger">
                                              {{$errors->first('email') ? $errors->first('email') :""}}
                                          </span>
                                            </div>
                                            <div class="col-12">
                                                <label for="inputChoosePassword" class="form-label">Enter
                                                    Password</label>
                                                <div class="input-group" id="show_hide_password">
                                                    <input type="password" name="password"
                                                           class="form-control border-end-0" id="inputChoosePassword"
                                                           required> <a href="javascript:;"
                                                                        class="input-group-text bg-transparent"><i
                                                            class='bx bx-hide'></i></a>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox"
                                                           id="flexSwitchCheckChecked">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember
                                                        Me</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6 text-end"><a href="{{ route('password.request') }}">Forgot
                                                    Password ?</a>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button type="submit" class="btn btn-primary"><i
                                                            class="bx bxs-lock-open"></i>Sign in
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <!--plugins-->
    <script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/js/jquery.min.js')}}"></script>


    <!--Password show & hide js -->
    <script>
        $(document).ready(function () {
            $("#show_hide_password a").on('click', function (event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>


@endsection
