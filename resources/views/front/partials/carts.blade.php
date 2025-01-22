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
           @if (session('cart'))

               <div class="header-cart-content flex-w js-pscroll">
                @foreach (session('cart') as $id => $item)
                <ul class="header-cart-wrapitem w-full">
                    <li class="header-cart-item flex-w flex-t m-b-12" style="display: flex; align-items: center; justify-content: space-between;">
                        <!-- صورة المنتج -->
                        <div class="header-cart-item-img" style="flex: 0 0 auto;">
                            <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                style="width: 80px; height: auto; border-radius: 8px;">
                        </div>

                        <!-- تفاصيل المنتج -->
                        <div class="header-cart-item-txt" style="flex: 1; padding-left: 20px; display: flex; align-items: center; justify-content: space-between;">
                            <!-- اسم المنتج -->
                            <a href="#" class="header-cart-item-name" style="font-weight: bold; font-size: 16px; text-decoration: none; color: #000;">
                                {{ $item['name'] }}
                            </a>

                            <!-- الكمية والسعر -->
                            <span class="header-cart-item-info" style="font-size: 14px; color: #555;">
                                {{ $item['quantity'] }} x ${{ number_format($item['price'], 2) }}
                            </span>
                        </div>

                        <!-- أيقونة الحذف -->
                        <a href="{{ route('cart.remove', $id) }}" class="btn-remove"
                            style="
                                background-color: #ff4d4d;
                                color: white;
                                width: 30px;
                                height: 30px;
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                border-radius: 50%;
                                font-size: 14px;
                                text-decoration: none;
                                margin-left: 15px;
                                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                                transition: all 0.3s ease;">
                            <i class="fa fa-trash"></i>
                        </a>
                    </li>
                </ul>
            @endforeach


                   <div class="w-full">
                       <div class="header-cart-total w-full p-tb-40">
                           Total: ${{ number_format($item['price'] * $item['quantity'], 2) }}
                       </div>

                       <div class="header-cart-buttons flex-w w-full">
                           <a href="{{ route('front.shoping') }}"
                               class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                               View Cart
                           </a>

                           <a href="{{ route('front.shoping') }}"
                               class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
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
});

</script>
