<footer class="footer bg-dark pt-5">
    <div class="container">
        <div class="row pb-2">
            <div class="col-md-6 col-sm-6">
                <div class="widget widget-links widget-light pb-2 mb-4">
                    <h3 class="widget-title text-light">Shop departments</h3>
                    <ul class="widget-list">
                        @foreach ($categories as $item)
                        <li class="widget-list-item">
                            <a class="widget-list-link" href="{{ route('front.products' , $item->slug) }}">{{ $item->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="widget widget-links widget-light pb-2 mb-4">
                    <h3 class="widget-title text-light">Account &amp; shipping info</h3>
                    <ul class="widget-list">
                        <li class="widget-list-item"><a class="widget-list-link" href="{{ route('user.profile') }}">Your account</a></li>
                        <li class="widget-list-item"><a class="widget-list-link" href="{{ route('front.returns') }}">Refunds &amp; replacements</a></li>
                        <li class="widget-list-item"><a class="widget-list-link" href="{{ route('user.orders') }}">Order tracking</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="pt-5 bg-darker">
        <div class="container">
            <div class="row pb-3">
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="d-flex"><i class="ci-rocket text-primary" style="font-size: 2.25rem;"></i>
                        <div class="ps-3">
                            <h6 class="fs-base text-light mb-1">Fast and free delivery</h6>
                            <p class="mb-0 fs-ms text-light opacity-50">Free delivery for all orders over $200</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="d-flex"><i class="ci-currency-exchange text-primary" style="font-size: 2.25rem;"></i>
                        <div class="ps-3">
                            <h6 class="fs-base text-light mb-1">Money back guarantee</h6>
                            <p class="mb-0 fs-ms text-light opacity-50">We return money within 30 days</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="d-flex"><i class="ci-support text-primary" style="font-size: 2.25rem;"></i>
                        <div class="ps-3">
                            <h6 class="fs-base text-light mb-1">24/7 customer support</h6>
                            <p class="mb-0 fs-ms text-light opacity-50">Friendly 24/7 customer support</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="d-flex"><i class="ci-card text-primary" style="font-size: 2.25rem;"></i>
                        <div class="ps-3">
                            <h6 class="fs-base text-light mb-1">Secure online payment</h6>
                            <p class="mb-0 fs-ms text-light opacity-50">We possess SSL / Secure сertificate</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="hr-light mb-5">
            <div class="row pb-2">
                <div class="col-md-6 text-center text-md-start mb-4">
                    <div class="widget widget-links widget-light">
                        <ul class="widget-list d-flex flex-wrap justify-content-center justify-content-md-start">
                            <li class="widget-list-item me-4"><a class="widget-list-link" href="{{ route('front.privacy-policy') }}">Privacy</a></li>
                            <li class="widget-list-item me-4"><a class="widget-list-link" href="{{ route('front.terms') }}">Terms And Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-end mb-4">
                    <div class="mb-3">
                        <a class="btn-social bs-light bs-twitter ms-2 mb-2" href="{!! getSetting('twitter_account') !!}">
                            <i class="ci-twitter"></i>
                        </a>
                        <a class="btn-social bs-light bs-facebook ms-2 mb-2" href="{!! getSetting('facebook_account') !!}">
                            <i class="ci-facebook"></i>
                        </a>
                        <a class="btn-social bs-light bs-instagram ms-2 mb-2" href="{!! getSetting('instagram_account') !!}">
                            <i class="ci-instagram"></i>
                        </a>
                    </div>
                    <img class="d-inline-block" src="{{asset(env('PUBLIC_PATH' , '').'img/cards-alt.png') }}" width="187" alt="Payment methods">
                </div>
            </div>
            <div class="pb-4 fs-xs text-light opacity-50 text-center text-md-start">
                {!! getSetting('copyrights') !!}
            </div>
        </div>
    </div>
</footer>
