@extends('front.master')
@section('title', 'Homepage')

@section('content')

    @include('front.partials.carts')


    <!-- Slider -->
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                @foreach ( $silders as $silder )
                <div class="item-slick1" style="background-image: url({{ asset('images/' . $silder->image->path) }});">
                    <div class="container h-full">
                        <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                            <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                <span class="ltext-101 cl2 respon2">
                                    {{ $silder->trans_name }}
                                </span>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                    {{ $silder->trans_description }}

                                </h2>
                            </div>

                            <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                <a href="{{ route('front.shoping') }}"
                                    class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                    {{ __('front.shop now') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- Banner -->
    <div class="sec-banner bg0 p-t-95 p-b-55">
        <div class="container">
            <!-- الصف الأول -->
            <div class="row">
                @foreach ($categories->slice(0, 2) as $category)
                    <div class="col-md-6 p-b-30 m-lr-auto">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w position-relative h-100">
                            <img src="{{ asset('images/' . $category->image->path) }}" alt="IMG-BANNER">

                            <a href="{{ route('front.products') }}"
                                class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3 position-absolute w-100 h-100 d-flex flex-column justify-content-between">
                                <div class="block1-txt-child1 flex-col-l">
                                    <span class="block1-name ltext-102 trans-04 p-b-8">
                                        {{ $category->trans_name }}
                                    </span>

                                    <span class="block1-info stext-102 trans-04">
                                        {{ $category->trans_description }}
                                    </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- الصف الثاني -->
            <div class="row d-flex align-items-stretch">
                @foreach ($categories->slice(2, 3) as $category)
                    <div class="col-md-4 p-b-30 m-lr-auto d-flex">
                        <!-- Block1 -->
                        <div class="block1 wrap-pic-w position-relative w-100" style="height: 350px;">
                            <img src="{{ asset('images/' . $category->image->path) }}" alt="IMG-BANNER"
                                style="height: 100%; object-fit: cover;">

                            <a href="product.html"
                                class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3 position-absolute w-100 h-100 d-flex flex-column justify-content-between">
                                <div class="block1-txt-child1 flex-col-l">
                                    <span class="block1-name ltext-102 trans-04 p-b-8">
                                        {{ $category->trans_name }}
                                    </span>

                                    <span class="block1-info stext-102 trans-04">
                                        {{ $category->trans_description }}
                                    </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Shop Now
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>




    <!-- Product Section -->
    <!-- Product Section -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">

            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    {{ __('front.prod over') }}
                </h3>
            </div>

            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">

                    <!-- Filter Buttons -->
                    <button id="allProductsBtn" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1 ">
                        {{ __('admin.all_products') }}

                    </button>


                    @foreach ($categories as $category)
                        <button class="loadDataBtn stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5"
                            data-id="{{ $category->id }}">
                            {{ $category->trans_name }}
                        </button>
                    @endforeach

                </div>

                <div class="search-container">
                    <form id="searchForm" class="search-form">

                        <input type="text" id="query" name="query" placeholder="  {{ __('front.search pro') }} ..."
                            class="search-input">

                                    <button type="submit" class="search-button">  {{ __('front.search') }}</button>
                    </form>
                </div>
            </div>

            <div class="row" id="dataContainer">
                @include('front.partials.products')
            </div>
            <div class="flex-c-m flex-w w-full p-t-45">
                <div class="page-links">
                    {{ $products->links() }} <!-- يستخدم Laravel pagination التلقائي -->
                </div>
            </div>


        </div>
    </section>

@section('js')
    <script>
        $(document).ready(function() {
            // إعداد CSRF Token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // حدث الضغط على زر "All Products"
            $(document).ready(function() {
                // تحميل جميع المنتجات عند تحميل الصفحة
                fetchAllProducts();

                // تحميل جميع المنتجات عند النقر على الزر
                $(document).on('click', '#allProductsBtn', function() {
                    fetchAllProducts();
                });

                function fetchAllProducts() {
                    $.ajax({
                        url: '/filter-products/all',
                        type: 'GET',
                        success: function(data) {
                            // عرض جميع المنتجات
                            $('#dataContainer').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                        }
                    });
                }
            });


            // حدث الضغط على أزرار الفئات الأخرى
            $(document).on('click', '.loadDataBtn', function() {
                var categoryId = $(this).data('id');

                $.ajax({
                    url: '/filter-products/' + categoryId,
                    type: 'GET',
                    success: function(data) {
                        // استبدال المحتوى بالبيانات الجديدة للفئة المحددة
                        $('#dataContainer').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>


@endsection

@endsection
