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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/slick/slick.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/MagnificPopup/magnific-popup.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">

        <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    <!--===============================================================================================-->
    @yield('css')
    @if (App::getLocale() == 'ar')
    <style>
        .topbar .dropdown .dropdown-menu {
            right: -60%;
        }

        body {
            direction: rtl;
            text-align: right;
        }

        .sidebar {
            padding: 0;
        }

        .sidebar .nav-item .nav-link {
            text-align: right;
            margin-right: 52px;
        }

        .sidebar .nav-item .nav-link[data-toggle=collapse]::after {
            float: left;
            transform: rotate(180deg);
        }

        .limiter-menu-desktop {
            margin-right: 52px;
        }

        .main-menu {
            padding-right: 24px;
        }

        .logo {
            margin-left: 160px;
        }

        .limiter-menu-desktop {
            margin-right: 200px;
        }

        .ml-auto,
        .mx-auto {
            margin-left: unset !important;
            margin-right: auto !important;
        }

        /* عكس الصور الخلفية فقط */
       /* عكس الصور الخلفية فقط */
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
            .thumbnails{
                right: -110px;
            }
    </style>
@endif

    <style>
                /* تخصيص الأيقونات */
        .wrap-icon-header .icon-header-item {
            font-size: 18px;
            color: #333;
            position: relative;
            transition: color 0.3s ease;
        }

        .wrap-icon-header .icon-header-item:hover {
            color: #007bff; /* لون عند التمرير */
        }

        /* تنسيق الفقاعة فوق الأيقونة */
        .icon-header-noti {
            position: relative;
        }

        .icon-header-noti::after {
            content: attr(data-notify);
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: #ff3e3e;
            color: #fff;
            font-size: 12px;
            width: 18px;
            height: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        /* قائمة اللغات المنسدلة */
        .dropdown-menu {
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-toggle::after{
            display: none;
        }
        .dropdown-item {
            font-size: 14px;
            padding: 10px 15px;
            transition: background-color 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa; /* لون الخلفية عند التمرير */
            color: #007bff; /* لون النص عند التمرير */
        }

                /* تنسيق الرابط في القائمة */
        .dropdown-item {
            font-size: 14px;
            padding: 10px 15px;
            color: #333;
            border-radius: 6px;
            transition: background-color 0.3s ease, color 0.3s ease;
            display: flex;
            align-items: center;
        }

        /* تأثير عند التمرير على العنصر */
        .dropdown-item:hover {
            background-color: #007bff; /* خلفية باللون الأزرق */
            color: #fff; /* النص يصبح أبيض */
        }

        /* أيقونات بجانب أسماء اللغات */
        .dropdown-item i {
            color: #007bff; /* لون الأيقونة */
            margin-right: 8px;
            transition: color 0.3s ease;
        }

        .dropdown-item:hover i {
            color: #fff; /* تغيير لون الأيقونة عند التمرير */
        }

        /* القائمة نفسها */
        .dropdown-menu {
            border-radius: 8px;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* ظل خفيف */
            animation: fadeIn 0.3s ease;
                }
                /* العنصر الأساسي للأيقونة */
            #favorites-count {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red;
            color: white;
            font-size: 12px;
            border-radius: 50%;
            padding: 2px 6px;
            display: inline-block;
            min-width: 18px;
            text-align: center;
        }

        #favorites-count:empty {
            display: none;
        }


    </style>
</head>

<body class="animsition">

    <!-- Header -->
    <header>
        <!-- Header desktop -->
        <div class="container-menu-desktop">
            <!-- Topbar -->
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="#" class="logo">
                    <img src="{{ asset('assets/images/icons/logo-gaza.png') }}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="{{ route('front.index') }}"> {{ __('front.home') }}</>
                        </li>

                        <li class="label1" data-label1="hot">
                            <a href="{{ route('front.products') }}"> {{ __('front.shop') }}</a>
                        </li>

                        <li>
                            <a href="{{ route('front.shoping') }}"> {{ __('front.features') }}</a>
                        </li>

                        <li >
                            <a href="{{ route('front.blog') }}">{{ __('front.blog') }}</a>
                        </li>

                        <li>
                            <a href="{{ route('front.about') }}">{{ __('front.about') }}</a>
                        </li>

                        <li>
                            <a href="{{ route('front.contact') }}">{{ __('front.contact') }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="color:#242f2f;">
                                <i class="fas fa-globe"></i>
                                {{ __('admin.langs') }}</span>

                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach

                        </div>
                    </li>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                    data-notify="{{ session('cart') ? count(session('cart')) : 0 }}">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="{{ route('front.favorites') }}"
                class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
                <i class="zmdi zmdi-favorite-outline"></i>
                <span id="favorites-count" class="icon-header-noti">{{ $favoritesCount ?? 0 }}</span>
                </a>

                </div>
            </nav>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="{{ route('front.index') }}"><img src="{{ asset('assets/images/icons/logo-01.png') }}" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                   <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small" style="color:#242f2f;">
                                <i class="fas fa-globe"></i>
                                {{ __('admin.langs') }}</span>

                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                </a>
                            @endforeach

                        </div>
                    </li>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                    data-notify="{{ session('cart') ? count(session('cart')) : 0 }}">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="{{ route('front.favorites') }}"
                class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10">
                <i class="zmdi zmdi-favorite-outline"></i>
                <span id="favorites-count" class="icon-header-noti"></span>
             </a>



            </div>


            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">

            <ul class="main-menu-m">
                <li class="active-menu">
                    <a href="{{ route('front.index') }}">Home</>
                </li>

                <li >
                    <a class="label1" data-label1="hot" href="{{ route('front.products') }}">Shop</a>
                </li>

                <li>
                    <a href="{{ route('front.shoping') }}">Features</a>
                </li>

                <li >
                    <a href="blog.html">Blog</a>
                </li>

                <li>
                    <a href="about.html">About</a>
                </li>

                <li>
                    <a href="contact.html">Contact</a>
                </li>
            </ul>
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
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search-input');
            const searchResults = document.getElementById('search-results');

            // استماع لحدث الإدخال في حقل البحث
            searchInput.addEventListener('input', function() {
                const query = searchInput.value.trim();

                if (query.length > 0) {
                    // إرسال طلب AJAX إلى السيرفر
                    fetch(`/search-products?query=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(data => {
                            searchResults.innerHTML = ''; // تفريغ النتائج السابقة

                            if (data.length > 0) {
                                // عرض النتائج
                                data.forEach(product => {
                                    const resultItem = `
                                        <div style="padding: 10px; border-bottom: 1px solid #ddd;">
                                            <a href="/product/${product.id}" style="text-decoration: none; color: #333;">
                                                <strong>${product.trans_name}</strong> -
                                                <span>Price: $${product.price}</span>
                                            </a>
                                        </div>
                                    `;
                                    searchResults.insertAdjacentHTML('beforeend', resultItem);
                                });
                            } else {
                                searchResults.innerHTML =
                                    '<div style="padding: 10px;">No products found.</div>';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching search results:', error);
                        });
                } else {
                    searchResults.innerHTML = ''; // إخفاء النتائج إذا كان الإدخال فارغًا
                }
            });
        });
    </script>

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

</body>

</html>
