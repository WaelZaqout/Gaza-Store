   <!-- Cart -->
   <div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <!-- تحقق من وجود المنتجات في السلة -->
        @if ($carts && count($carts) > 0)
            <div class="header-cart-content flex-w js-pscroll">
                @foreach ($carts as $cart)
                    <ul class="header-cart-wrapitem w-full">
                        <li class="header-cart-item flex-w flex-t m-b-12" style="display: flex; align-items: center; justify-content: space-between;">
                            <!-- صورة المنتج -->
                            <div class="header-cart-item-img" style="flex: 0 0 auto;">
                                <img src="{{ $cart->product->image->path
                                ? asset('images/' . $cart->product->image->path)
                                : asset('images/default.jpg') }}"
                                alt="{{ $cart->product->trans_name }}"
                                style="width: 100px; height: auto; padding-right: 20px;">
                             </div>

                            <!-- تفاصيل المنتج -->
                            <div class="header-cart-item-txt" style="flex: 1; padding-left: 20px; display: flex; align-items: center; justify-content: space-between;">
                                <!-- اسم المنتج -->
                                <a href="#" class="header-cart-item-name" style="font-weight: bold; font-size: 15px; text-decoration: none; color: #000;">
                                    {{ $cart->product->trans_name }}
                                </a>

                                <!-- الكمية والسعر -->
                                <span class="header-cart-item-info" style="font-size: 14px; color: #555;">
                                    {{ $cart->quantity }} x ${{ number_format($cart->product->price, 2) }}
                                </span>
                            </div>


                        </li>
                    </ul>
                @endforeach

                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40">
                        Total: ${{ number_format($carts->sum(function($cart) { return $cart->product->price * $cart->quantity; }), 2) }}
                    </div>

                    <div class="header-cart-buttons flex-w w-full">
                        <a href="{{ route('front.carts') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            View Cart
                        </a>

                        <a href="#" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Check Out
                        </a>
                    </div>
                </div>
            </div>
        @else
            <p>Your cart is empty.</p>
        @endif

    </div>

</div>

<script>
 document.addEventListener("DOMContentLoaded", function () {
    const cartIcon = document.querySelector('.icon-header-noti');

    // وظيفة لتحديث عدد المنتجات في السلة
    function updateCartCount() {
        fetch('/cart/count') // مسار مخصص للحصول على عدد المنتجات
            .then(response => response.json())
            .then(data => {
                cartIcon.setAttribute('data-notify', data.count);
            })
            .catch(error => console.error('Error updating cart count:', error));
    }

    // تحديث العدد عند تحميل الصفحة
    updateCartCount();
    // يمكن استدعاء هذه الوظيفة يدويًا عند إضافة أو حذف منتج
    document.querySelectorAll('.btn-remove').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();  // منع الرابط من التنفيذ الافتراضي

            const url = button.getAttribute('href');

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
            })
            .then(response => {
                if (response.ok) {
                    button.closest('li').remove(); // حذف العنصر من الواجهة
                    updateCartCount();  // تحديث العدد في الـ cart icon
                    alert('تم حذف المنتج بنجاح');
                } else {
                    alert('فشل في حذف المنتج.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});


</script>
