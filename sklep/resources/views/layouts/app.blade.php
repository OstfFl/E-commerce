<!DOCTYPE html>
<html class="no-js" lang="pl">

<head>
    <meta charset="utf-8">
    <title>Sklep</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/imgs/theme/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
    @livewireStyles
</head>

<body>
<header class="header-area header-style-1 header-height-2">
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">

                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">

                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        @auth
                            <ul>
                                <li><i class="fi-rs-key"></i>{{Auth::user()->name}} /
                                    <form method="POST" action="{{route('logout')}}">
                                        @csrf
                                        <a href="{{route('logout')}}" onclick="event.preventDefault();this.closest('form').submit();">Wyloguj</a>
                                    </form>
                                </li>
                            </ul>
                        @else
                            <ul>
                                <li><i class="fi-rs-key"></i><a href="{{route('login')}}"> Zaloguj się </a> / <a
                                        href="{{route('register')}}">Zarejestruj się</a></li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="/"><img src="{{asset('assets/imgs/logo/logo.png')}}" alt="logo"></a>
                </div>
                <div class="header-right">
                    @livewire('header-search-component')
                    <div class="header-action-right">
                        <div class="header-action-2">
                            @livewire('wishlist-icon-component')
                            @livewire('cart-icon-component')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="/"><img src="{{asset('assets/imgs/logo/logo.png" alt="logo"')}}"></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                        <nav>
                            <ul>
                                <li><a class="active" href="/">Glowna </a></li>
                                <li><a href="{{route('shop')}}">Sklep</a></li>
                                @auth
                                    <li><a href="#">Moje Konto<i class="fi-rs-angle-down"></i></a>
                                        @if(Auth::user()->utype == 'ADM')
                                            <ul class="sub-menu">
                                                <li><a href="{{route('admin.products')}}">Produkty</a></li>
                                                <li><a href="{{route('admin.categories')}}">Kategorie</a></li>
                                                <li><a href="{{route('admin.orders')}}">Zamówienia</a></li>
                                                <li><a href="{{route('admin.users')}}">Użytkownicy</a></li>
                                            </ul>
                                        @else
                                            <ul class="sub-menu">
                                                <li><a href="/">Dash</a></li>
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-block">
                    <p><i class="fi-rs-smartphone"></i><span>Dzwoń za free</span> +48 730941662 </p>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="{{route('shop.wishlist')}}">
                                <img alt="Surfside Media" src="{{asset('assets/imgs/theme/icons/icon-heart.svg')}}">
                                <span class="pro-count white">4</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{route('shop.cart')}}">
                                <img alt="Surfside Media" src="{{asset('assets/imgs/theme/icons/icon-cart.svg')}}">
                                <span class="pro-count white">2</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="product-details.html"><img alt="Surfside Media"
                                                                                src="assets/imgs/shop/thumbnail-3.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="product-details.html">Plain Striola Shirts</a></h4>
                                            <h3><span>1 × </span>$800.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="product-details.html"><img alt="Surfside Media"
                                                                                src="assets/imgs/shop/thumbnail-4.jpg"></a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4><a href="product-details.html">Macbook Pro 2022</a></h4>
                                            <h3><span>1 × </span>$3500.00</h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#"><i class="fi-rs-cross-small"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span>$383.00</span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="{{route('shop.cart')}}">Pokaż kosz</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="index.html"><img src="assets/imgs/logo/logo.png" alt="logo"></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Szukaj">
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <div class="main-categori-wrap mobile-header-border">
                    <a class="categori-button-active-2" href="#">
                        <span class="fi-rs-apps"></span> Browse Categories
                    </a>
                    <div class="categori-dropdown-wrap categori-dropdown-active-small">
                        <ul>
                            <li><a href="shop.html"><i class="surfsidemedia-font-dress"></i>Women's Clothing</a></li>
                            <li><a href="shop.html"><i class="surfsidemedia-font-tshirt"></i>Men's Clothing</a></li>
                            <li><a href="shop.html"><i class="surfsidemedia-font-smartphone"></i> Cellphones</a></li>
                            <li><a href="shop.html"><i class="surfsidemedia-font-desktop"></i>Computer & Office</a></li>
                            <li><a href="shop.html"><i class="surfsidemedia-font-cpu"></i>Consumer Electronics</a></li>
                            <li><a href="shop.html"><i class="surfsidemedia-font-home"></i>Home & Garden</a></li>
                            <li><a href="shop.html"><i class="surfsidemedia-font-high-heels"></i>Shoes</a></li>
                            <li><a href="shop.html"><i class="surfsidemedia-font-teddy-bear"></i>Mother & Kids</a></li>
                            <li><a href="shop.html"><i class="surfsidemedia-font-kite"></i>Outdoor fun</a></li>
                        </ul>
                    </div>
                </div>
                <!-- mobile menu start -->

                <!-- mobile menu end -->
            </div>

            <div class="mobile-social-icon">
                <h5 class="mb-15 text-grey-4">Follow Us</h5>
                <a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a>
                <a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a>
                <a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a>
                <a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a>
                <a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-youtube.svg')}}" alt=""></a>
            </div>
        </div>
    </div>
</div>

{{$slot}}
<footer class="main">
    <section class="newsletter p-30 text-white wow fadeIn animated">
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="widget-about font-md mb-md-5 mb-lg-0">
                        <div class="logo logo-width-1 wow fadeIn animated">
                            <a href="/"><img src="{{asset('assets/imgs/logo/logo.png')}}" alt="logo"></a>
                        </div>
                        <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Kontakt</h5>
                        <p class="wow fadeIn animated">
                            <strong>Adres: </strong>Lublin Nadbystrzycka 44a
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Kontakt: </strong>+48 730 941 662
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Email: </strong>contact@tanie.odzieze.com
                        </p>
                        <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Subskrybuj!</h5>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a>
                            <a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a>
                            <a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a>
                            <a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a>
                            <a href="#"><img src="{{asset('assets/imgs/theme/icons/icon-youtube.svg')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">Info</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                        <li><a href="#">O nas</a></li>
                        <li><a href="#">Informacja Dostawy</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">RODO</a></li>
                        <li><a href="#">Napisz Do Nas</a></li>
                    </ul>
                </div>
                <div class="col-lg-2  col-md-3">
                    <h5 class="widget-title wow fadeIn animated">Moje konto</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="/">My Account</a></li>
                        <li><a href="{{route('shop.cart')}}">Pokaż kosz</a></li>
                        <li><a href="{{route('shop.wishlist')}}">Moja lista zyczeń</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 mob-center">
                    <h5 class="widget-title wow fadeIn animated">Pobierz Program</h5>
                    <div class="row">
                        <div class="col-md-8 col-lg-12">
                            <p class="wow fadeIn animated">Z App Store lub Google Play</p>
                            <div class="download-app wow fadeIn animated mob-app">
                                <a href="https://www.apple.com/pl/app-store/" class="hover-up mb-sm-4 mb-lg-0"><img class="active"
                                                                                  src="{{asset('assets/imgs/theme/app-store.jpg')}}"
                                                                                  alt=""></a>
                                <a href="#" class="hover-up"><img src="{{asset('assets/imgs/theme/google-play.jpg')}}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                            <p class="mb-20 wow fadeIn animated">Bezpieczne metody płatności</p>
                            <img class="wow fadeIn animated" src="{{asset('assets/imgs/theme/payment-method.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated mob-center">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-6">
                <p class="float-md-left font-sm text-muted mb-0">
                    <a href="privacy-policy.html">Privacy Policy</a> | <a href="terms-conditions.html">Terms &
                        Conditions</a>
                </p>
            </div>
            <div class="col-lg-6">
                <p class="text-lg-end text-start font-sm text-muted mb-0">
                    &copy; <strong class="text-brand">Projekt TanieOdzieże</strong> All rights reserved
                </p>
            </div>
        </div>
    </div>
</footer>
<!-- Vendor JS-->
<script src="{{asset('assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<script src='{{asset('assets/js/vendor/jquery-3.6.0.min.js')}}'></script>
<script src="{{asset('assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
<script src="{{asset('assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/slick.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.syotimer.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/wow.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery-ui.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/js/plugins/magnific-popup.js')}}"></script>
<script src="{{asset('assets/js/plugins/select2.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/waypoints.js')}}"></script>
<script src="{{asset('assets/js/plugins/counterup.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.countdown.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/images-loaded.js')}}"></script>
<script src="{{asset('assets/js/plugins/isotope.js')}}"></script>
<script src="{{asset('assets/js/plugins/scrollup.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.vticker-min.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.theia.sticky.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.elevatezoom.js')}}"></script>
<!-- Template JS -->
<script src="{{asset('assets/js/main.js?v=3.3')}}"></script>
<script src="{{asset('assets/js/shop.js?v=3.3')}}"></script>
@livewireScripts
@stack('scripts')
@stack('scripts2')
</body>

</html>
