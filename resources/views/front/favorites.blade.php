@extends('front.master')
@section('title', 'Favorites')

@section('content')

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

            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full">
                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="{{ asset('assets/images/item-cart-01.jpg') }}" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                White Shirt Pleat
                            </a>

                            <span class="header-cart-item-info">
                                1 x $19.00
                            </span>
                        </div>
                    </li>

                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="{{ asset('assets/images/item-cart-02.jpg') }}" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                Converse All Star
                            </a>

                            <span class="header-cart-item-info">
                                1 x $39.00
                            </span>
                        </div>
                    </li>

                    <li class="header-cart-item flex-w flex-t m-b-12">
                        <div class="header-cart-item-img">
                            <img src="{{ asset('assets/images/item-cart-03.jpg') }}" alt="IMG">
                        </div>

                        <div class="header-cart-item-txt p-t-8">
                            <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                Nixon Porter Leather
                            </a>

                            <span class="header-cart-item-info">
                                1 x $17.00
                            </span>
                        </div>
                    </li>
                </ul>

                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40">
                        Total: $75.00
                    </div>

                    <div class="header-cart-buttons flex-w w-full">
                        <a href="shoping-cart.html"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            View Cart
                        </a>

                        <a href="shoping-cart.html"
                            class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Check Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
                <a href="{{ route('front.index') }}"> {{ __('front.home') }}</>

                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
                <a href="{{ route('front.favorites') }}"> {{ __('front.favorites') }}</>

            </span>
        </div>
    </div>


    <!-- Shoping Cart -->
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

                                        <th class="column-6"
                                            style="padding: 10px 15px; text-align: center; font-weight: bold; font-size: 16px; background-color: #f5f5f5; border-bottom: 2px solid #ddd;">
                                             {{ __('front.Remove') }}</th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($favorites as $favorite)
                                        <tr class="table_row">
                                            <!-- صورة المنتج -->
                                            <td class="column-2"
                                                style="padding: 10px 15px; font-weight: bold; text-align: center;">
                                                <img src="{{ $favorite->product->image->path
                                                    ? asset('images/' . $favorite->product->image->path)
                                                    : asset('images/default.jpg') }}"
                                                    alt="{{ $favorite->product->trans_name }}"
                                                    style="width: 100px; height: auto;">

                                            </td>
                                            <!-- اسم المنتج -->
                                            <td class="column-2"
                                                style="padding: 10px 15px; font-weight: bold; text-align: center;">
                                                {{ $favorite->product->trans_name }}</td>
                                            <!-- السعر -->
                                            <td class="column-2"
                                                style="padding: 10px 15px; font-weight: bold; text-align: center;">
                                                ${{ $favorite->product->price }}</td>

                                                <td class="column-6" style="padding: 10px; text-align: center;">
                                                    <a href="#"
                                                        class="btn-remove"
                                                        onclick="confirmDelete(event, '{{ route('favorites.remove', $favorite->id) }}')"
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
                                </tbody>

                            </table>

                        </div>


                    </div>
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
@endsection
@endsection
