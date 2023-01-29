<aside class="col-lg-4 pt-4 pt-lg-0 ps-xl-5">
                <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                    <div class="py-2 px-xl-2">
                        <div class="widget mb-3">
                            <h2 class="widget-title text-center">Order summary</h2>
                            @foreach ($products as $item)
                                <div class="d-flex align-items-center pb-2 border-bottom">
                                    <a class="d-block flex-shrink-0" href="{{ route('front.product', $item->slug) }}">
                                        <img src="{{ asset(env('DYNAMIC_PATH' , '').'products/' . $item->product_image) }}" width="64"
                                            alt="{{ $item->name }}"></a>
                                    <div class="ps-2">
                                        <h6 class="widget-product-title">
                                            <a href="{{route('front.product' , $item->slug)}}">
                                                {{ $item->name }}
                                            </a>
                                        </h6>
                                        <div class="widget-product-meta"><span
                                                class="text-accent me-2">R.{{ $item->getPrice() }}<small>{{ $item->getFraction() }}</small>
                                            </span><span class="text-muted">x {{ $item->squantity }}</span></div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <h3 class="fw-normal text-center my-4">R. {{ $total }}</h3>

                    </div>
                </div>
            </aside>
