 <!-- List of items-->
  <section class="col-lg-8">
    <div class="d-flex justify-content-between align-items-center pt-3 pb-4 pb-sm-5 mt-1">
      <h2 class="h6 text-light mb-0">Products</h2><a class="btn btn-outline-primary btn-sm ps-2" href="{{route('front.products')}}">
        <i class="ci-arrow-left me-2"></i>Continue shopping</a>
    </div>
    <!-- Item-->
    @foreach ($products as $item)
      <div id="productremove{{$item->id}}" class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
        <div class="d-block d-sm-flex align-items-center text-center text-sm-start">
            <a class="d-inline-block flex-shrink-0 mx-auto me-sm-4" href="{{ route('front.product' , $item->slug) }}">
                <img src="{{asset(env('DYNAMIC_PATH' , '').'products/'.$item->product_image)}}" width="160" alt="{{$item->name}}">
            </a>
          <div class="pt-2">
            <h3 class="product-title fs-base mb-2">
                <a href="{{ route('front.product' , $item->slug) }}">
                    {{$item->name}}
                </a>
            </h3>
            @if ($item->scolor != null || $item->scolor != '')

            <div class="fs-sm"><span class="text-muted me-2">Color:</span><span class="color" style="background:{{$item->scolor}}"></span></div>
            @endif
            <div class="fs-lg text-accent pt-2">R. {{$item->cprice}}</div>
          </div>
        </div>
        <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-start" style="max-width: 9rem;">
            <label class="form-label" for="quantity{{$item->id}}">Quantity</label>
            <input data-route="{{route('front.cart.change-quantity' , $item->id)}}" class="form-control quantity" type="number" id="quantity{{$item->id}}" min="1" value="{{$item->squantity}}">

            <button class="btn btn-link px-0 text-danger remove-product" type="button" data-route="{{route('front.product.remove' , $item->id)}}" data-remove="productremove{{$item->id}}">
                <i class="ci-close-circle me-2">
              </i>
              <span class="fs-sm">Remove</span>
            </button>
        </div>
      </div>
    @endforeach

  </section>
  <!-- Sidebar-->
  <aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
    <div class="bg-white rounded-3 shadow-lg p-4">
      <div class="py-2 px-xl-2">
        <div class="text-center mb-4 pb-3 border-bottom">
          <h2 class="h6 mb-3 pb-1">Subtotal</h2>
          <h3 class="fw-normal">R. <span id="total_price">{{$total}}</span></h3>
        </div>
        <a class="btn btn-primary btn-shadow d-block w-100 mt-4" href="{{route('front.checkout')}}"><i class="ci-card fs-lg me-2"></i>Proceed to Checkout</a>
      </div>
    </div>
  </aside>
