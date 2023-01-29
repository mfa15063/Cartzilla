<div class="tab-pane fade" id="reviews" role="tabpanel">
    <div class="d-md-flex justify-content-between align-items-start pb-4 mb-4 border-bottom">
      <div class="d-flex align-items-center me-md-3">
        <img src="{{asset(env('DYNAMIC_PATH' , '').'products/'.$product->product_image)}}" alt="{{$product->name}}" width="90">
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
        <button class="btn btn-primary btn-shadow me-2" type="button"><i class="ci-cart fs-lg me-sm-2"></i><span class="d-none d-sm-inline">Add to Cart</span></button>
        <div class="me-2">
            @auth
                <button class="btn btn-secondary btn-icon add-wishlist" data-route="{{route('add-to-wish' , $product->id)}}" type="button" data-bs-toggle="tooltip" title="Add to Wishlist">
                    <i class="ci-heart fs-lg">
                    </i>
                </button>
            @endauth
        </div>
        <div>
          <button class="btn btn-secondary btn-icon" type="button" data-bs-toggle="tooltip" title="Compare"><i class="ci-compare fs-lg"></i></button>
        </div>
      </div>
    </div>
    <!-- Reviews-->
    <div class="row pt-2 pb-3">
      <div class="col-lg-4 col-md-5">
        <h2 class="h3 mb-4">
          {{$product->reviews->count()}} Reviews
        </h2>
          <div class="star-rating">
              <div class="empty-stars empty-stars-nw"></div>
              <div class="full-stars azfull empty-stars-nw" style="width:{{$product->rating()}}%"></div>
          </div>
        <span class="d-inline-block align-middle">{{ $product->rating() }} Overall rating</span>
      </div>
      <div class="col-lg-8 col-md-7">
        <div class="d-flex align-items-center mb-2">
          <div class="text-nowrap me-3">
            <span class="d-inline-block align-middle text-muted">5</span>
            <i class="ci-star-filled fs-xs ms-1"></i></div>
          <div class="w-100">
            <div class="progress" style="height: 4px;">

              <div class="progress-bar bg-success" role="progressbar" style="width: {{$product->ratingperc(5)}}%;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
              </div>
            </div>
          </div><span class="text-muted ms-3">{{$product->recommend(5)}}</span>
        </div>
        <div class="d-flex align-items-center mb-2">
          <div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">4</span><i class="ci-star-filled fs-xs ms-1"></i></div>
          <div class="w-100">
            <div class="progress" style="height: 4px;">
              <div class="progress-bar" role="progressbar" style="width: {{$product->ratingperc(4)}}%; background-color: #a7e453;" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div><span class="text-muted ms-3">{{$product->recommend(4)}}</span>
        </div>
        <div class="d-flex align-items-center mb-2">
          <div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">3</span><i class="ci-star-filled fs-xs ms-1"></i></div>
          <div class="w-100">
            <div class="progress" style="height: 4px;">
              <div class="progress-bar" role="progressbar" style="width: {{$product->ratingperc(3)}}%; background-color: #ffda75;" aria-valuenow="17" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div><span class="text-muted ms-3">{{$product->recommend(3)}}</span>
        </div>
        <div class="d-flex align-items-center mb-2">
          <div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">2</span><i class="ci-star-filled fs-xs ms-1"></i></div>
          <div class="w-100">
            <div class="progress" style="height: 4px;">
              <div class="progress-bar" role="progressbar" style="width: {{$product->ratingperc(2)}}%; background-color: #fea569;" aria-valuenow="9" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div><span class="text-muted ms-3">{{$product->recommend(2)}}</span>
        </div>
        <div class="d-flex align-items-center">
          <div class="text-nowrap me-3"><span class="d-inline-block align-middle text-muted">1</span><i class="ci-star-filled fs-xs ms-1"></i></div>
          <div class="w-100">
            <div class="progress" style="height: 4px;">
              <div class="progress-bar bg-danger" role="progressbar" style="width: {{$product->ratingperc(1)}}%;" aria-valuenow="4" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div><span class="text-muted ms-3">{{$product->recommend(1)}}</span>
        </div>
      </div>
    </div>
    <hr class="mt-4 mb-3">
    <div class="row py-4">
      <!-- Reviews list-->
      <div class="col-md-7">

        <!-- Review-->
        @foreach ($product->reviews as $item)
        <div class="product-review pb-4 mb-4 border-bottom">
          <div class="d-flex mb-3">
            <div class="d-flex align-items-center me-4 pe-2">
              <img class="rounded-circle" src="{{asset(env('PUBLIC_PATH' , '').'img/avatar.png') }}" width="50" alt="{{$item->user->first_name ." ".$item->user->last_name}}">
              <div class="ps-3">
                <h6 class="fs-sm mb-0">{{$item->user->first_name ." ".$item->user->last_name}}</h6><span class="fs-ms text-muted">{{$item->created_at}}</span>
              </div>
            </div>
            <div>
            </div>
          </div>
          <p class="fs-md mb-2">
            {{$item->review}}
          </p>
        </div>
        @endforeach

      </div>
      <!-- Leave review form-->
      @auth
          @if (Auth::user()->is_product($product->id))
          <div class="col-md-5 mt-2 pt-4 mt-md-0 pt-md-0">
            <div class="bg-secondary py-grid-gutter px-grid-gutter rounded-3">
              <h3 class="h4 pb-2">Write a review</h3>
              <form class="needs-validation form" method="post" novalidate action="{{route('add-review')}}">
               @csrf
                <div class="mb-3">
                  <input type="hidden" name="product_id" value="{{$product->id}}">
                  <label class="form-label" for="review-rating">Rating<span class="text-danger">*</span></label>
                  <select class="form-select" name="rating" required id="review-rating">
                    <option value="">Choose rating</option>
                    <option value="5">5 stars</option>
                    <option value="4">4 stars</option>
                    <option value="3">3 stars</option>
                    <option value="2">2 stars</option>
                    <option value="1">1 star</option>
                  </select>
                  <div class="invalid-feedback">Please choose rating!</div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="review-text">Review<span class="text-danger">*</span></label>
                  <textarea class="form-control" rows="6" name="review" required id="review-text"></textarea>
                  <div class="invalid-feedback">Please write a review!</div><small class="form-text text-muted">Your review must be at least 50 characters.</small>
                </div>
                <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Submit a Review</button>
              </form>
            </div>
          </div>
          @endif
      @endauth

    </div>
  </div>
