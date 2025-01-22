@extends('front.master')
@section('title', 'Products')

@section('content')
@include('front.partials.carts')


    <!-- Product -->
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
                    <button id="allProductsBtn" class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1">
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

                    <div class="products-container" id="productsContainer"></div>




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



    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>
@section('js')
   <!--  عند الضغط على القسم يجلب المنتجات -->
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
