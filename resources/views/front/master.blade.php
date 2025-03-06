<!DOCTYPE html>
<html lang="en">

<head>
    <!-- jQuery -->
    <script src="{{ asset('assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>

    <title>@yield('title', env('APP_NAME'))</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">




    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/icons/favicon.png') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/fonts/linearicons-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!--===============================================================================================-->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/slick/slick.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/MagnificPopup/magnific-popup.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/styles.css') }}">

        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    <!--===============================================================================================-->
    @yield('css')
    @if (App::getLocale() == 'ar')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;700;900&display=swap');

        body {
            direction: rtl;
            text-align: center;
            font-family: 'Tajawal', sans-serif; /* خط عصري وجميل */
        }

        /* تحسين تنسيق العناوين */
        h1, h2, h3, h4, h5, h6 {
            text-align: center;
            font-weight: 900; /* جعل الخط سميك جداً */
            color: #222; /* لون أكثر وضوحًا */
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); /* إضافة ظل خفيف */
        }

        p {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            text-align: center;
            line-height: 1.8; /* تحسين التباعد */
        }

        .topbar .dropdown .dropdown-menu {
            right: 0;
            left: auto;
            text-align: center;
        }

        .sidebar {
            padding: 0;
            text-align: center;
        }

        .sidebar .nav-item .nav-link {
            text-align: center;
            margin-right: 0;
            font-weight: bold;
            color: #000; /* لون أكثر وضوحًا */
        }

        .sidebar .nav-item .nav-link[data-toggle=collapse]::after {
            float: none;
            transform: rotate(180deg);
        }

        .limiter-menu-desktop {
            margin: 0 auto;
            display: flex;
            justify-content: center;
        }

        .main-menu {
            padding: 0;
            text-align: center;
        }

        .logo {
            margin: 0 auto;
            display: block;
        }

        .ml-auto, .mx-auto {
            margin-left: auto !important;
            margin-right: auto !important;
        }
        .item-slick1::before {
                content: "";
                display: block;
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: inherit;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                transform: scaleX(-1);
                z-index: -1;
            }
            .favorite-button{
                padding-right: 230px;
            }

            .thumbnails {
            display: flex;
            flex-direction: column;
            gap: 10px;
            position: absolute;
            right: -110px; /* عكس الاتجاه */
            left: auto;
            top: 50%;
            transform: translateY(-50%);
        }

        .thumbnail img {
            width: 100px;
            height: auto;
            cursor: pointer;
            border-radius: 5px;
            transition: transform 0.2s ease-in-out;
        }

        .thumbnail img:hover {
            transform: scale(1.1);
        }

        /* التصميم عند الشاشات الصغيرة */
        @media (max-width: 1024px) {
            .thumbnails {
                right: -80px; /* تقليل المسافة عند الشاشات الصغيرة */
            }

            .thumbnail img {
                width: 70px;
            }
        }

        @media (max-width: 768px) {
            .thumbnails {
                position: static;
                display: flex;
                flex-direction: row;
                justify-content: center;
                gap: 5px;
                transform: none;
                margin-top: 15px;
            }

            .thumbnail img {
                width: 60px;
            }
        }

    </style>
    @endif

</head>

<body class="animsition">

    <header class="custom-navbar">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('front.index') }}">
                    <img src="{{ asset('assets/images/icons/logo-gaza.png') }}" alt="Logo" class="logo">
                </a>

                <!-- Navbar Toggler (for mobile) -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Items -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('front.index') }}">{{ __('front.home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link hot-label" href="{{ route('front.products') }}">{{ __('front.shop') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.carts') }}">{{ __('front.features') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.blog') }}">{{ __('front.blog') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.about') }}">{{ __('front.about') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('front.contact') }}">{{ __('front.contact') }}</a>
                        </li>
                    </ul>
                </div>
                    <!-- Icons Section -->
                    <div class="icons">
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle lang-dropdown" href="#" id="langDropdown" role="button" data-toggle="dropdown">
                                <i class="fas fa-globe"></i>
                            </a>
                            <div class="dropdown-menu">
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                        data-notify="{{ session('cart') ? count(session('cart')) : 0 }}">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>

                    <a href="{{ route('front.favorites') }}"
                    class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
                    <i class="zmdi zmdi-favorite-outline"></i>
                    <span id="favorites-count" class="icon-header-noti"></span>
                 </a>

                        <div class="header-buttons">
                            @if(auth()->check())
                                <!-- عرض اسم المستخدم عند تسجيل الدخول -->
                                <div class="user-dropdown">
                                    <button class="user-name-btn">
                                        {{ auth()->user()->name }} <i class="zmdi zmdi-chevron-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="">{{ __('front.profile') }} </a></li>

                                        <form action="{{ route('logout') }}" method="post">
                                            @csrf
                                            <button class="dropdown-item"><i
                                                    class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>{{ __('admin.out') }}</button>
                                        </form>

                                    </div>                                    </ul>
                                </div>
                            @else
                                <!-- عرض أزرار تسجيل الدخول والتسجيل عند عدم تسجيل الدخول -->
                                <a href="{{ route('login') }}" class="btn btn-primary">{{ __('front.login') }}</a>
                                <a href="{{ route('register') }}" class="btn btn-outline-primary">{{ __('front.sign_up') }}</a>
                            @endif
                        </div>
                    </div>

            </nav>
        </div>
    </header>


    @yield('content')

     @include('front.partials.footer')

    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>



    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>

    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/slick-custom.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/parallax100/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <!--===============================================================================================-->
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('assets/vendor/isotope/isotope.pkgd.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // تحديث عدد المفضلات عند التحميل
        function updateFavoritesCount() {
            $.ajax({
                url: "{{ route('front.favorites.count') }}",
                type: "GET",
                success: function(response) {
                    $('#favorites-count').text(response.count); // تحديث العدد في الأيقونة
                },
                error: function() {
                    console.error('Failed to fetch favorites count.');
                }
            });
        }

        // استدعاء الدالة عند التحميل
        updateFavoritesCount();
    });
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const cartIcon = document.querySelector('.icon-header-noti');

    if (!cartIcon) {
        return; // لا تنفذ الكود إذا لم تكن في المتجر
    }

    function updateCartCount() {
        fetch('/carts/count')
            .then(response => response.json())
            .then(data => {
                if (data && typeof data.count !== 'undefined') {
                    cartIcon.setAttribute('data-notify', data.count);
                }
            })
            .catch(error => console.error('Error updating cart count:', error));
    }

    updateCartCount();
});

</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.js-addwish-b2').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function() {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <script src="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>

    <!--===============================================================================================-->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    @yield('js')

    <script>
        // Toggle Mobile Menu
        document.querySelector('.btn-show-menu-mobile').addEventListener('click', function () {
            const menu = document.querySelector('.menu-mobile');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
    </script>

<script>
    // Add 'visible' class to elements when they are in viewport
    document.addEventListener('DOMContentLoaded', function () {
        const fadeIns = document.querySelectorAll('.fade-in');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        });

        fadeIns.forEach((fadeIn) => observer.observe(fadeIn));

        // Sticky Navbar Effect
        const navbar = document.querySelector('nav');
        window.addEventListener('scroll', function () {
            if (window.scrollY > 50) {
                navbar.classList.add('sticky');
            } else {
                navbar.classList.remove('sticky');
            }
        });
    });
</script>
</body>

</html>
