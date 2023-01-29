<div class="tab-pane fade show active" id="general" role="tabpanel">
    <div class="row">
      <!-- Product gallery-->
      <div class="col-lg-7 pe-lg-0">
        <div class="product-gallery">
          <div class="product-gallery-preview order-sm-2">
            <div class="product-gallery-preview-item active" id="main">
              <img class="image-zoom" src="{{asset(env('DYNAMIC_PATH' , '').'products/'.$product->product_image)}}" data-zoom="{{asset(env('DYNAMIC_PATH' , '').'products/'.$product->product_image)}}" alt="{{$product->name}}">
              <div class="image-zoom-pane"></div>
            </div>
            @foreach ($product->ProductImages as $key=>$item)
            <div class="product-gallery-preview-item" id="first{{$item->id}}">
              <img class="image-zoom" src="{{asset(env('DYNAMIC_PATH' , '').'products/dropzone/'. $item->image_url)}}" data-zoom="{{asset(env('DYNAMIC_PATH' , '').'products/dropzone/'. $item->image_url)}}" alt="{{$product->name}}">
              <div class="image-zoom-pane"></div>
            </div>
            @endforeach
          </div>
          <div class="product-gallery-thumblist order-sm-1">
            <a class="product-gallery-thumblist-item active" href="#main">
              <img class="side-img" src="{{asset(env('DYNAMIC_PATH' , '').'products/'.$product->product_image)}}" alt="{{$product->name}}">
            </a>
            @foreach ($product->ProductImages as $key=>$item)
            <a class="product-gallery-thumblist-item active" href="#first{{$item->id}}">
              <img class="side-img" src="{{asset(env('DYNAMIC_PATH' , '').'products/dropzone/'. $item->image_url)}}" alt="{{$product->name}}">
            </a>
            @endforeach
          </div>
        </div>
      </div>
      <!-- Product details-->

        <div class="col-lg-5 pt-4 pt-lg-0">
          <div class="product-details ms-auto pb-3">
            <div class="h3 fw-normal text-accent mb-3 me-1"><small>R. {{$product->getPrice()}} {{$product->getFraction()}}</small></div>
            <div class="fs-sm mb-4">
            </div>
            <div class="position-relative me-n4 mb-3">
              @if($product->getColors() != null)
              @foreach ($product->getColors() as $key=>$item)
                  <div class="form-check form-option form-check-inline mb-2">
                      <input data-img="{{asset(env('PUBLIC_PATH' , '')."products/".$item)}}"class="form-check-input rcolor" type="radio" name="color" id="color{{$key}}" data-bs-label="colorOptionText" value="{{$key}}">
                      <label class="form-option-label rounded-circle" for="color{{$key}}"><span class="form-option-color rounded-circle" style="background-color: {{$key}};"></span></label>
                  </div>
              @endforeach
              @endif
              <input type="hidden" id="scolor">
              @if($product->in_stock > 0)
                <div class="product-badge product-available mt-n1"><i class="ci-security-check"></i>Product available</div>
              @endif
            </div>
            <div class="d-flex align-items-center pt-2 pb-4">
              <select class="form-select me-3" id="quantity" name="quantity" style="width: 5rem;">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
              <button class="btn btn-primary btn-shadow d-block w-100 add-to-cart" data-route="{{route('add-to-cart' , [$product->id])}}" type="button" >
                <i class="ci-cart fs-lg me-2"></i>
                Add to Cart
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
            <!-- Sharing-->
          </div>
        </div>
    </div>
  </div>
