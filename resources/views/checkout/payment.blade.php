<div id="payment" class="tab-pane fade">
    <h2 class="h6 pb-3 mb-2">Choose payment method</h2>
    <div class="accordion mb-2" id="payment-method">
        <div class="form-group">
            <input id="paypal" checked type="radio" class="form-check-input payment" value="paypal"
                name="payment_method">
            <label for="paypal" class="form-option-label">
                <span class="form-option">Paypal</span>
            </label>
        </div>
        <div class="form-group">
            <input id="stripe" type="radio" class="form-check-input payment" value="stripe"
                name="payment_method">
            <label for="stripe" class="form-option-label">
                <span class="form-option">Credit Card</span>
            </label>
        </div>
        <div class="accordion-item stripe mt-3" style="display: none">
            <h3 class="accordion-header">
                <a class="accordion-button" href="#card"
                    data-bs-toggle="collapse">
                    <i class="ci-card fs-lg me-2 mt-n1 align-middle"></i>
                        Pay with Credit Card
                </a>
            </h3>
            <x-stripe></x-stripe>
        </div>

    </div>
    <!-- Navigation (desktop)-->
    <div class="d-none d-lg-flex pt-4">
        <div class="w-50 pe-3">
            <a  data-tab="#details-tab"
                class="btn btn-secondary d-block w-100 tab-btns">
                <i class="ci-arrow-left mt-sm-0 me-1"></i><span
                    class="d-none d-sm-inline">
                    Back to Details
                </span><span class="d-inline d-sm-none">Back</span>
            </a>
        </div>
        <div class="w-50 ps-2">
            <a data-tab="#review-tab" class="btn btn-primary d-block w-100 tab-btnss">
                <span class="d-none d-sm-inline">Review your order</span>
                <span class="d-inline d-sm-none">Review order</span>
                <i class="ci-arrow-right mt-sm-0 ms-1"></i>
            </a>
        </div>
    </div>
</div>
