@extends('layouts.app')
@section('content')
    <!-- Page Title-->
    <div class="page-title-overlap bg-dark pt-4">
        <div class="container d-lg-flex justify-content-between py-2 py-lg-3">
            <div class="order-lg-2 mb-3 mb-lg-0 pt-lg-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-light flex-lg-nowrap justify-content-center justify-content-lg-start">
                        <li class="breadcrumb-item">
                            <a class="text-nowrap" href="{{route('front.index')}}">
                                <i class="ci-home"></i>Home
                            </a>
                        </li>
                        <li class="breadcrumb-item text-nowrap">
                            <a href="{{route('front.products')}}">Shop</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
            <div class="order-lg-1 pe-lg-4 text-center text-lg-start">
                <h1 class="h3 text-light mb-0">Checkout</h1>
            </div>
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4">
        <div class="row">
            <section class="col-lg-8">
                <!-- Steps-->
                <form action="{{route('user.checkout')}}" method="post" class="cform">
                    @csrf
                    <input type="hidden" id="stripe_key" value="{{env('STRIPE_KEY')}}">
                    <input type="hidden" id="stripeToken" name="stripeToken" >
                    <div class="steps steps-light pt-2 pb-3 mb-5">
                        <ul class="nav nav-tabs w-100" role="tablist">
                            <li class="step-item">
                                <a role="tab" id="details-tab" aria-controls="home" data-bs-toggle="tab" class="step-item active"
                                    href="#details">
                                    <div class="step-progress"><span class="step-count">1</span></div>
                                    <div class="step-label"><i class="ci-user-circle"></i>Details</div>
                                </a>
                            </li>
                            <li class="step-item">
                                <a role="tab" id="payment-tab" aria-controls="home" data-bs-toggle="tab" class="step-item"
                                    href="#payment">
                                    <div class="step-progress"><span class="step-count">2</span></div>
                                    <div class="step-label"><i class="ci-card"></i>Payment</div>
                                </a>
                            </li>
                            <li class="step-item">
                                <a role="tab"id="review-tab" aria-controls="home" data-bs-toggle="tab" class="step-item"
                                    href="#review">
                                    <div class="step-progress"><span class="step-count">3</span></div>
                                    <div class="step-label"><i class="ci-check-circle"></i>Review</div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Payment methods accordion-->
                    <div class="tab-content">
                        @include('checkout.details')
                        @include('checkout.payment')
                        @include('checkout.review')
                    </div>
                    <input type="hidden" name="total" value="{{$total}}">
                </form>
            </section>
            <!-- Sidebar-->
                @include('checkout.order-summary')
        </div>
        <!-- Navigation (mobile)-->
        <div class="row d-lg-none">
            <div class="col-lg-8">
                <div class="d-flex pt-4 mt-3">
                    <div class="w-50 pe-3">
                        <a class="btn btn-secondary d-block w-100" href="checkout-shipping.html">
                            <i class="ci-arrow-left mt-sm-0 me-1"></i>
                            <span class="d-none d-sm-inline">Back to Shipping</span>
                            <span class="d-inline d-sm-none">Back</span>
                        </a>
                    </div>
                    <div class="w-50 ps-2">
                        <a class="btn btn-primary d-block w-100" href="checkout-review.html">
                            <span class="d-none d-sm-inline">Review your order</span>
                            <span class="d-inline d-sm-none">Review order</span>
                            <i class="ci-arrow-right mt-sm-0 ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://js.stripe.com/v3/"></script>
@section('scripts')
    <script>

        $(document).on('click', '.payment', function() {
            if ($(this).is(":checked")) {
                if ($(this).val() != "paypal") {
                    $(".cform").addClass("require-validation");
                    $(".cform").attr("data-cc-on-file" , false);
                    $(".cform").attr("data-stripe-publishable-key" , '{{ env('STRIPE_KEY') }}');
                    $(".cform").attr("id" , 'payment-form');

                    $('.stripe').show();
                } else {
                    $(".cform").removeClass("require-validation");
                    $(".cform").removeAttr("data-cc-on-file");
                    $(".cform").removeAttr("data-stripe-publishable-key");
                    $(".cform").removeAttr("id");
                    $('.stripe').hide();
                }
            }
        })
        $(document).on('change' , '#checkout-state' , function(){
            var id = $(this).val();
            var url = $(this).data('url')+"/"+id;
            $.get(url , function(res){
                $('#checkout-city').html(res);
            })
        } )
    </script>
@endsection
