@extends('layouts.app')
@section('styles')

    <style>
        a.dropdown-item:hover {
            background-color: #DCDCDC !important;
        }

        #cart:hover {
            color: red;
        }

    </style>

@endsection
@section('content')


    <!-- Products grid (Trending products)-->
    <section class="container pt-5">
        <!-- Heading-->
        <div class="d-flex flex-wrap justify-content-between align-items-center pt-1 border-bottom pb-4 mb-4">
            <h2 class="h3 mb-0 pt-3 me-2">Featured products</h2>
            <div class="pt-3">
                <a class="btn btn-outline-accent btn-sm" href="{{route('front.products')}}">
                    More products
                    <i class="ci-arrow-right ms-1 me-n1"></i>
                </a>
            </div>
        </div>
        <!-- Grid-->
        <div class="row pt-2 mx-n2">
            <!-- Product-->
            @foreach ($products as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 px-2 mb-4">
                    <div class="card product-card">
                        <div class="product-card-actions d-flex align-items-center">
                            @auth
                            <button class="btn-wishlist add-wishlist btn-sm" data-route="{{route('add-to-wish' , $product->id)}}" type="button" data-bs-toggle="tooltip"
                                data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i>
                            </button>
                            @endauth
                        </div>
                        <a class="card-img-top d-block overflow-hidden" href="{{ route('front.product' , $product->slug) }}">
                            <img width="518"
                                height="484" src="{{ asset(env('DYNAMIC_PATH' , '').'products/' . $product->product_image) }}"
                                alt="Product">
                        </a>
                        <div class="card-body py-2">
                            <a class="product-meta d-block fs-xs pb-1"
                                href="#">{{ $product->category->name }}</a>
                            <h3 class="product-title fs-sm"><a href="{{ route('front.product' , $product->slug) }}">{{ $product->name }}</a></h3>
                            @php

                                if (!Auth::check()) {
                                    $n = $product->standard;
                                    $price = (int) $n; // 1
                                    $fraction = $n - $price;
                                } else {
                                    if (Auth::user()->price_category == 'standard') {
                                        $n = $product->standard;
                                        $price = (int) $n; // 1
                                        $fraction = $n - $price;
                                    } elseif (Auth::user()->price_category == 'premium') {
                                        $n = $product->premium;
                                        $price = (int) $n; // 1
                                        $fraction = $n - $price;
                                    } else {
                                        $n = $product->gold;
                                        $price = (int) $n; // 1
                                        $fraction = $n - $price;
                                    }
                                }

                            @endphp
                            <div class="d-flex justify-content-between">
                                <div class="product-price"><span class="text-accent"> R {{ $price }}
                                        <small>{{ substr($fraction, 1, 3) }}</small></span></div>
                                <div class="star-rating">

                                    <div class="empty-stars empty-stars-nw"></div>
                                    <div class="full-stars azfull empty-stars-nw" style="width:{{ $product->rating() }}%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-body-hidden">

                                <button class="btn btn-primary btn-sm d-block w-100 mb-2 add-to-cart" data-route="{{route('add-to-cart' , [$product->id])}}" type="button">
                                    <i class="ci-cart fs-sm me-1"></i>
                                    Add to Cart
                                </button>

                            <div class="text-center">
                                <a class="nav-link-style fs-ms"
                                    href="{{ route('quick-view' , $product->id) }}" data-toggle="ajaxModal">
                                    <i
                                        class="ci-eye align-middle me-1"></i>Quick View</a>
                            </div>

                        </div>
                    </div>
                    <hr class="d-sm-none">
                </div>
            @endforeach
        </div>
    </section>

    @include("includes.offers")
@endsection
@section('scripts')




@endsection
