@extends('layouts.app')
@section('styles')
    <style>
        .color{
            width:100px;
            height: 100px;
            border-radius:50%;
        }
    </style>
@endsection
@section('content')
<div class="page-title-overlap bg-dark pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
      <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
            <li class="breadcrumb-item"><a class="text-nowrap" href="{{route('front.index')}}"><i class="ci-home"></i>Home</a></li>
            <li class="breadcrumb-item text-nowrap"><a href="{{route('front.products')}}">Shop</a>
            </li>
            <li class="breadcrumb-item text-nowrap active" aria-current="page">Cart</li>
          </ol>
        </nav>
      </div>
      <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
        <h1 class="h3 text-light mb-0">Cart</h1>
      </div>
    </div>
  </div>
  <div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
      @if ($products->count() > 0)
        @include('includes.cart-items')
      @else
      <div class="text-center mt-10">

        <h3 class="text-danger">No Products Found</h3>
        <img width="200px" src="{{asset(env('PUBLIC_PATH' , '')."img/sad.png") }}"/>
      </div>
      @endif
    </div>
  </div>
@endsection
