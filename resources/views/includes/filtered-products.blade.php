@php
    $last_id = '';
@endphp
@foreach ($products as $product)
    @php
        $last_id = $product->id;
    @endphp
    <div class="col-md-4 col-sm-6 px-2 mb-4">
        <div class="card product-card all-products-card">
            @auth
                <button class="btn-wishlist add-wishlist btn-sm" data-route="{{route('add-to-wish' , $product->id)}}" type="button" data-bs-toggle="tooltip"
                    data-bs-placement="left" title="Add to wishlist"><i class="ci-heart"></i>
                </button>

            @endauth

                <a class="card-img-top d-block overflow-hidden"
                href="{{route('front.product' , $product->slug)}}">
                <img src="{{ asset(env('DYNAMIC_PATH' , '').'products/' . $product->product_image) }}" alt="{{ $product->name }}"></a>
            <div class="card-body py-2">
                <a class="product-meta d-block fs-xs pb-1" href="#">{{$product->category->name}}</a>
                <h3 class="product-title fs-sm">
                    <a href="{{ route('front.product' , $product->slug) }}">{{$product->name}}</a></h3>
                <div class="d-flex justify-content-between">
                    <div class="product-price">

                        <span class="text-accent">R {{$product->getPrice()}}<small>{{$product->getFraction()}}</small></span>
                    </div>
                    <div class="star-rating">
                        @php
                            if($product->reviews != null)
                                $rating = $product->reviews->avg('rating');
                            else
                                $rating = 0;
                        @endphp
                        <div class="empty-stars empty-stars-nw"></div>
                        <div class="full-stars azfull empty-stars-nw" style="width:{{$rating}}%"></div>
                    </div>
                </div>
            </div>
            <div class="card-body card-body-hidden">
                <button class="btn btn-primary btn-sm d-block w-100 mb-2 add-to-cart" data-route="{{route('add-to-cart' , [$product->id])}}" type="button"><i
                        class="ci-cart fs-sm me-1"></i>Add to Cart</button>
                <div class="text-center">
                    <a class="nav-link-style fs-ms" href="{{route('quick-view' , $product->id)}}"  data-toggle="ajaxModal">
                        <i class="ci-eye align-middle me-1"></i>Quick view
                    </a>
                </div>
            </div>
        </div>
        <hr class="d-sm-none">
    </div>
@endforeach
@php
        $check = true;
    @endphp


<div id="load_more">
    <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="{{ $last_id }}"

        id="load_more_button"

    >Load More</button>
</div>
<script>
    var total = {{ $total }};
    prevTotal = document.getElementsByClassName('all-products-card').length;

    if(total == prevTotal){
        document.getElementById('load_more_button').style.display = "none";
    }
</script>
