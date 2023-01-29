<div class="accordion-collapse collapse show" id="card"
     data-bs-parent="#payment-method">
    <div class="accordion-body">
        <p class="fs-sm">We accept following credit cards:&nbsp;&nbsp;
            <img class="d-inline-block align-middle" src="{{asset(env("PUBLIC_PATH" , '').'img/cards.png')}}" width="187"
                alt="Cerdit Cards"></p>
        <div class="credit-card-wrapper"></div>

        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>
        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>
    </div>
</div>

