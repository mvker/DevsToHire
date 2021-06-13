<!-- Edit Bid Popup
================================================== -->
<div id="small-dialog" class="zoom-anim-dialog mfp-hide dialog-with-tabs">
    <!--Tabs -->
    <div class="sign-in-form">
        <ul class="popup-tabs-nav">
            <li><a href="#tab">Edit Bid</a></li>
        </ul>
        <div class="popup-tabs-container">
            <!-- Tab -->
            <div class="popup-tab-content" id="tab">
                <!-- Bidding -->
                <div class="bidding-widget">
                    <!-- Headline -->
                    <span class="bidding-detail">Set your <strong>minimal hourly rate</strong></span>
                    <!-- Price Slider -->
                    <div class="bidding-value">$<span id="biddingVal"></span></div>
                    <input class="bidding-slider" type="text" value="" data-slider-handle="custom"
                           data-slider-currency="$" data-slider-min="10" data-slider-max="60" data-slider-value="40"
                           data-slider-step="1" data-slider-tooltip="hide"/>
                    <!-- Headline -->
                    <span class="bidding-detail margin-top-30">Set your <strong>delivery time</strong></span>
                    <!-- Fields -->
                    <div class="bidding-fields">
                        <div class="bidding-field">
                            <!-- Quantity Buttons -->
                            <div class="qtyButtons with-border">
                                <div class="qtyDec"></div>
                                <input type="text" name="qtyInput" value="2">
                                <div class="qtyInc"></div>
                            </div>
                        </div>
                        <div class="bidding-field">
                            <select class="selectpicker default with-border">
                                <option selected>Days</option>
                                <option>Hours</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Button -->
                <button class="button full-width button-sliding-icon ripple-effect" type="submit">Save Changes <i
                        class="icon-material-outline-arrow-right-alt"></i></button>
            </div>
        </div>
    </div>
</div>
<!-- Edit Bid Popup / End -->
