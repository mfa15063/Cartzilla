@extends('layouts.app')
@section('content')
<div class="page-title-overlap bg-dark pt-4">
    <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
      <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
            <li class="breadcrumb-item">
              <a class="text-nowrap" href="{{ route('front.index') }}"><i class="ci-home">
                </i>Home</a></li>
            <li class="breadcrumb-item text-nowrap active">
              <a href="#">Offers</a>
            </li>
          </ol>
        </nav>
      </div>
      <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
        <h1 class="h3 text-light mb-0">All offers</h1>
      </div>
    </div>
</div>
<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
    <!-- Sidebar-->
    <!-- Content  -->
    <section class="col-lg-12 col-md-12 col-sm-12">
        <!-- Toolbar-->
        <div class="d-flex justify-content-center justify-content-sm-between align-items-center pt-2 pb-4 pb-sm-5">

        </div>
        <!-- Products grid-->
        <div class="row mx-n2">
            <!-- Product-->
            @php
                $last_id = '';
            @endphp
              @foreach ($offers as $offer)
                  <div class="col-lg-4 col-md-4 col-sm-12 px-2 mb-4">
                      <div class="card product-card all-products-card">

                              <a class="card-img-top d-block overflow-hidden"
                              href="{{route('front.products')}}">
                              <img src="{{ empty($offer->offer_image) ? asset(env('DYNAMIC_PATH' , '').'images/icon_male.jpg'):asset(env('DYNAMIC_PATH' , '').'products/'.$offer->offer_image) }}" alt="{{ $offer->name }}"></a>
                          <div class="card-body py-2">
                              <h3 class="product-title fs-sm">
                                <a href="{{route('front.products')}}">{{$offer->name}}</a></h3>
                              <div class="d-flex justify-content-between">
                                  <div class="product-price">

                                      <span class="text-accent">R <small>{{$offer->price}}</small></span>
                                  </div>
                              </div>
                          </div>
                          <div class="card-body card-body-hidden">
                              <button class="add-to-cart btn btn-primary btn-sm d-block w-100 mb-2" data-route="{{route('add-to-cart' , [$offer->product_id , $offer->id])}}" type="button">
                                <i class="ci-cart fs-sm me-1"></i>Add to Cart
                              </button>
                          </div>
                      </div>
                      <hr class="d-sm-none">
                  </div>
              @endforeach
                {{$offers->links()}}
        </div>
    </section>
    </div>
</div>
@endsection
