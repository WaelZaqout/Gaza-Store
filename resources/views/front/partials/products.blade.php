<style>
    .image-gallery {
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .main-image {
        flex: 1;
        text-align: center;
    }

    .main-image img {
        width: 100%;
        max-width: 500px;
    }

    .thumbnails {
        display: flex;
        flex-direction: column;
        gap: 10px;
        position: absolute;
        left: -110px;
        top: 50%;
        transform: translateY(-50%);
    }

    .thumbnail img {
        width: 100px;
        height: auto;
        cursor: pointer;
    }

    .custom-select-field {
        appearance: none;
        /* إزالة الشكل الافتراضي */
        -webkit-appearance: none;
        /* إزالة الشكل الافتراضي لمتصفحات WebKit */
        -moz-appearance: none;
        /* إزالة الشكل الافتراضي لمتصفحات Firefox */
        background-color: #f5f5f5;
        /* لون الخلفية */
        border: 1px solid #ddd;
        /* لون الحدود */
        border-radius: 5px;
        /* زوايا مستديرة */
        padding: 10px 15px;
        /* مسافة داخلية */
        font-size: 14px;
        /* حجم النص */
        color: #333;
        /* لون النص */
        width: 100%;
        /* ملء عرض الحاوية */
        cursor: pointer;
        /* تغيير المؤشر */
        transition: border-color 0.3s, box-shadow 0.3s;
        /* تأثيرات الانتقال */
    }

    .custom-select-field:focus {
        border-color: #717fe0;
        /* لون الحدود عند التركيز */
        box-shadow: 0 0 5px rgba(113, 127, 224, 0.5);
        /* تأثير الظل عند التركيز */
        outline: none;
        /* إزالة الحدود الخارجية الافتراضية */
    }

    .custom-select-field::after {
        content: "▼";
        /* سهم مخصص */
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        /* منع التفاعل مع السهم */
        color: #717fe0;
        /* لون السهم */
    }

    <style>.quantity-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 15px;
    }

    .left-content h6 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
    }

    .right-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quantity.buttons_added {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .quantity.buttons_added input[type="number"] {
        width: 60px;
        text-align: center;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
    }

    .quantity.buttons_added input[type="button"] {
        background-color: #f5f5f5;
        border: 1px solid #ddd;
        border-radius: 4px;
        width: 30px;
        height: 30px;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .quantity.buttons_added input[type="button"]:hover {
        background-color: #e0e0e0;
    }

    .js-addcart-detail {
        margin-left: 15px;
        padding: 8px 20px;
        border: none;
        border-radius: 4px;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .js-addcart-detail:hover {
        background-color: #e5574f;
    }
</style>


<div class="row">
    @foreach ($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
            <div class="block2">
                <div class="block2-pic hov-img0">
                    <img src="{{ asset('images/' . ($product->image ? $product->image->path : 'default.jpg')) }}"
                        alt="IMG-PRODUCT">
                        <a href="#"
                        class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1"
                        data-id="{{ $product->id }}"
                        data-price="{{ $product->price }}">Quick View</a>
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

            <div class="row">
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
                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
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
                                <div class="size-203 flex-c-m respon6"><i class="fa fa-arrows-alt"></i> Size</div>
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
                                <div class="size-203 flex-c-m respon6"><i class="fa fa-paint-brush"></i> Color</div>
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
                                    <h6>No. of Orders</h6>
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
                                        <input type="hidden" name="product_id" value=""> <!-- يتم تحديثه ديناميكيًا -->
                                        <input type="hidden" name="product_name" value="">
                                        <input type="hidden" name="quantity" value=""> <!-- الكمية المبدئية -->
                                        <button type="submit" onclick="addToCart(event)" class="btn btn-primary">Add to cart</button>
                                    </form>




                                </div>
                            </div>

                            <!-- روابط التواصل الاجتماعي -->
                            <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                                <div class="flex-m bor9 p-r-10 m-r-11">
                                    <!-- نموذج إضافة المنتج إلى المفضلة -->
                                    <form id="favorite-form" action="{{ route('front.favorites') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 tooltip100"
                                            data-tooltip="Add to favorite" style="border: none; background: none; cursor: pointer;">
                                            <i class="zmdi zmdi-favorite"></i>
                                        </button>
                                    </form>
                                </div>

                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Share on Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Share on Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>

                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Share on Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
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
        $('.js-show-modal1').click(function (e) {
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
                success: function (response) {
                    $('.js-name-detail').text(response.name);
                    $('.mtext-106.cl2').text('$' + response.price);
                    $('.stext-102.cl3').text(response.description);

                    // تحديث الصورة الرئيسية
                    const mainImage = document.querySelector('.main-image img');
                    mainImage.src = response.image
                        ? '/images/' + response.image
                        : '/images/default-image.jpg';

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
                            thumbnail.addEventListener('click', function () {
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
                        thumbnail.addEventListener('click', function () {
                            mainImage.src = '/images/default-thumbnail.jpg';
                        });

                        thumbnailsContainer.appendChild(thumbnail);
                    }
                },
                error: function () {
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
    $(document).ready(function () {
        // تحديث الكمية عند تغيير الزر (+) أو (-)
        $('.buttons_added .minus, .buttons_added .plus').click(function () {
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
        $('.qty').on('change', function () {
            let quantity = parseInt($(this).val()) || 1; // تأكد من إدخال قيمة صالحة
            if (quantity < 1) quantity = 1; // إعادة تعيين القيم السلبية إلى 1

            $(this).val(quantity); // تحديث الكمية في الحقل
            updateTotal();
            updateHiddenQuantity(quantity);
        });

        // فتح المودال وتحديث البيانات
        $('.js-show-modal1').click(function () {
            let price = $(this).data('price');

            // تحديث البيانات في المودال
            $('#final').data('price', price).text('$' + price.toFixed(2));
            $('.qty').val(1);

            updateTotal();
            updateHiddenQuantity(1); // إعادة تعيين الكمية المخفية إلى 1
        });

        // إغلاق المودال وإعادة تعيين الكمية
        $('.js-hide-modal1').click(function () {
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
    function addToCart(event) {
        event.preventDefault();

        // تحديث الكمية من الحقل
        const quantity = document.querySelector('.qty').value;

        // تحديث حقل الكمية داخل النموذج
        document.querySelector('input[name="quantity"]').value = quantity;

        // إرسال النموذج
        document.getElementById('cart-form').submit();
    }

</script>

<script>
    function addToFavorite(event) {
        event.preventDefault();

        // تحديث الكمية من الحقل
        const quantity = document.querySelector('.qty').value;

        // تحديث حقل الكمية داخل النموذج
        document.querySelector('input[name="quantity"]').value = quantity;

        // إرسال النموذج
        document.getElementById('cart-form').submit();
    }

</script>
