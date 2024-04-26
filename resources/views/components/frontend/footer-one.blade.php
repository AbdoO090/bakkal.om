<!-- footer area start here -->
<hr>
<footer class="footer-area">
    <div class="footer-widget-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                    <div class="single-widget about-widget">
                        <a href="{{ route('front') }}" class="footer-brand-logo mb-25"><img
                            src="{{ asset('png_bakkal.png') }}" alt="footer-logo" /></a>
                        <p class="address-text">
                            {{ $allsettings['address'] }} <br />
                            {{ $allsettings['state'] }} <br />
                            {{ $allsettings['country'] }}
                        </p>
                        <div class="block-content mb-30">
                            <p class="contact">{{ __('Call us:') }} {{ $allsettings['call_us'] }}</p>
                            <p class="contact">{{ __('Email:') }} {{ $allsettings['email'] }}</p>
                        </div>
                        <ul class="social-media">
                            @if (getSocialLink()->Facebook)
                                <li class="social-media-item">
                                    <a target="_blank" class="social-media-link" href="https://m.facebook.com/p/Bakkaloman-100071449211087/">
                                        <i class="fab fa-facebook-f"></i></a>
                                </li>
                            @endif

                            @if (getSocialLink()->Twitter)
                                <li class="social-media-item">
                                    <a target="_blank" class="social-media-link" href="https://twitter.com/BakkalOman">
                                        <i class="fab fa-twitter"></i></a>
                                </li>
                            @endif

                            @if (getSocialLink()->Instagram)
                                <li class="social-media-item">
                                    <a target="_blank" class="social-media-link"
                                        href="https://instagram.com/bakkal.oman?igshid=MTNzazJqZnMwdTdmNg==">
                                        <i class="fab fa-instagram"></i></a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-8 col-md-8 col-sm-8">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="single-widget">
                                <h3 class="widget-title">{{ __('Category') }}</h3>
                                <ul class="widget-menu show">
                                    @foreach (Category() as $item)
                                        <li class="menu-item"><a class="menu-link"
                                                href="{{ route('category.product', $item->id) }}">{{ langConverter($item->en_Category_Name, $item->fr_Category_Name) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        {{-- <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="single-widget">
                                <h3 class="widget-title">{{ __('Brand') }}</h3>
                                <ul class="widget-menu">
                                    @foreach (Brnad() as $item)
                                        <li class="menu-item"><a class="menu-link"
                                                href="{{ route('brand.product', $item->id) }}">{{ langConverter($item->en_BrandName, $item->fr_BrandName) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div> --}}
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="single-widget">
                                <h3 class="widget-title">{{ __('Customer Service') }}</h3>
                                <ul class="widget-menu">
                                 <li class="menu-item"><a class="menu-link"
                                            href="{{ route('refund.policy') }}">{{ __('About US') }}</a>
                                    </li>
                                   
                                    <li class="menu-item"><a class="menu-link"
                                            href="{{ route('terms.conditions') }}">{{ __('Terms of Conditions') }}</a>
                                    </li>
                                    <li class="menu-item"><a class="menu-link"
                                            href="{{ route('privacy.policy') }}">{{ __('Privacy Policy') }}</a>
                                    </li>
                                   
                                   
                                    <li class="menu-item"><a class="menu-link"
                                            href="{{ route('contact.us') }}">{{ __('Contact Us') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container-fluid">
            <div class="footer-bottom-wrap">
                {{ $allsettings['footer_title'] }}
            </div>
        </div>
    </div>
</footer>
<!-- footer area end here -->
