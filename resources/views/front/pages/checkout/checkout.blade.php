@extends('front.layouts.master')
@section('title', isset($title) ? $title : 'Home')
@section('description', isset($description) ? $description : '')
@section('keywords', isset($keywords) ? $keywords : '')
@section('content')
    <!-- breadcrumb area start here  -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-wrap text-center">
                <h2 class="page-title">{{ __('Checkout') }}</h2>
                <ul class="breadcrumb-pages">
                    <li class="page-item"><a class="page-item-link" href="{{ route('front') }}">{{ __('Home') }}</a>
                    </li>
                    <li class="page-item">{{ __('Checkout') }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end here  -->

    <!-- checkout page area start here  -->
    <section class="page-content section">
        <div class="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout-form">
                            <form method="post" {{-- action="{{ auth()->check() ? route('checkout.order') : route('guest.checkout.order') }}" --}} action="{{ route('checkout.order') }}"
                                id="paymentForm">
                                @csrf
                                <div class="row">
                                    @if (!auth()->check())
                                        <div class="col-lg-12 mb-3">
                                            <div
                                                class="checkout-page-login-box d-flex justify-content-between align-items-center mb-30">
                                                <h2 class="mb-0 text-capitalize fw-bold">{{ __('Returning buyer? Please login') }}</h2>
                                                <button type="button" class="primary-btn" data-bs-toggle="modal"
                                                    data-bs-target="#loginModal">{{ __('Login') }}</button>
                                            </div>
                                        </div>
                                    @endif

                                    {{-- <div class="col-lg-12">
                                        <h2 class="checkout-title">{{ __('Billing Address') }}</h2>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="billing_name" name="billing_name"
                                                placeholder="{{ __('You Name Here') }}"
                                                value="{{ isset($billing) ? $billing->Name ?? $billing->name : '' }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="billing_email"
                                                name="billing_email" placeholder="{{ __('Email Address') }}"
                                                value="{{ isset($billing) ? $billing->Email ?? $billing->email : '' }}"
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="billing_street_address"
                                                name="billing_street_address" placeholder="{{ __('Street Address') }}"
                                                value="{{ isset($billing) ? $billing->Street : '' }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="billing_state"
                                                name="billing_state" placeholder="{{ __('State') }}"
                                                value="{{ isset($billing) ? $billing->State : '' }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="billing_zipcode"
                                                name="billing_zipcode" placeholder="{{ __('Zip/Postal Code') }}"
                                                value="{{ isset($billing) ? $billing->Zipcode : '' }}" required />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <select class="form-select" id="billing_country" name="billing_country" required>
                                            <option>{{ __('Country') }}</option>
                                            @foreach (country() as $cnt)
                                                <option value="{{ $cnt }}"
                                                    {{ isset($billing) && $billing->Country == $cnt ? 'selected' : '' }}>
                                                    {{ $cnt }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
                                </div>

                                <div class="pt-5"></div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <h2 class="checkout-title">{{ __('Shipping Address') }}</h2>
                                    </div>

                                    <div class="pt-2"></div>

                                    {{-- @if ($shipping)
                                        <div class="">
                                            <input type="checkbox" class="form-check-input" id="same"
                                                onchange="fillInput()" />
                                            <label class="form-check-label"
                                                for="same">{{ __('Use the same address as before') }}
                                            </label>
                                        </div>
                                    @endif --}}

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="shipping_name"
                                                name="shipping_name" placeholder="{{ __('Your Name Here') }}"
                                                {{-- value="{{ $shipping?->Name }}" --}} data-value="{{ $shipping?->Name }}" />
                                            @error('shipping_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="shipping_email"
                                                name="shipping_email" placeholder="{{ __('Email Address') }}"
                                                {{-- value="{{ $shipping?->Email }}" --}} data-value="{{ $shipping?->Email }}" />
                                            @error('shipping_email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="shipping_number"
                                                name="shipping_number" placeholder="{{ __('Phone') }}"
                                                value="{{ Auth::user()?->Number }}"
                                                data-value="{{ $shipping?->Number }}" />
                                            @error('shipping_email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6 mb-4">
                                        <select class="form-select" id="shipping_country" name="shipping_country">
                                            <option>{{ __('Country') }}</option>
                                            @foreach (country() as $cnt)
                                                <option value="{{ $cnt->name_en }}" data-value="{{ $shipping?->Country }}"
                                                    {{ $shipping?->Country == $cnt->name_en ? 'selected' : ' ' }}
                                                    {{ $cnt->name_en == 'Oman' ? 'selected' : ' ' }}>
                                                    @if (app()->getLocale() == 'en')
                                                        {{ $cnt->name_en }}
                                                    @else
                                                        {{ $cnt->name_ar }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('shipping_country')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="shipping_zipcode"
                                                @if (!$shipping?->Country == 'Oman') required @endif
                                                data-value="{{ $shipping?->Zipcode }}" name="shipping_zipcode"
                                                placeholder="{{ __('Zip/Postal Code') }}" {{-- value="{{ $shipping?->Zipcode }}" --}} />
                                            @error('shipping_zipcode')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            {{-- <input type="text" class="form-control" id="shipping_state"
                                                name="shipping_state" placeholder="{{ __('State') }}"
                                                value="{{ $shipping?->State }}" /> --}}

                                            <select class="form-select" id="shipping_state" name="shipping_state"
                                                data-value="{{ $shipping?->State }}">
                                                <option value="null">{{ __('Governorate') }}</option>
                                                @foreach (status() as $cnt)
                                                    <option value="{{ $cnt->name_en }}" data-id="{{ $cnt->id }}"
                                                        {{-- {{ $shipping?->State == $cnt->name_en ? 'selected' : ' ' }} --}}>
                                                        @if (app()->getLocale() == 'en')
                                                            {{ $cnt->name_en }}
                                                        @else
                                                            {{ $cnt->name_ar }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('shipping_state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <select class="form-select" id="shipping_City" name="shipping_City"
                                                data-value="{{ $shipping?->State }}">
                                                <option>{{ __('State') }}</option>
                                                {{ $state_id = \App\Models\States::where('name_en', $shipping?->State)->first()?->id }}
                                                @foreach (cities($state_id) as $cnt)
                                                    <option value="{{ $cnt->name_en }}" data-id="{{ $cnt->id }}"
                                                        {{-- {{ $shipping?->Citie == $cnt->name_en ? 'selected' : ' ' }} --}}>
                                                        @if (app()->getLocale() == 'en')
                                                            {{ $cnt->name_en }}
                                                        @else
                                                            {{ $cnt->name_ar }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('shipping_state')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="shipping_street_address"
                                                name="shipping_street_address" placeholder="{{ __('Region') }}"
                                                data-value="{{ $shipping?->Street }}" {{-- value="{{ $shipping?->Street }}"  --}} />
                                            @error('shipping_street_address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                </div>
                                <div class="payment-method">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h2 class="checkout-title">{{ __('Payment Method') }}</h2>
                                        </div>
                                        <div class="col-lg-12">

                                            <div class="form-group">
                                                <div class="form-check card-check">
                                                    <input class="form-check-input" type="radio" name="payment"
                                                        id="creditcard" value="creditcard" />
                                                    <label class="form-check-label" for="creditcard">
                                                        {{ __('Credit Card') }}</label>
                                                    <div class="input-icon" style="width: 72px;">
                                                        <img src="{{ asset(IMG_PAYMENT_GATEWAY . 'creditcard.png') }}"
                                                            alt="payment-method" />
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="form-check card-check">
                                                    <input class="form-check-input" type="radio" name="payment"
                                                        id="COD" value="COD" />
                                                    <label class="form-check-label"
                                                        for="COD">{{ __('Cash On Delivery') }}</label>
                                                    <div class="input-icon" style="width: 40px;">
                                                        <img src="{{ asset(IMG_PAYMENT_GATEWAY . 'cash.png') }}"
                                                            alt="{{ __('Cash On Delivey') }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group form-check terms-agree">
                                                <input type="checkbox" class="form-check-input" id="agree"
                                                    required />
                                                <label class="form-check-label"
                                                    for="agree">{{ __('By clicking the button you agree to our') }}
                                                    <a
                                                        href="{{ route('terms.conditions') }}">{{ __('Terms & Conditions') }}</a></label>
                                            </div>
                                            @if (auth()->check())
                                                <button type="submit" id="payButton"
                                                    class="checkout-btn form-btn">{{ __('Place Order') }}</button>
                                                <button type="button" id="payButtonN"
                                                    class="checkout-btn form-btn d-none buy_now">{{ __('Place Order') }}</button>
                                            @else
                                                <button type="button" class="checkout-btn" data-bs-toggle="modal"
                                                    data-bs-target="#loginModal">{{ __('Place Order') }}</button>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade common-modal" id="show-razor-thanks" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">
                                                    {{ __('Razorpay Confirmation') }}</h5>
                                            </div>
                                            <div class="modal-body">
                                                {{ __('Your payment is authorized. For capturing your order click') }}
                                                <b>{{ __('Place Order') }}</b>
                                                <div class="modal-btn-wrap text-end">
                                                    <button type="submit"
                                                        class="primary-btn">{{ __('Place Order') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="cart-summary">
                            <div class="summary-top d-flex">
                                <h2>{{ __('Cart Summary') }}&nbsp;&nbsp;</h2>
                                <a class="edite-btn" href="{{ route('cart.content') }}">{{ __('Edit') }}</a>
                            </div>
                            <ul class="cart-product-list">
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($content as $item)
                                    <li class="single-cart-product d-flex justify-content-between">
                                        <div class="product-info">
                                            <h3>{{ $item->qty }} {{ $item->name }}</h3>
                                        </div>
                                        <div class="price-area">
                                            <h3 class="price">
                                                {{ currencyConverter($item->price * $item->qty) }}
                                            </h3>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                            <!-- Cart page bottom box -->
                            <div class="col-lg-12 col-md-12">
                                <div class="checkout-discount-box">
                                    <h2 class="mb-3">{{ __('Discount Codes') }}</h2>
                                    <form action="{{ route('apply.coupon') }}" method="post">
                                        @csrf
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="coupon_code"
                                                placeholder="{{ __('Enter your coupon code') }}" required />
                                            <button type="submit"
                                                class="border-0 px-4">{{ __('Apply Coupon') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <ul class="summary-list">
                                <li>{{ __('Subtotal') }}
                                    <span>{{ currencyConverter(\Cart::subtotal()) }}</span>
                                </li>
                                <li>{{ __('Shipping Cost') }} <span id="delivery-charge-curr"></span></li>
                                <li>{{ __('VAT/Tax') }} <span
                                        id="tax-show-curr">{{ currencyConverter(tax_amount(\Cart::subtotal())) }}</span>
                                </li>

                                @if (!empty(Session::get('CouponAmount')))
                                    <li>{{ __('Coupon Discount (-)') }}
                                        <span>{{ currencyConverter(Session::get('CouponAmount')) }}</span>
                                    </li>
                                @endif
                            </ul>
                            <div class="total-amount">
                                <h3>
                                    {{ __('Total Cost') }}
                                    <span class="float-right" id="total-cost-curr">
                                        {{ currencyConverter(\Cart::subtotal() + allsetting()['shipping_charge'] + tax_amount(\Cart::subtotal()) - Session::get('CouponAmount')) }}
                                    </span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="stripe-collapse" data-stripe="{{ route('stripe_collapse') }}"></div>
    <div id="stripe-key" data-key="{{ config('services.stripe.key') }}"></div>
    <div id="user-name" data-key="{{ auth()->check() ? auth()->user()->name : 'Guest User' }}"></div>
    <div id="user-email" data-key="{{ auth()->check() ? auth()->user()->email : 'guest@gmail.com' }}"></div>
    <div id="get-tax-amount" data-url="{{ route('checkout.get_tax_amount') }}"></div>
    <!-- checkout page area end here  -->
    @push('post_script')
        <script src="https://js.stripe.com/v3/"></script>
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script src="{{ asset('frontend/assets/js/pages/checkout.js') }}"></script>
    @endpush
@endsection
