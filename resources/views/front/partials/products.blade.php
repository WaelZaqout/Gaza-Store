<style>
    .search-btn {
    display: inline-block;
    width: 120px; /* عرض ثابت */
    min-width: 100px;
    padding: 10px 15px;
    font-size: 16px;
    text-align: center;
    background-color: #4b49ac;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease-in-out;
    }

    .search-btn:hover {
        background-color: #3a379c;
    }

    /* تأكد من أن الحقل والزر متناسقان */
    .search-container {
        display: flex;
        align-items: center;
        gap: 10px; /* مسافة بين الحقل والزر */
    }
    /* ضبط SweetAlert2 ليكون فوق المودال */
    .custom-swal-popup {
        z-index: 99999 !important; /* التأكد أن SweetAlert2 فوق كل شيء */
        position: fixed !important;
        top: 20px !important;
        left: auto !important;
        right: 20px !important; /* يظهر في أعلى اليمين */
        width: 300px !important;
    }


</style>



<div id="row1" class="row">
    @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="{{ $product->image ? asset('images/' . $product->image->path) : asset('images/default.jpg') }}"
                        alt="{{ $product->trans_name }}">

                    <a href="#" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                        data-id="{{ $product->id }}" data-price="{{ $product->price }}">Quick View</a>
                </div>

                <div class="block2-txt flex-w flex-t p-t-14">
                    <!-- معلومات المنتج -->
                    <div class="block2-txt-child1 flex-col-l">
                        <p class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            {{ $product->trans_name }}
                        </p>
                    </div>

                    <!-- السعر وزر المفضلة بجانبه -->
                    <div class="block2-txt-child2 flex-r">
                        <span class="stext-105 cl3">
                            ${{ number_format($product->price, 2) }}
                        </span>

                        <!-- زر المفضلة -->
                        <form class="favorite-form" method="POST">
                            @csrf
                            <input type="hidden" class="product-id" value="{{ $product->id }}">
                            <button type="button" class="favorite-button tooltip100"
                                data-tooltip="Add to favorite">
                                <i class="zmdi zmdi-favorite"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

    <!-- Modal1 -->
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
        <div class="overlay-modal1 js-hide-modal1"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <!-- زر الإغلاق للنافذة المنبثقة -->
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="{{ asset('assets/images/icons/icon-close.png') }}" alt="CLOSE">
                </button>

                <div  class="row">
                    <!-- قسم الصور -->
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="image-gallery">
                                    <!-- Main Product Image -->
                                    <div class="main-image">
                                        @if ($product->image)
                                            <img src="{{ asset('images/' . $product->image->path) }}"
                                                alt="Main Product Image">
                                        @else
                                            <img src="{{ asset('images/default-image.jpg') }}" alt="Default Product Image">
                                        @endif
                                    </div>

                                    <!-- Product Thumbnails -->
                                    <div class="thumbnails">
                                        @if ($product->gallery && $product->gallery->count() > 0)
                                            @foreach ($product->gallery as $img)
                                                <div class="thumbnail">
                                                    <img src="{{ asset('images/' . $img->path) }}" alt="Thumbnail Image">
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="thumbnail">
                                                <img src="{{ asset('images/default-thumbnail.jpg') }}"
                                                    alt="Default Thumbnail Image">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                   <!-- ✅ قسم تفاصيل المنتج -->
                 <!-- قسم تفاصيل المنتج -->
                <div  class="col-md-6 col-lg-5 p-b-30" style="padding-left: 30px;">
                    <div class="p-r-50 p-t-5 p-lr-0-lg"  style="padding-left: 30px;">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14 ">
                            {{ $product->trans_name }}
                        </h4>

                        <span id="final" class="mtext-106 cl2" data-price="{{ $product->price }}">
                            ${{ number_format($product->price, 2) }}
                        </span>


                        <p class="stext-102 cl3 p-t-23">
                            {{ $product->trans_description }}
                        </p>
                        <!-- ✅ خيارات المنتج -->
                        <div class="product-options">
                            <!-- خيار الحجم -->
                            <div class="option-group">
                                <div class="option-label"><i class="fa fa-arrows-alt"></i> {{ __('front.Size') }}</div>
                                <div class="option-select">
                                    <select name="size" id="size-select">
                                        <option disabled selected>{{ __('front.Choose an option') }}</option>
                                    </select>

                                </div>
                            </div>

                            <!-- خيار اللون -->
                            <div class="option-group">
                                <div class="option-label"><i class="fa fa-paint-brush"></i> {{ __('front.Color') }}</div>
                                <div class="option-select">


                                        <select name="color" id="color-select">
                                            <option disabled selected>{{ __('front.Choose an option') }}</option>
                                        </select>


                                </div>
                            </div>
                        </div>


                                <!-- كمية المنتج وزر الإضافة إلى السلة -->
                                <div class="quantity-content">
                                    <div class="left-content">
                                        <h6>
                                            {{ __('front.No') }}
                                        </h6>
                                    </div>
                                    <div class="right-content">
                                        <div class="quantity buttons_added">
                                            <!-- زر إنقاص الكمية -->
                                            <input type="button" value="-" class="minus">
                                            <!-- حقل إدخال الكمية -->
                                            <input type="button" step="1" min="1" max=""
                                                name="quantity" value="1" title="Qty" class="input-text qty text"
                                                size="4" pattern="" inputmode="">
                                            <!-- زر زيادة الكمية -->
                                            <input type="button" value="+" class="plus">
                                        </div>

                                    </div>
                                       <!-- زر إضافة إلى السلة -->
                                       <form id="cart-form" action="{{ route('front.carts.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1"> <!-- الكمية الافتراضية -->
                                        @if(auth()->check())
                                        <button type="submit" onclick="addToCart(event)" class="btn btn-primary">
                                            {{ __('front.Add') }}
                                        </button>
                                        @else
                                            <button class="add-to-cart disabled" onclick="showLoginAlert()">
                                                {{ __('front.Add') }}

                                            </button>
                                        @endif

                                    </form>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        $(document).ready(function () {
            let allVariants = [];

            $('.js-show-modal1').click(function (e) {
                e.preventDefault();

                const productId = $(this).data('id');
                const productPrice = $(this).data('price');

                // إعادة تعيين النموذج
                $('#cart-form input[name="product_id"]').val(productId);
                $('#cart-form input[name="quantity"]').val(1);
                $('.qty').val(1);
                $('#final').data('price', productPrice).text('$' + productPrice);

                // مسح الحقول
                $('.js-name-detail').text('');
                $('.mtext-106.cl2').text('');
                $('.stext-102.cl3').text('');
                $('#size-select').html('<option disabled selected>Choose size</option>');
                $('#color-select').html('<option disabled selected>Choose color</option>');

                // تحميل بيانات المنتج
                $.ajax({
                    url: '/product/' + productId,
                    type: 'GET',
                    success: function (response) {
                        // 1. البيانات العامة
                        $('.js-name-detail').text(response.name);
                        $('.mtext-106.cl2').text('$' + response.price);
                        $('.stext-102.cl3').text(response.description);

                        // 2. الصور
                        const mainImage = document.querySelector('.main-image img');
                        mainImage.src = response.image ? '/images/' + response.image : '/images/default-image.jpg';

                        const thumbnailsContainer = document.querySelector('.thumbnails');
                        thumbnailsContainer.innerHTML = '';

                        if (response.gallery.length > 0) {
                            response.gallery.forEach(img => {
                                const thumbnail = document.createElement('div');
                                thumbnail.classList.add('thumbnail');
                                thumbnail.innerHTML = `<img src="/images/${img.path}" alt="Thumbnail">`;

                                thumbnail.addEventListener('click', function () {
                                    mainImage.src = '/images/' + img.path;
                                });

                                thumbnailsContainer.appendChild(thumbnail);
                            });
                        } else {
                            const defaultThumb = document.createElement('div');
                            defaultThumb.classList.add('thumbnail');
                            defaultThumb.innerHTML = `<img src="/images/default-thumbnail.jpg" alt="Default">`;
                            thumbnailsContainer.appendChild(defaultThumb);
                        }

                        // 3. المتغيرات (variants)
                        allVariants = response.variants;

                        const sizes = [...new Set(allVariants.map(v => v.size))];
                        const colors = [...new Set(allVariants.map(v => v.color))];

                        $('#size-select').html('<option disabled selected>Choose size</option>');
                        sizes.forEach(size => {
                            $('#size-select').append(`<option value="${size}">${size}</option>`);
                        });

                        $('#color-select').html('<option disabled selected>Choose color</option>');
                        colors.forEach(color => {
                            $('#color-select').append(`<option value="${color}">${color}</option>`);
                        });
                    },
                    error: function () {
                        console.error('Error loading product details');
                    }
                });

                $('.js-modal1').addClass('show-modal1');
            });

            $('.js-hide-modal1').click(function () {
                $('.js-modal1').removeClass('show-modal1');
            });

            // عند تغيير الحجم
            $('#size-select').on('change', function () {
                const selectedSize = $(this).val();
                const matchedColors = allVariants
                    .filter(v => v.size === selectedSize && v.quantity > 0)
                    .map(v => v.color);

                const uniqueColors = [...new Set(matchedColors)];

                $('#color-select').html('<option disabled selected>Choose color</option>');
                uniqueColors.forEach(color => {
                    $('#color-select').append(`<option value="${color}">${color}</option>`);
                });
            });

            // عند تغيير اللون
            $('#color-select').on('change', function () {
                const selectedColor = $(this).val();
                const matchedSizes = allVariants
                    .filter(v => v.color === selectedColor && v.quantity > 0)
                    .map(v => v.size);

                const uniqueSizes = [...new Set(matchedSizes)];

                $('#size-select').html('<option disabled selected>Choose size</option>');
                uniqueSizes.forEach(size => {
                    $('#size-select').append(`<option value="${size}">${size}</option>`);
                });
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            // تحديث الكمية عند تغيير الزر (+) أو (-)
            $('.buttons_added .minus, .buttons_added .plus').click(function() {
                let input = $(this).parent().find('.qty'); // حقل إدخال الكمية
                let quantity = parseInt(input.val()) || 1;

                // التحقق من نوع الزر (plus أو minus)
                if ($(this).hasClass('minus') && quantity > 1) {
                    input.val(quantity - 1); // تقليل الكمية
                } else if ($(this).hasClass('plus')) {
                    input.val(quantity + 1); // زيادة الكمية
                }

                updateTotal();
                updateHiddenQuantity(input.val()); // تحديث الكمية في الحقل المخفي
            });

            // مستمع لتغيير الكمية يدويًا
            $('.qty').on('change', function() {
                let quantity = parseInt($(this).val()) || 1; // تأكد من إدخال قيمة صالحة
                if (quantity < 1) quantity = 1; // إعادة تعيين القيم السلبية إلى 1

                $(this).val(quantity); // تحديث الكمية في الحقل
                updateTotal();
                updateHiddenQuantity(quantity);
            });

            // فتح المودال وتحديث البيانات
            $('.js-show-modal1').click(function() {
                let price = $(this).data('price');

                // تحديث البيانات في المودال
                $('#final').data('price', price).text('$' + price.toFixed(2));
                $('.qty').val(1);

                updateTotal();
                updateHiddenQuantity(1); // إعادة تعيين الكمية المخفية إلى 1
            });

            // إغلاق المودال وإعادة تعيين الكمية
            $('.js-hide-modal1').click(function() {
                $('.qty').val(1);
                updateTotal();
                updateHiddenQuantity(1);
            });

            // تحديث حقل الكمية المخفي داخل النموذج
            function updateHiddenQuantity(quantity) {
                $('input[name="quantity"]').val(quantity);
            }

            // دالة لحساب وتحديث السعر الإجمالي
            function updateTotal() {
                let price = $('#final').data('price'); // جلب السعر
                let quantity = parseInt($('.qty').val()) || 1;

                // تحديث السعر النهائي
                $('#final').text('$' + (price * quantity).toFixed(2));
            }
        });

        // دالة لحساب وتحديث السعر الإجمالي
        function updateTotal() {
            // جلب السعر من الخاصية data-price كرقم عشري
            let price = $('#final').data('price');
            var quantity = parseInt($('.qty').val());

            // التحقق من صحة الكمية
            if (isNaN(quantity) || quantity < 1) {
                quantity = 1; // تعيين الكمية إلى 1 إذا لم تكن صالحة
            }

            // تحديث النص ليعرض السعر مع رمز الدولار
            $('#final').text('$' + (price * quantity).toFixed(2));
        }
    </script>

    <script>
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    $('#dataContainer').html($(response).find('#dataContainer').html());

                    $('.page-links').html($(response).find('.page-links').html());
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>

    <script>

        document.getElementById('searchForm').addEventListener('submit', function(e) {
            e.preventDefault(); // منع إعادة تحميل الصفحة

            const query = document.getElementById('query').value.trim(); // قيمة البحث
            const dataContainer = document.getElementById('dataContainer'); // الحاوية الخاصة بالمنتجات

            // عرض رسالة أثناء البحث داخل الحاوية
            dataContainer.innerHTML = '<p class="text-center">جاري البحث...</p>';

            // إرسال طلب البحث باستخدام AJAX
            fetch('{{ route('search') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        query: query
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    // مسح جميع المنتجات السابقة
                    dataContainer.innerHTML = '';

                    // التحقق من وجود منتجات
                    if (data.products && data.products.length > 0) {
                        data.products.forEach(product => {
                            const productHTML = `
                                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                                    <div class="block2">
                                        <div class="block2-pic hov-img0">
                                            <img src="${product.image ? '/images/' + product.image.path : '/images/default.jpg'}" alt="${product.trans_name || 'منتج'}">
                                            <a href="#"
                                                class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                                                data-id="${product.id}"
                                                data-price="${product.price}">Quick View</a>
                                        </div>
                                        <div class="block2-txt flex-w flex-t p-t-14">
                                            <div class="block2-txt-child1 flex-col-l">
                                                <a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                      ${JSON.parse(product.name)[document.documentElement.lang] || 'غير محدد'}
                                                </a>
                                                <span class="stext-105 cl3">
                                                    $${parseFloat(product.price).toFixed(2)}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            dataContainer.insertAdjacentHTML('beforeend', productHTML);
                        });
                    } else {
                        // عرض رسالة "لم يتم العثور على نتائج"
                        dataContainer.innerHTML = '<p class="text-center">لم يتم العثور على نتائج.</p>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching search results:', error);
                    dataContainer.innerHTML =
                        '<p class="text-center text-danger">حدث خطأ أثناء البحث. الرجاء المحاولة لاحقًا.</p>';
                });
        });
        document.getElementById('searchForm').addEventListener('submit', function() {
            document.querySelector('.search-btn').classList.add('loading');
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.search-btn').classList.remove('loading');
        });

    </script>

<script>
    $(document).ready(function() {
        // تحديث حالة الزر بناءً على حالة المفضلة
        $('.favorite-button').each(function() {
            const button = $(this);
            const productId = button.siblings('.product-id').val();

            $.ajax({
                url: "{{ route('front.favorites.isFavorite') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                },
                success: function(response) {
                    if (response.isFavorite) {
                        button.addClass('active'); // أضف اللون الأحمر إذا كان في المفضلة
                    }
                },
                error: function() {
                    console.error('Failed to fetch favorite status.');
                }
            });
        });

        $('.favorite-button').on('click', function(e) {
            e.preventDefault();
            const button = $(this);
            button.addClass('pulse'); // إضافة تأثير نبض
            setTimeout(() => button.removeClass('pulse'), 300); // إزالة التأثير بعد 300ms
        });

        // التعامل مع زر الإضافة/الإزالة من المفضلة
        $('.favorite-button').on('click', function(e) {
            e.preventDefault();

            const button = $(this);
            const productId = button.siblings('.product-id').val();

            $.ajax({
                url: "{{ route('front.favorites.toggle') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                },
                success: function(response) {
                    if (response.status === 'added') {
                        button.addClass('active'); // أضف اللون الأحمر
                        Swal.fire({
                            title: '👍 تمت الإضافة!',
                            text: response.message,
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    } else if (response.status === 'removed') {
                        button.removeClass('active'); // أزل اللون الأحمر
                        Swal.fire({
                            title: '❌ تم الإزالة!',
                            text: response.message,
                            icon: 'warning',
                            timer: 3000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        title: '🚨 خطأ!',
                        text: 'حدث خطأ، يرجى المحاولة مرة أخرى.',
                        icon: 'error',
                        timer: 3000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                }
            });
        });

        $(document).on('click', '.btn-remove', function(e) {
            e.preventDefault();

            const button = $(this);
            const productId = button.data('id');

            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع عن هذا!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'نعم، احذف!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/favorites/remove/${productId}`,
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function() {
                            button.closest('tr').remove(); // حذف الصف من الجدول
                            updateFavoritesCount(); // تحديث عداد المفضلة
                            Swal.fire(
                                'تم الحذف!',
                                'تم حذف المنتج من المفضلة.',
                                'success'
                            );
                        },
                        error: function() {
                            Swal.fire(
                                'خطأ!',
                                'فشل في حذف المنتج من المفضلة.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>

<script>
    function addToCart(event) {
        event.preventDefault();

        const form = event.target.closest('form');
        const formData = new FormData(form);

        fetch('{{ route('front.carts.add') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.message) {
                Swal.fire({
                    title: '🎉 تمت الإضافة!',
                    text: data.message,
                    icon: 'success',
                    timer: 4000,
                    showConfirmButton: false,
                    toast: true, // جعله إشعارًا صغيرًا في الزاوية
                    position: 'top-end', // يظهر في أعلى يمين الشاشة
                    allowOutsideClick: false, // منع الإغلاق عند النقر خارج النافذة
                    customClass: {
                        popup: 'custom-swal-popup'
                    }
                });

                // تحديث واجهة السلة بعد الإضافة
                updateCartView();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: '🚨 خطأ!',
                text: 'حدث خطأ أثناء إضافة المنتج إلى السلة.',
                icon: 'error',
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                allowOutsideClick: false,
                customClass: {
                    popup: 'custom-swal-popup'
                }
            });
        });
    }

    function updateCartView() {
        fetch('{{ route('front.carts') }}')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            Swal.fire({
                title: '🛒 تم التحديث!',
                text: 'تم تحديث سلة المشتريات.',
                icon: 'info',
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                allowOutsideClick: false,
                customClass: {
                    popup: 'custom-swal-popup'
                }
            });
        });
    }

    function showLoginAlert() {
        Swal.fire({
            title: '🔒 تسجيل الدخول مطلوب!',
            text: 'يرجى تسجيل الدخول لإتمام العملية.',
            icon: 'info',
            confirmButtonText: 'حسنًا',
            allowOutsideClick: false,
            toast: true,
            position: 'top-end',
            customClass: {
                popup: 'custom-swal-popup'
            }
        });
    }
</script>
