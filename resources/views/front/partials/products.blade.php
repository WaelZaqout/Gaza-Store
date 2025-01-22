<style>
    /* البحث */
    .search-container {
        margin: 20px auto;
        display: flex;
        justify-content: flex-end;
        /* الحفاظ على المحاذاة */
        align-items: center;
        gap: 10px;
        padding-right: 20px;
    }

    .search-form {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-left: 330px;
    }

    .search-input {
        width: 300px;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        border-color: #5a67d8;
        box-shadow: 0 0 5px rgba(90, 103, 216, 0.5);
    }

    .search-button {
        padding: 10px 20px;
        background-color: #5a67d8;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-button:hover {
        background-color: #434bb4;
    }

    /* المنتجات */
    .products-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-top: 30px;
        padding: 0 20px;
    }

    .product-card {
        width: 250px;
        border: 1px solid #ddd;
        border-radius: 10px;
        overflow: hidden;
        background-color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .product-card:hover {
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        transform: translateY(-5px);
    }

    .product-image {
        position: relative;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .quick-view {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        background-color: rgba(0, 0, 0, 0.6);
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        opacity: 0;
        transition: all 0.3s ease;
    }

    .product-image:hover .quick-view {
        opacity: 1;
    }

    .product-info {
        padding: 15px;
        text-align: center;
    }

    .product-name {
        font-size: 18px;
        color: #333;
        margin: 10px 0;
    }

    .product-price {
        font-size: 16px;
        color: #5a67d8;
        font-weight: bold;
    }
    .favorite-button {
    color: #333; /* اللون الافتراضي */
    transition: color 0.3s ease;
    }

    .favorite-button.active {
        color: red; /* اللون عند الإضافة للمفضلة */
    }

</style>


<div class="row">
    @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="{{ $product->image ? asset('images/' . $product->image->path) : asset('images/default.jpg') }}"
                        alt="IMG-PRODUCT">

                    <a href="#"
                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                        data-id="{{ $product->id }}" data-price="{{ $product->price }}">Quick View</a>
                </div>
                <div class="block2-txt flex-w flex-t p-t-14">
                    <div class="block2-txt-child1 flex-col-l">
                        <a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                            {{ $product->trans_name }}
                        </a>
                        <span class="stext-105 cl3">
                            {{ $product->price }}
                        </span>

                    </div>

                </div>
                <div class="flex-m bor9 p-r-10 m-r-11">
                    <!-- نموذج إضافة المنتج إلى المفضلة -->
                    <form class="favorite-form" method="POST">
                        @csrf
                        <input type="hidden" class="product-id" value="{{ $product->id }}">
                        <button type="button" class="favorite-button fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 tooltip100"
                            data-tooltip="Add to favorite"
                            style="border: none; background: none; cursor: pointer; padding-left: 250px; bottom: 30px; font-size: x-large;">
                            <i class="zmdi zmdi-favorite"></i>
                        </button>
                    </form>
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

                        <!-- خيارات المنتج -->
                        <div class="p-t-33">
                            <!-- خيار الحجم -->
                            <div class="flex-w flex-r-m p-b-20">
                                <div class="size-203 flex-c-m respon6"><i class="fa fa-arrows-alt"></i>
                                    {{ __('front.Size') }}
                                </div>
                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="custom-select-field">
                                            <option>Choose an option</option>
                                            <option>Size S</option>
                                            <option>Size M</option>
                                            <option>Size L</option>
                                            <option>Size XL</option>
                                        </select>

                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- خيار اللون -->
                            <div class="flex-w flex-r-m p-b-20">
                                <div class="size-203 flex-c-m respon6"><i class="fa fa-paint-brush"></i>
                                    {{ __('front.Color') }}
                                </div>
                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bor8 bg0">
                                        <select class="custom-select-field">
                                            <option>Choose an option</option>
                                            <option>Red</option>
                                            <option>Blue</option>
                                            <option>White</option>
                                            <option>Grey</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
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
                                    <!-- زر إضافة إلى السلة -->
                                    <form id="cart-form" action="{{ route('front.shoping') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="">
                                        <!-- يتم تحديثه ديناميكيًا -->
                                        <input type="hidden" name="product_name" value="">
                                        <input type="hidden" name="quantity" value="">
                                        <!-- الكمية المبدئية -->
                                        <button type="submit" onclick="addToCart(event)" class="btn btn-primary">
                                            {{ __('front.Add') }}
                                        </button>
                                    </form>



                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function() {
        $('.js-show-modal1').click(function(e) {
            e.preventDefault();

            var productId = $(this).data('id');
            var productPrice = $(this).data('price');

            // تحديث حقول النموذج المخفية داخل المودال
            $('#cart-form input[name="product_id"]').val(productId);
            $('#cart-form input[name="quantity"]').val(1); // إعادة تعيين الكمية إلى 1

            // تحديث السعر والمعرف المعروضين في المودال
            $('#final').data('price', productPrice).text('$' + productPrice);
            $('.qty').val(1);

            // تحديث تفاصيل المنتج عبر AJAX
            $.ajax({
                url: '/product/' + productId,
                type: 'GET',
                success: function(response) {
                    $('.js-name-detail').text(response.name);
                    $('.mtext-106.cl2').text('$' + response.price);
                    $('.stext-102.cl3').text(response.description);

                    // تحديث الصورة الرئيسية
                    const mainImage = document.querySelector('.main-image img');
                    mainImage.src = response.image ?
                        '/images/' + response.image :
                        '/images/default-image.jpg';

                    // تحديث الصور المصغرة
                    const thumbnailsContainer = document.querySelector('.thumbnails');
                    thumbnailsContainer.innerHTML = ''; // مسح الصور السابقة

                    if (response.gallery && response.gallery.length > 0) {
                        response.gallery.forEach(img => {
                            const thumbnail = document.createElement('div');
                            thumbnail.classList.add('thumbnail');
                            thumbnail.innerHTML = `
                                <img src="/images/${img.path}" alt="Thumbnail Image">
                            `;

                            // إضافة حدث عند الضغط على الصورة المصغرة لتحديث الصورة الرئيسية
                            thumbnail.addEventListener('click', function() {
                                mainImage.src = '/images/' + img.path;
                            });

                            thumbnailsContainer.appendChild(thumbnail);
                        });
                    } else {
                        // عرض صورة مصغرة افتراضية
                        const thumbnail = document.createElement('div');
                        thumbnail.classList.add('thumbnail');
                        thumbnail.innerHTML = `
                            <img src="/images/default-thumbnail.jpg" alt="Default Thumbnail Image">
                        `;

                        // إضافة حدث عند الضغط على الصورة المصغرة الافتراضية
                        thumbnail.addEventListener('click', function() {
                            mainImage.src = '/images/default-thumbnail.jpg';
                        });

                        thumbnailsContainer.appendChild(thumbnail);
                    }
                },
                error: function() {
                    console.error('Error loading product details');
                }
            });

            $('.js-modal1').addClass('show-modal1');
        });
        // إخفاء المودال عند الضغط على زر الإغلاق
        $('.js-hide-modal1').click(function() {
            $('.js-modal1').removeClass('show-modal1');
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
                // تحديث محتوى الحاوية فقط
                $('#dataContainer').html($(response).find('#dataContainer').html());

                // تحديث روابط التصفح
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
                                                ${product.name || 'غير محدد'}
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
                        } else if (response.status === 'removed') {
                            button.removeClass('active'); // أزل اللون الأحمر
                        }
                        alert(response.message);
                    },
                    error: function() {
                        alert('Something went wrong. Please try again.');
                    }
                });
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

</script>
