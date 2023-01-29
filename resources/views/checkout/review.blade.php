<div id="review" class="tab-pane fade">
    <h2 class="h6 pt-1 pb-3 mb-3 border-bottom">Review your order</h2>
    <!-- Item-->
    @foreach ($products as $item)
        <div class="d-sm-flex justify-content-between my-4 pb-3 border-bottom">
            <div class="d-sm-flex text-center text-sm-start"><a
                    class="d-inline-block flex-shrink-0 mx-auto me-sm-4"
                    href="{{route('front.product' , $item->slug)}}">
                    <img src="{{ asset(env('DYNAMIC_PATH' , '').'products/' . $item->product_image) }}" width="160"
                        alt="{{ $item->name }}"></a>
                <div class="pt-2">
                    <h3 class="product-title fs-base mb-2"><a
                            href="{{route('front.product' , $item->slug)}}">{{ $item->name }}</a></h3>
                    @if ($item->scolor != '')
                        <div class="fs-sm"><span class="text-muted me-2">Color:</span>
                            <div
                                style="width:50px;height:50px border-radiud:50%;background:{{ $item->solor }}">
                            </div>
                        </div>
                    @endif
                    <div class="fs-lg text-accent pt-2">Rs
                        {{ $item->getPrice() }}<small>{{ $item->getFraction() }}</small></div>
                </div>
            </div>
            <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-end"
                style="max-width: 9rem;">
                <p class="mb-0">
                    <span class="text-muted fs-sm">Quantity:</span><span>&nbsp;{{$item->squantity}}</span>
                </p>
            </div>

        </div>
    @endforeach


    <div class="mb-3 mb-4">
        <label class="form-label mb-3" for="order-comments">
          <span class="badge bg-info fs-xs me-2">Note</span>
          <span class="fw-medium">Additional comments</span>
        </label>
        <textarea class="form-control" name="notes" rows="6" id="order-comments"></textarea>
      </div>

    <div class="d-none d-lg-flex pt-4">
        <div class="w-50 pe-3">
            <a data-tab="#payment-tab"
                class="btn btn-secondary d-block w-100 tab-btns">
                <i class="ci-arrow-left mt-sm-0 me-1"></i>
                <span class="d-none d-sm-inline">Back to Payment</span>
                <span class="d-inline d-sm-none">Back</span>
            </a>
        </div>
        <div class="w-50 ps-2">
            <button type="submit" class="btn btn-primary d-block w-100">
                <span class="d-none d-sm-inline">Complete order</span>
                <span class="d-inline d-sm-none">Complete</span>
                <i class="ci-arrow-right mt-sm-0 ms-1"></i>
            </button>
        </div>
    </div>
</div>
