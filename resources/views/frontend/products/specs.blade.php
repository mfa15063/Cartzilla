<div class="tab-pane fade" id="specs" role="tabpanel">
    <div class="d-md-flex justify-content-between align-items-start pb-4 mb-4 border-bottom">
      <div class="d-flex align-items-center me-md-3">
        <img src="{{asset(env('DYNAMIC_PATH' , '').'products/'.$product->product_image)}}" alt="{{$product->name}}" width="90" >
        <div class="ps-3">
          <h6 class="fs-base mb-2">{{$product->name}}</h6>
          <div class="h4 fw-normal text-accent">Rs {{$product->getPrice()}}<small>{{$product->getFraction()}}</small></div>
        </div>
      </div>
      <div class="d-flex align-items-center pt-3">
        <select class="form-select me-2" style="width: 5rem;">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
        </select>
        <button class="btn btn-primary btn-shadow me-2" type="button">
          <i class="ci-cart fs-lg me-sm-2"></i><span class="d-none d-sm-inline">Add to Cart</span></button>
        <div class="me-2">
            @auth
                <button class="btn btn-secondary btn-icon add-wishlist" data-route="{{route('add-to-wish' , $product->id)}}" type="button" data-bs-toggle="tooltip" title="Add to Wishlist">
                    <i class="ci-heart fs-lg">
                    </i>
                </button>
            @endauth
        </div>
      </div>
    </div>
    <!-- Specs table-->
    <div class="row pt-2">
      <div class="col-lg-5 col-sm-6">
        <h3 class="h6">General specs</h3>
        <ul class="list-unstyled fs-sm pb-2">
          @if ($product->weight != null)

          <li class="d-flex justify-content-between pb-2 border-bottom">
            <span class="text-muted">Weight:</span><span>
            {{$product->weight}}</span></li>
          @endif
          @if ($product->measuring_unit != null)

          <li class="d-flex justify-content-between pb-2 border-bottom">
            <span class="text-muted">Unit:</span><span>
            {{$product->measuring_unit}}</span></li>
          @endif
        </ul>
      </div>
    </div>
  </div>
