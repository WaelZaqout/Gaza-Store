@extends('front.master')
@section('title', 'Carts')

@section('content')

@include('front.partials.carts')


    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                <a href="{{ route('front.index') }}"> {{ __('front.home') }}</>

                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                <a href="{{ route('front.carts') }}"> {{ __('front.carts') }}</>

            </span>
        </div>
    </div>


    <!--  Cart -->
    <form class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">

                            <table class="table-shopping-cart">
                                <thead>
                                    <tr>
                                    <tr>
                                        <th class="column-1"
                                            style="padding: 10px 15px; text-align: center; font-weight: bold; font-size: 16px; background-color: #f5f5f5; border-bottom: 2px solid #ddd;">
                                             {{ __('front.Image') }}
                                        </th>
                                        <th class="column-2"
                                            style="padding: 10px 15px; text-align: center; font-weight: bold; font-size: 16px; background-color: #f5f5f5; border-bottom: 2px solid #ddd;">
                                             {{ __('front.Product') }}</th>

                                             <th class="column-3"
                                             style="padding: 10px 15px; text-align: center; font-weight: bold; font-size: 16px; background-color: #f5f5f5; border-bottom: 2px solid #ddd;">
                                              {{ __('front.Price') }}</th>

                                              <th class="column-3"
                                              style="padding: 10px 15px; text-align: center; font-weight: bold; font-size: 16px; background-color: #f5f5f5; border-bottom: 2px solid #ddd;">
                                               {{ __('front.Quantity') }}</th>

                                               <th class="column-3"
                                               style="padding: 10px 15px; text-align: center; font-weight: bold; font-size: 16px; background-color: #f5f5f5; border-bottom: 2px solid #ddd;">
                                                {{ __('front.Total') }}</th>

                                        <th class="column-6"
                                            style="padding: 10px 15px; text-align: center; font-weight: bold; font-size: 16px; background-color: #f5f5f5; border-bottom: 2px solid #ddd;">
                                             {{ __('front.Remove') }}</th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($carts && count($carts) > 0)
                                    @foreach ($carts as $cart)
                                        <tr class="table_row">
                                            <!-- صورة المنتج -->
                                            <td class="column-2"
                                                style="padding: 10px 15px; font-weight: bold; text-align: center;">
                                                <img src="{{ $cart->product->image->path
                                                    ? asset('images/' . $cart->product->image->path)
                                                    : asset('images/default.jpg') }}"
                                                    alt="{{ $cart->product->trans_name }}"
                                                    style="width: 100px; height: auto;">

                                            </td>
                                            <!-- اسم المنتج -->
                                            <td class="column-2"
                                                style="padding: 10px 15px; font-weight: bold; text-align: center;">
                                                {{ $cart->product->trans_name }}</td>
                                            <!-- السعر -->
                                            <td class="column-2"
                                                style="padding: 10px 15px; font-weight: bold; text-align: center;">
                                                ${{ $cart->product->price }}</td>

                                                <td class="column-2"
                                                style="padding: 10px 15px; font-weight: bold; text-align: center;">
                                                {{ $cart->quantity }}</td>

                                                   <td class="column-5"
                                                   style="padding: 10px 15px; font-weight: bold; text-align: center;">
                                                   ${{ number_format($cart['price'] * $cart['quantity'], 2) }}
                                                  </td>

                                                <td class="column-6" style="padding: 10px; text-align: center;">
                                                    <a href="#"
                                                        class="btn-remove"
                                                        onclick="confirmDelete(event, '{{ route('carts.remove', $cart->id) }}')"
                                                        style="
                                                            background-color: #ff4d4d;
                                                            color: white;
                                                            width: 25px;
                                                            height: 25px;
                                                            display: flex;
                                                            justify-content: center;
                                                            align-items: center;
                                                            border-radius: 50%;
                                                            font-size: 16px;
                                                            text-decoration: none;
                                                            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                                                            transition: all 0.3s ease;">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>


                                        </tr>
                                    @endforeach
                                    @else
                                        <p>لا توجد عناصر في السلة.</p>
                                    @endif
                                </tbody>

                            </table>

                        </div>


                    </div>
                </div>

            </div>
            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Cart Totals
                    </h4>
                    <!-- Subtotal -->
                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">Subtotal:</span>
                        </div>
                        <div class="size-209">
                            <span id="cart-subtotal" class="mtext-110 cl2">$0.00</span>
                        </div>
                    </div>
                    <a  href="{{ route('checkout.page') }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" >
                        Checkout
                    </a>

                </div>
            </div>
        </div>
    </form>




@section('js')
    <script>
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.getAttribute('data-product-id');

                if (confirm('هل أنت متأكد من حذف هذا المنتج؟')) {
                    // إرسال الطلب إلى الخادم لحذف المنتج
                    fetch(`/remove-from-cart/${productId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert('تم حذف المنتج بنجاح!');
                                // حذف الصف من الجدول
                                this.closest('tr').remove();
                                // يمكن تحديث الإجمالي إذا لزم الأمر
                                updateCartTotal();
                            } else {
                                alert('تعذر حذف المنتج.');
                            }
                        })
                        .catch(error => {
                            console.error('خطأ أثناء الحذف:', error);
                        });
                }
            });
        });

        // لتحديث الإجمالي إذا لزم الأمر
        function updateCartTotal() {
            let total = 0;
            document.querySelectorAll('.column-5').forEach(cell => {
                const price = parseFloat(cell.textContent.replace('$', ''));
                total += price;
            });
            document.querySelector('#cart-total').textContent = `$${total.toFixed(2)}`;
        }
    </script>

    <script>
        function confirmDelete(event, deleteUrl) {
        event.preventDefault(); // منع السلوك الافتراضي للنقرة

        if (confirm('هل تريد الحذف؟')) { // نافذة تأكيد الحذف
            fetch(deleteUrl, {
                method: 'DELETE', // طريقة الحذف DELETE
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json', // تحديد نوع البيانات
                },
            })
            .then(response => {
                if (response.ok) {
                    // حذف الصف المرتبط بالزر
                    const button = event.target.closest('tr');
                    if (button) button.remove(); // حذف العنصر من الواجهة
                } else {
                    alert('فشل في حذف المنتج.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('حدث خطأ أثناء محاولة الحذف.');
            });
        }
        }

    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            calculateCartTotal(); // استدعاء الدالة عند تحميل الصفحة

            function calculateCartTotal() {
                let totalSum = 0; // مجموع التوتال

                // البحث عن جميع القيم في عمود التوتال (column-5) وجمعها
                document.querySelectorAll('.column-5').forEach(cell => {
                    const totalValue = parseFloat(cell.textContent.replace(/[^0-9.]/g,
                        '')); // إزالة أي رموز غير رقمية
                    if (!isNaN(totalValue)) {
                        totalSum += totalValue; // إضافة القيمة إلى المجموع
                    }
                });

                // تحديث القيم في الحقول Subtotal و Total
                document.getElementById('cart-subtotal').textContent = `$${totalSum.toFixed(2)}`;
            }
        });
    </script>
@endsection
@endsection
