<div id="details" class="tab-pane active">
    <!-- Autor info-->
    <div
        class="d-sm-flex justify-content-between align-items-center bg-secondary p-4 rounded-3 mb-grid-gutter">
        <div class="d-flex align-items-center">
            <div class="img-thumbnail rounded-circle position-relative flex-shrink-0"><span
                    class="badge bg-warning position-absolute end-0 mt-n2" data-bs-toggle="tooltip"
                    title="Reward points">384</span>
                <img class="rounded-circle"
                    src="{{asset(env("PUBLIC_PATH" , "").'img/avatar.png')}}" width="90" alt="{{Auth::user()->name}}"></div>
            <div class="ps-3">
                <h3 class="fs-base mb-0">{{ Auth::user()->first_name }}</h3><span
                    class="text-accent fs-sm">
                    {{ Auth::user()->email }}
                </span>
            </div>
        </div>
        <a class="btn btn-light btn-sm btn-shadow mt-3 mt-sm-0" href="{{route('user.profile')}}">
            <i class="ci-edit me-2"></i>
            Edit profile
        </a>
    </div>
    <!-- Shipping address-->
    <h2 class="h6 pt-1 pb-3 mb-3 border-bottom">Shipping address</h2>
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label" for="checkout-fn">First Name</label>
                <input class="form-control" name="" type="text" id="checkout-fn" name="checkout_fname"
                    value="{{ Auth::user()->first_name }}">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label" for="checkout-ln">Last Name</label>
                <input class="form-control" type="text" id="checkout-ln" name="checkout_lname"
                    value="{{ Auth::user()->last_name }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label" for="checkout-email">E-mail Address</label>
                <input class="form-control" type="email" id="checkout-email" name="checkout_email"
                    value="{{ Auth::user()->email }}">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label" for="checkout-phone">Phone Number</label>
                <input class="form-control" type="text" id="checkout-phone" name="checkout_phone"
                    value="{{ Auth::user()->mobile_number }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label" for="checkout-state">State</label>
                <select data-url="{{ route('front.state.cities') }}" class="form-select" id="checkout-state" name="checkout_state_id">
                    <option value="">----</option>
                    @foreach (App\Models\State::get() as $item)
                        <option @if (Auth::user()->state_id == $item->id) selected @endif
                            value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">

                <label class="form-label" for="checkout-city">City</label>
                @if (Auth::user()->city_id != "")
                    <select class="form-select" id="checkout-city" name="checkout_city_id">
                        <option value="">----</option>
                        @foreach (App\Models\City::whereStateId(Auth::user()->state_id)->get() as $item)
                            <option @if (Auth::user()->city_id == $item->id) selected @endif
                                value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                @else
                    <select class="form-select" id="checkout-city" name="checkout_city_id">
                        <option value="">Select State First</option>
                    </select>
                @endif
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label" for="checkout-zip">ZIP Code</label>
                <input class="form-control" value="{{Auth::user()->post_code}}" type="text" id="checkout-zip" name="checkout_zip_code">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label" for="checkout-address-1">Address 1</label>
                <input class="form-control" type="text" id="checkout-address-1"
                    value="{{ Auth::user()->address }}" name="checkout_address">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="mb-3">
                <label class="form-label" for="checkout-address-2">Address 2</label>
                <input class="form-control" type="text" id="checkout-address-2" name="checkout_address_two">
            </div>
        </div>
    </div>
    <!-- Navigation (desktop)-->
    <div class="d-none d-lg-flex pt-4 mt-3">
        <div class="w-50 pe-3">
            <a class="btn btn-secondary d-block w-100" href="{{ route('front.cart') }}">
                <i class="ci-arrow-left mt-sm-0 me-1"></i>
                <span class="d-none d-sm-inline">Back to Cart</span>
                <span class="d-inline d-sm-none">Back</span>
            </a>
        </div>
        <div class="w-50 ps-2">
            <a data-tab="#payment-tab" class="btn btn-primary d-block w-100 tab-btns">
                <span class="d-none d-sm-inline">Proceed to Payment</span>
                <span class="d-inline d-sm-none">Next</span>
                <i class="ci-arrow-right mt-sm-0 ms-1"></i>
            </a>
        </div>
    </div>

</div>
