@extends('backend.layouts.auth')
@push('title')
    Registration
    @endpush
@section('styles')
 <style>
     #heading{
         margin-left: 42%;

     }
 </style>
@endsection
@section('content')
    <div class="wrapper">

        <div class="row">
            <div class="col-xl-7 mx-auto">

                <hr/>
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-5">
                        <div class="card-title d-flex align-items-center">
                            <div><i class="bx bxs-user me-1 font-22 text-primary position-absolute top-0 start-50"></i>
                            </div>
                            <h5 class="mb-0 text-primary" id="heading">User Registration</h5>
                        </div>
                        <hr>
                        <form class="row g-3" method="post" action="{{route('register')}}" autocomplete="off">
                            @csrf
                            <div class="col-md-6">
                                <label for="inputFirstName" class="form-label">{{__('first_name')}}</label>
                                <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control" id="inputFirstName" required autofocus>
                                <span class="text-danger">
                                              {{$errors->first('first_name') ? $errors->first('first_name') :""}}
                                          </span>
                            </div>
                            <div class="col-md-6">
                                <label for="inputLastName" class="form-label">{{__('last_name')}}</label>
                                <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control" id="inputLastName" required>
                                <span class="text-danger">
                                              {{$errors->first('last_name') ? $errors->first('last_name') :""}}
                                          </span>
                            </div>
                            <div class="col-md-12">
                                <label for="inputEmail" class="form-label">Email</label>
                                <input type="email" name="email" value="{{old('email')}}" class="form-control" autocomplete="off" id="inputEmail" required>
                                <span class="text-danger">
                                              {{$errors->first('email') ? $errors->first('email') :""}}
                                          </span>
                            </div>

                            <div class="col-md-6">
                                <label for="inputChoosePassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" required>
                                    <br>
                                    <span class="text-danger">
                                              {{$errors->first('password') ? $errors->first('password') :""}}
                                          </span>
                            </div>
                                <div class="col-md-6">
                                    <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control border-end-0" id="inputConfirmPassword" required>
                                    <span class="text-danger">
                                              {{$errors->first('password_confirmation') ? $errors->first('password_confirmation') :""}}
                                          </span>
                                </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Address</label>
                                <textarea class="form-control" id="inputAddress" placeholder="Address..." rows="3"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="inputAddress2" class="form-label">Address 2</label>
                                <textarea class="form-control" id="inputAddress2" placeholder="Address 2..." rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="inputCity" class="form-label">City</label>
                                <input type="text" class="form-control" id="inputCity">
                            </div>
                            <div class="col-md-4">
                                <label for="inputState" class="form-label">State</label>
                                <select id="inputState" class="form-select">
                                    <option selected>Choose...</option>
                                    <option>...</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="inputZip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="inputZip">
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck">
                                    <label class="form-check-label" for="gridCheck">Check me out</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5">Register</button>
                            </div>
                        </form>
                    </div>
                </div>

        </div>
    </div>
    </div>
@endsection
