@extends('layouts.app')
@section('content')
<!-- Custom page title-->
<div class="page-title-overlap bg-dark pt-4">
  <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
    <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
          <li class="breadcrumb-item">
            <a class="text-nowrap" href="{{route('front.index')}}"><i class="ci-home"></i>Home</a></li>
          <li class="breadcrumb-item text-nowrap">
            <a href="{{ route('front.products') }}">Shop</a>
          </li>
          <li class="breadcrumb-item text-nowrap active" aria-current="page">{{$product->name}}</li>
        </ol>
      </nav>
    </div>
    <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
      <h1 class="h3 text-light mb-2">{{$product->name}}</h1>
      <div>
        <div class="star-rating">
          <div class="empty-stars empty-stars-nw"></div>
          <div class="full-stars azfull empty-stars-nw" style="width:{{$product->rating()}}%"></div>
      </div>
        <span class="d-inline-block fs-sm text-white opacity-70 align-middle mt-1 ms-1">
          {{$product->reviews->count()}} Reviews
        </span>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="bg-light shadow-lg rounded-3">
    <!-- Tabs-->
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item"><a class="nav-link py-4 px-sm-4 active" href="#general" data-bs-toggle="tab" role="tab">General <span class='d-none d-sm-inline'>Info</span></a></li>
      <li class="nav-item"><a class="nav-link py-4 px-sm-4" href="#specs" data-bs-toggle="tab" role="tab"><span class='d-none d-sm-inline'>Tech</span> Specs</a></li>
      <li class="nav-item"><a class="nav-link py-4 px-sm-4" href="#reviews" data-bs-toggle="tab" role="tab">Reviews <span class="fs-sm opacity-60">
        ({{$product->reviews->count()}})
        </span>
      </a>
    </li>
    </ul>
    <div class="px-4 pt-lg-3 pb-3 mb-5">
      <div class="tab-content px-lg-3">
        <!-- General info tab-->
        @include('frontend.products.general')
        <!-- Tech specs tab-->
        @include('frontend.products.specs')

        <!-- Reviews tab-->
        @include('frontend.products.reviews')

      </div>
    </div>
  </div>
</div>
<!-- Product description-->
<div class="container pt-lg-3 pb-4 pb-sm-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <h2 class="h3 pb-2">Description</h2>
      <p>{!! $product->description !!}</p>
    </div>
  </div>
</div>


@endsection
