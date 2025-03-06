    <!DOCTYPE html>
    <html>
    <head>
        <title>Checkout</title>
        <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
        <script src="https://js.stripe.com/v3/"></script>
    </head>
    <body>

        <section class="cart-container">
            <div class="products-box" id="products-box">
                @foreach ($carts as $cart)
                    <div class="product" data-price="{{ $cart['price'] }}" data-quantity="{{ $cart['quantity'] }}">
                        <img src="{{ $cart->product->image->path
                        ? asset('images/' . $cart->product->image->path)
                        : asset('images/default.jpg') }}" alt="{{ $cart->product->trans_name }}">

                        <div class="description">
                            <h3>{{ $cart->product->trans_name }}</h3>
                            <h5 class="product-price">${{ number_format($cart['price'] * $cart['quantity'], 2) }}</h5>
                        </div>
                    </div>
                @endforeach
            </div>

        <!-- Subtotal -->
            <div class="subtotal-box">
                <div class="subtotal-header">
                    <span class="stext-110 cl2">Subtotal:</span>
                </div>
                <div class="subtotal-value">
                    <span id="cart-subtotal" class="mtext-110 cl2">$0.00</span>
                </div>
            </div>

            <form action="{{ route('checkout.process') }}" method="POST" id="payment-form">
                @csrf
                <!-- زر الدفع الإلكتروني -->
                <button type="submit" id="checkout-button" name="payment_method" value="online">Checkout (Online Payment)</button>

                <!-- زر الدفع عند التسليم -->
                <button type="submit" id="cod-button" name="payment_method" value="cod">Checkout (Cash on Delivery)</button>
            </form>


        </section>

        <script>
            // حساب الإجمالي
            function calculateTotal() {
                let total = 0;
                const products = document.querySelectorAll('.product');

                products.forEach(product => {
                    const price = parseFloat(product.getAttribute('data-price'));
                    const quantity = parseInt(product.getAttribute('data-quantity'));
                    total += price * quantity;
                });

                // تحديث التوتال في واجهة المستخدم
                document.getElementById('cart-subtotal').textContent = `$${total.toFixed(2)}`;
            }

            // استدعاء دالة حساب الإجمالي عند تحميل الصفحة
            document.addEventListener('DOMContentLoaded', calculateTotal);
        </script>

    </body>
    </html>
