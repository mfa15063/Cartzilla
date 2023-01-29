@extends('backend.layouts.modal')

@push('title')
    {{ $product->name ??  " " }}
@endpush
@section('content')
    <div class="row">
        <!-- Product gallery-->
        <div class="col-lg-7 pe-lg-0">
            <div class="product-gallery">
                <div class="product-gallery-preview order-sm-2">
                    <div class="product-gallery-preview-item active" id="first">
                        <img class="image-zoom" src="{{asset(env('DYNAMIC_PATH' , '').'products/'.$product->product_image)}}" data-zoom="{{asset(env('DYNAMIC_PATH' , '').'products/'.$product->product_image)}}" alt="Product image">
                        <div class="image-zoom-pane"></div>
                    </div>
                    @foreach ($product->ProductImages as $item)
                    <div class="product-gallery-preview-item" id="img{{$item->id}}">
                        <img class="image-zoom" src="{{asset(env('DYNAMIC_PATH' , '').'products/dropzone/'. $item->image_url)}}" data-zoom="{{asset(env('DYNAMIC_PATH' , '').'products/dropzone/'. $item->image_url)}}" alt="Product image">
                        <div class="image-zoom-pane"></div>
                    </div>
                    @endforeach

                </div>
                <div class="product-gallery-thumblist order-sm-1">
                    <a class="product-gallery-thumblist-item active" href="#first">
                        <img class="side-img" src="{{asset(env('DYNAMIC_PATH' , '').'products/'.$product->product_image)}}" alt="Product thumb">
                    </a>
                    @foreach ($product->ProductImages as $item)
                    <a class="product-gallery-thumblist-item" href="#img{{$item->id}}">
                        <img class="side-img" src="{{asset(env('DYNAMIC_PATH' , '').'products/dropzone/'. $item->image_url)}}" alt="Product thumb">
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Product details-->
        <div class="col-lg-5 pt-4 pt-lg-0 image-zoom-pane">
            <div class="product-details ms-auto pb-3">
                <div class="mb-2">
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
                    <span class="d-inline-block fs-sm text-body align-middle mt-1 ms-1">
                        @if ($product->reviews != null)
                            {{$product->reviews->count()}} Reviews
                        @endif
                            0 Reviews
                    </span>
                </div>
                <div class="h3 fw-normal text-accent mb-3 me-1">R {{$price}}<small>{{$fraction}}</small></div>
                <div class="position-relative me-n4 mb-3">
                    @if($product->getColors() != null)
                    @foreach ($product->getColors() as $key=>$item)
                        <div class="form-check form-option form-check-inline mb-2">
                            <input data-img="{{asset(env('DYNAMIC_PATH' , '')."products/".$item)}}"class="form-check-input rcolor" type="radio" name="color" id="color{{$key}}" data-bs-label="colorOptionText" value="{{$key}}">
                            <label class="form-option-label rounded-circle" for="color{{$key}}"><span class="form-option-color rounded-circle" style="background-color: {{$key}};"></span></label>
                        </div>
                    @endforeach
                    @endif

                    <div class="product-badge product-available mt-n1">
                        <i class="ci-security-check"></i>
                        Product available
                    </div>
                </div>
                <div class="d-flex align-items-center pt-2 pb-4">
                    <select class="form-select me-3" style="width: 5rem;">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <button class="btn btn-primary btn-shadow d-block w-100 add-to-cart" data-route="{{route('add-to-cart' , [$product->id])}}" type="button">
                        <i class="ci-cart fs-lg me-2"></i>Add to Cart
                    </button>

                </div>
                <div class="d-flex mb-4">
                    <div class="w-100 me-3">
                        @auth
                        <button class="btn btn-secondary d-block w-100 add-wishlist" type="button" data-route="{{route('add-to-wish' , $product->id)}}">
                            <i class="ci-heart fs-lg me-2"></i><span class='d-none d-sm-inline'>Add to </span>Wishlist</button>
                        @endauth
                    </div>
                </div>
                <h5 class="h6 mb-3 py-2 border-bottom"><i class="ci-announcement text-muted fs-lg align-middle mt-n1 me-2"></i>Product info</h5>
                <h6 class="fs-sm mb-2">General</h6>
                <ul class="fs-sm pb-2">
                    @if ($product->weight != "" || $product->weight != null)

                    <li>
                        <span class="text-muted">Weight: </span>{{$product->weight}}</li>
                    @endif
                    @if ($product->measuring_unit != "" || $product->measuring_unit != null)
                        <li><span class="text-muted">Measuring Unit: </span>{{$product->measuring_unit}}</li>
                    @endif
                </ul>
                <h6 class="fs-sm mb-2">Description</h6>
                <ul class="fs-sm pb-2">
                    {!!  $product->description !!}
                </ul>
            </div>
        </div>
    </div>
@endsection

<!-- End Modal -->
