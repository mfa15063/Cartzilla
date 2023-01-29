<div class="modal-header">
    <h5 class="modal-title">Order No - {{$order->order_number}}</h5>
    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

    <div class="modal-body pb-0">
    <!-- Item-->
        @foreach ($order->items as $item)
            <div class="d-sm-flex justify-content-between mb-4 pb-3 pb-sm-2 border-bottom">
                <div class="d-sm-flex text-center text-sm-start">
                    <a class="d-inline-block flex-shrink-0 mx-auto" href="" style="width: 10rem;">
                        <img src="{{asset(env('DYNAMIC_PATH' , '').'products/'.$item->product->product_image)}}" alt="Product">
                    </a>
                <div class="ps-sm-4 pt-2">
                    <h3 class="product-title fs-base mb-2">
                        <a href="{{route('front.product' , $item->product->slug)}}">{{$item->product->name}}</a></h3>
                    @if ($item->color != "")
                    <div class="fs-sm"><span class="text-muted me-2">Color:</span>
                        <span style="width: 50px;height:50px;background:{{$item->color}};border-radiud:50px;" ></span>
                    </div>
                    @endif
                    <div class="fs-lg text-accent pt-2">{{$item->product_price}}</div>
                </div>
                </div>
                <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                <div class="text-muted mb-2">Quantity:</div>{{$item->quantity}}
                </div>
                <div class="pt-2 ps-sm-3 mx-auto mx-sm-0 text-center">
                <div class="text-muted mb-2">Subtotal</div>R. {{$item->quantity}} * {{$item->product_price}}</small>
                </div>
        </div>
        @endforeach
    </div>
<div class="modal-footer flex-wrap justify-content-between bg-secondary fs-md">
    <div class="px-2 py-1">
        <span class="text-muted">Total:&nbsp;</span>
        <span class="fs-lg">Rs{{$order->amount}}</small></span>
    </div>
  </div>
