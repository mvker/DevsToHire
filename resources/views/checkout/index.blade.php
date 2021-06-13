@extends('layouts.app')
@section('content')
    <!-- Wrapper -->
    <div id="wrapper">
        <!-- Titlebar  -->
        <div id="titlebar" class="gradient">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2>Checkout</h2>
                        <!-- Breadcrumbs -->
                        <nav id="breadcrumbs" class="dark">
                            <ul>
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Pricing Plans</a></li>
                                <li>Checkout</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <!-- Container -->
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-8 content-right-offset">
                    <!-- Headline -->
                    <h3>Billing Cycle</h3>
                    <!-- Billing Cycle Radios  -->
                    <div class="billing-cycle margin-top-25">
                        <!-- Radio -->
                        <div class="radio">
                            <input id="radio-5" name="radio-payment-type" type="radio" checked>
                            <label for="radio-5">
                                <span class="radio-label"></span>
                                Billed Monthly
                                <span class="billing-cycle-details">
							<span class="regular-price-tag">$49.00 / month</span>
						</span>
                            </label>
                        </div>
                        <!-- Radio -->
                        <div class="radio">
                            <input id="radio-6" name="radio-payment-type" type="radio">
                            <label for="radio-6"><span class="radio-label"></span>
                                Billed Yearly
                                <span class="billing-cycle-details">
							<span class="discounted-price-tag">$529.20 / year</span>
							<span class="regular-price-tag line-through">588.00 / year</span>
						</span>
                            </label>
                        </div>
                    </div>
                    <!-- Headline -->
                    <h3 class="margin-top-50">Payment Method</h3>

                    @include('layouts.checkout.paymentAccordion')

                    <a href="pages-order-confirmation.html"
                       class="button big ripple-effect margin-top-40 margin-bottom-65">Proceed Payment</a>
                </div>
                <!-- Summary -->
                <div class="col-xl-4 col-lg-4 margin-top-0 margin-bottom-60">

                    <!-- Summary -->
                    <div class="boxed-widget summary margin-top-0">
                        <div class="boxed-widget-headline">
                            <h3>Summary</h3>
                        </div>
                        <div class="boxed-widget-inner">
                            <ul>
                                <li>Standard Plan <span>$49.00</span></li>
                                <li>VAT (20%) <span>$9.80</span></li>
                                <li class="total-costs">Final Price <span>$58.80</span></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Summary / End -->

                    <!-- Checkbox -->
                    <div class="checkbox margin-top-30">
                        <input type="checkbox" id="two-step">
                        <label for="two-step"><span class="checkbox-icon"></span> I agree to the <a href="#">Terms and
                                Conditions</a> and the <a href="#">Automatic Renewal Terms</a></label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container / End -->
    </div>
    <!-- Wrapper / End -->
@endsection