@extends('front.master')
@section('title', 'Carts')

@section('content')

@include('front.partials.carts')

<style>
/* === جدول السلة === */
.table-shopping-cart {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    border-radius: 8px;
    overflow: hidden;
    margin-bottom: 30px;
}

.table-shopping-cart th,
.table-shopping-cart td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #eee;
    font-size: 14px;
}

.table-shopping-cart th {
    background-color: #f7f7f7;
    font-weight: bold;
    font-size: 15px;
    color: #333;
}

.table-shopping-cart img {
    width: 100px;
    height: auto;
    border-radius: 8px;
    transition: transform 0.3s ease-in-out;
}

.table-shopping-cart img:hover {
    transform: scale(1.05);
}

.btn-remove {
    background-color: #ff4d4f;
    color: white;
    width: 35px;
    height: 35px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    font-size: 16px;
    transition: all 0.3s ease;
    text-decoration: none;
    margin: auto;
}

.btn-remove:hover {
    background-color: #d9363e;
    transform: scale(1.1);
}

.cart-summary {
    background-color: #fafafa;
    padding: 25px 30px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.07);
    margin-top: 20px;
    margin-left: 40px;

}

.cart-summary h4 {
    margin-bottom: 20px;
    font-size: 20px;
    font-weight: bold;
    color: #333;
}

.cart-summary a.flex-c-m {
    background-color: #111;
    color: white;
    padding: 10px 25px;
    border-radius: 25px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    display: inline-block;
    text-align: center;
    margin-top: 20px;
}

.cart-summary a.flex-c-m:hover {
    background-color: #444;
}

.btn-continue-shopping {
    display: inline-block;
    margin-top: 15px;
    padding: 8px 18px;
    border: 1px solid #555;
    border-radius: 25px;
    background-color: transparent;
    color: #333;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s ease;
}

.btn-continue-shopping:hover {
    background-color: #f5f5f5;
    color: #111;
}
</style>

<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="{{ route('front.index') }}" class="stext-109 cl8 hov-cl1 trans-04">
            {{ __('front.home') }}
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <span class="stext-109 cl4">
            {{ __('front.carts') }}
        </span>
    </div>
</div>

<!-- Cart -->
<form class="bg0 p-t-75 p-b-85">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <thead>
                                <tr>
                                    <th>{{ __('front.Image') }}</th>
                                    <th>{{ __('front.Product') }}</th>
                                    <th>{{ __('front.Price') }}</th>
                                    <th>{{ __('front.Quantity') }}</th>
                                    <th>{{ __('front.Total') }}</th>
                                    <th>{{ __('front.Remove') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($carts && count($carts) > 0)
                                    @foreach ($carts as $cart)
                                        <tr class="table_row">
                                            <td><img src="{{ $cart->product->image->path ? asset('images/' . $cart->product->image->path) : asset('images/default.jpg') }}" alt="{{ $cart->product->trans_name }}"></td>
                                            <td>{{ $cart->product->trans_name }}</td>
                                            <td>${{ $cart->product->price }}</td>
                                            <td>{{ $cart->quantity }}</td>
                                            <td class="column-5">${{ number_format($cart['price'] * $cart['quantity'], 2) }}</td>
                                            <td>
                                                <a href="#" class="btn-remove" onclick="confirmDelete(event, '{{ route('carts.remove', $cart->id) }}')">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="6">لا توجد عناصر في السلة.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                <div class="cart-summary">
                    <h4>{{ __('front.carttotals') }}</h4>
                    <div class="flex-w flex-t bor12 p-b-13">
                        <div class="size-208">
                            <span class="stext-110 cl2">{{ __('front.subtotal') }} :</span>
                        </div>
                        <div class="size-209">
                            <span id="cart-subtotal" class="mtext-110 cl2">$0.00</span>
                        </div>
                    </div>
                    <a href="{{ route('checkout.page') }}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                        ← {{ __('front.checkout') }}

                    </a>
                    <a href="{{ route('front.products') }}" class="btn-continue-shopping">
                        ← {{ __('front.continue_shopping') }}
                    </a>

                </div>
            </div>
        </div>
    </div>
</form>


@endsection

@section('js')
<script>
 function confirmDelete(event, deleteUrl) {
    event.preventDefault();

    Swal.fire({
        title: 'هل تريد حذف المنتج؟',
        text: "لن يمكنك التراجع بعد الحذف!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'نعم، احذف!',
        cancelButtonText: 'إلغاء'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    const row = event.target.closest('tr');
                    if (row) row.remove();

                    Swal.fire({
                        icon: 'success',
                        title: 'تم الحذف!',
                        text: 'تم حذف المنتج من السلة.',
                        timer: 1500,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire('خطأ', 'فشل في حذف المنتج.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('خطأ', 'حدث خطأ أثناء محاولة الحذف.', 'error');
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function () {
    calculateCartTotal();

    function calculateCartTotal() {
        let totalSum = 0;
        document.querySelectorAll('.column-5').forEach(cell => {
            const totalValue = parseFloat(cell.textContent.replace(/[^0-9.]/g, ''));
            if (!isNaN(totalValue)) {
                totalSum += totalValue;
            }
        });
        document.getElementById('cart-subtotal').textContent = `$${totalSum.toFixed(2)}`;
    }
});

</script>
@endsection
