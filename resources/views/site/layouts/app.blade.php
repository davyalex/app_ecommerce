<!doctype html>
{{-- <html lang="en" class="light-theme"> --}}
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="@yield('title')">
    <meta property="og:image" content="@yield('image')">
    <meta name="title" content="@yield('title')">
    <meta name="url" content="@yield('url')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('app.name')}} - @yield('title')</title>


    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/favicon/favicon-16x16.png') }}">

    <!-- Plugins -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/metisMenu.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/metismenu/mm-vertical.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/slick/slick-theme.css') }}" />

    <!--CSS Files-->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    
    <link href="{{ asset('assets/css/dark-theme.css') }}" rel="stylesheet" />

    @yield('css')


    <link href="
    https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css
    " rel="stylesheet">
    <script src="
        https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js
        "></script>

        
</head>

<body>
    

    <!--page loader-->
    <div class="loader-wrapper">
        <div
            class="d-flex justify-content-center align-items-center position-absolute top-50 start-50 translate-middle">
            <div class="spinner-border text-white" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <!--end loader-->

    <!--start wrapper-->
    <div class="wrapper bg-white">

        <!--start to header-->
        <header class="top-header fixed-top border-bottom d-flex align-items-center">
            <nav class="navbar navbar-expand w-100 p-0 gap-3 align-items-center">
                {{-- <div class="nav-button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidenav"><a
                        href="javascript:;"><i class="bi bi-list"></i></a></div> --}}
                @if (Route::currentRouteName() !== 'home')
                    <div class="nav-button"><a href="{{ url()->previous() }}"><i
                                class="bi bi-arrow-left"></i></a></div>
                @endif

                <div class="brand-logo"><a href="#">
                        {{-- <img src="assets/images/logo.webp" width="95"
                            alt=""></a> --}}
                        <h4>
                            @if (Route::currentRouteName() === 'home')
                                <img src="{{ asset('assets/images/logo/logo_zoolouk/logo_transparent_noir.png') }}"
                                    width="50%" class=" pt-2" alt="">
                            @else
                                @yield('title')
                            @endif


                        </h4>
                </div>



                <form class="searchbar" method="GET" action="{{ route('search') }}">
                    @csrf
                    <div class="position-absolute top-50 translate-middle-y search-icon start-0"><i
                            class="bi bi-search text-black"></i></div>
                    <input class="form-control px-5 bg-white" type="text" name="search"
                        placeholder="Rechercher un produit">
                    <div class="position-absolute top-50 translate-middle-y end-0 search-close-icon"><i
                            class="bi bi-x-lg text-black"></i></div>
                </form>
                <ul class="navbar-nav ms-auto d-flex align-items-center top-right-menu">
                    <li class="nav-item mobile-search-button">
                        <a class="nav-link" href="javascript:;"><i class="bi bi-search"></i></a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="wishlist.html"><i class="bi bi-heart"></i></a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('cart') }}">
                            <div class="cart-badge">{{ count((array) session('cart')) }}</div>
                            <i class="bi bi-bag"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </header>
        <!--end to header-->

        {{-- ### --}}
        @yield('content')
        {{-- ### --}}



      
        <!--end collection-->

        {{-- @if (Route::currentRouteName() !== 'product-detail') --}}
        <!--start to footer-->
        <footer class="page-footer fixed-bottom border-top d-flex align-items-center">
            <nav class="navbar navbar-expand p-0 flex-grow-1">
                <div class="navbar-nav align-items-center justify-content-between w-100">
                    <a class="nav-link" href="{{ route('home') }}">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon"><i class="bi bi-house-fill"></i></div>
                            <div class="name">Accueil</div>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('category-list') }}">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon"><i class="bi bi-grid"></i></div>
                            <div class="name">Categories</div>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('my-account') }}">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon"><i
                                    class="{{ Auth::user() ? 'bi bi-person-check' : 'bi bi-person' }}"></i></div>
                            <div class="name">Mon compte</div>
                        </div>
                    </a>
                    <a class="nav-link" href="{{ route('help-index') }}">
                        <div class="d-flex flex-column align-items-center">
                            <div class="icon"><i class="bi bi-question-circle"></i></div>
                            <div class="name">Aide</div>
                        </div>
                    </a>

                </div>
            </nav>
        </footer>
        <!--end to footer-->
        {{-- @endif --}}


        <!--start sidenav-->
        {{-- <div class="sidenav">
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidenav">
                <div class="offcanvas-header bg-dark border-bottom border-light">
                    <div class="hstack gap-3">
                        <div class="">
                            <img src="https://via.placeholder.com/110X110" width="45"
                                class="rounded-3 p-1 bg-white" alt="" />
                        </div>
                        <div class="details">
                            <h6 class="mb-0 text-white">Hi! Jhon Deo</h6>
                        </div>
                    </div>
                    <div data-bs-dismiss="offcanvas"><i class="bi bi-x-lg fs-5 text-white"></i></div>
                </div>
                <div class="offcanvas-body p-0">
                    <nav class="sidebar-nav">
                        <ul class="metismenu" id="sidenav">
                            <li>
                                <a href="home.html">
                                    <i class="bi bi-house-door me-2"></i>
                                    Home
                                </a>
                            </li>
                            <li>
                                <a class="has-arrow" href="javascript:;">
                                    <i class="bi bi-person-circle me-2"></i>
                                    Account
                                </a>
                                <ul>
                                    <li><a href="profile.html">Profile</a></li>
                                    <li><a href="my-orders.html">My Orders</a></li>
                                    <li><a href="my-profile.html">My Profile</a></li>
                                    <li><a href="addresses.html">Addresses</a></li>
                                    <li><a href="notification.html">Notification</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow" href="javascript:;">
                                    <i class="bi bi-basket3 me-2"></i>
                                    Shop Pages
                                </a>
                                <ul>
                                    <li><a href="shop.html">Shop</a></li>
                                    <li><a href="cart.html">Cart</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="product-details.html">Product Details</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                    <li><a href="order-tracking.html">Order Tracking</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow" href="javascript:;">
                                    <i class="bi bi-credit-card me-2"></i>
                                    Payment
                                </a>
                                <ul>
                                    <li><a href="payment-method.html">Payment Method</a></li>
                                    <li><a href="payment-error.html">Payment Error</a></li>
                                    <li><a href="payment-completed.html">Payment Completed</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow" href="javascript:;">
                                    <i class="bi bi-grid me-2"></i>
                                    Category
                                </a>
                                <ul>
                                    <li><a href="category-grid.html">Category Grid</a></li>
                                    <li><a href="category-list.html">Category List</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow" href="javascript:;">
                                    <i class="bi bi-lock me-2"></i>
                                    Authentication
                                </a>
                                <ul>
                                    <li><a href="authentication-log-in.html">Log In</a></li>
                                    <li><a href="authentication-sign-up.html">Sign Up</a></li>
                                    <li><a href="authentication-otp-varification.html">Verification</a></li>
                                    <li><a href="authentication-change-password.html">Change Password</a></li>
                                    <li><a href="authentication-splash.html">Splash</a></li>
                                    <li><a href="authentication-splash-2.html">Splash 2</a></li>
                                </ul>
                            </li>
                            <li>
                                <a class="has-arrow" href="javascript:;">
                                    <i class="bi bi-star me-2"></i>
                                    Customer Reviews
                                </a>
                                <ul>
                                    <li><a href="reviews-and-ratings.html">Ratings & Reviews</a></li>
                                    <li><a href="write-a-review.html">Write a Review</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="about-us.html">
                                    <i class="bi bi-emoji-smile me-2"></i>
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="contact-us.html">
                                    <i class="bi bi-headphones me-2"></i>
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="offcanvas-footer border-top p-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="DarkMode"
                            onchange="toggleTheme()">
                        <label class="form-check-label" for="DarkMode">Dark Mode</label>
                    </div>
                </div>
            </div>
        </div> --}}
        <!--end sidenav-->


    </div>
    <!--end wrapper-->


    <!--JS Files-->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/cookies-theme-switcher.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/index.js') }}"></script>
    <script src="{{ asset('assets/js/loader.js') }}"></script>
    <script src="{{ asset('assets/js/product-details.js') }}"></script>
    <script src="{{ asset('assets/js/show-hide-password.js') }}"></script>

    @yield('js')


</body>

</html>
