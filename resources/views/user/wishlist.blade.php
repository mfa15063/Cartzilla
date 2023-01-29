@extends('layouts.app')
@section('content')

<x-dashboard-header mainpage="Wishlist" subpage="My Wishlist"></x-dashboard-header>

<div class="container pb-5 mb-2 mb-md-4">
    <div class="row">
        @include('user.includes.sidebar')
        <section class="col-lg-8">

            <div class="d-none d-lg-flex justify-content-between align-items-center pt-lg-3 pb-4 pb-lg-5 mb-lg-3">
                <h6 class="fs-base text-light mb-0">Wishlist Products:</h6>

            </div>
        @if ($wishlist->count() != 0)
            @foreach ($wishlist as $item)
            <div id="remove{{$item->id}}" class="d-sm-flex justify-content-between mt-lg-4 mb-4 pb-3 pb-sm-2 border-bottom">
                <div class="d-block d-sm-flex align-items-start text-center text-sm-start">
                    <a class="d-block flex-shrink-0 mx-auto me-sm-4" href="{{route('front.product' , $item->product->slug)}}"
                    style="width: 10rem;">
                    <img src="{{asset(env('DYNAMIC_PATH' , '').'products/'.$item->product->product_image)}}" alt="Product"></a>
                    <div class="pt-2">
                    <h3 class="product-title fs-base mb-2">
                        <a href="{{route('front.product' , $item->product->slug)}}"
                        >
                            {{$item->product->name}}
                        </a>
                    </h3>
                    @if ($item->product->is_colored == 1)

                    <div class="fs-sm"><span class="text-muted me-2">Color:</span>

                    </div>
                    @endif
                    <div class="fs-lg text-accent pt-2">R. {{$item->product->getPrice()}} {{$item->product->getFraction()}} </div>
                    </div>
                </div>
                <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                    <button class="btn btn-outline-danger btn-sm wremove" data-item="remove{{$item->id}}"
                        data-route="{{route('user.wishlist.remove' , $item->id)}}" type="button">
                        <i class="ci-trash me-2"></i>
                        Remove
                    </button>
                </div>
            </div>

            @endforeach
            {!! $wishlist->links() !!}
            @else
            <div class="text-center">

              <h3 class="text-danger">Wishlist is empty</h3>
              <img width="200px" src="{{asset(env('PUBLIC_PATH' , '')."img/sad.png") }}"/>
            </div>
            @endif
        </section>
    </div>
</div>
@endsection
