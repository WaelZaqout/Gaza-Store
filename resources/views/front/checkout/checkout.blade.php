
<!DOCTYPE html>
<html>
  <head>
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <section>
      <div class="product">
        <img src="https://i.imgur.com/EHyR2nP.png" alt="Product Image" />
        <div class="description">
          <h3>Product Name</h3>
          <h5>$20.00</h5>
        </div>
      </div>
      <form action="{{ route('checkout.process') }}" method="POST" id="payment-form">
        @csrf
        <button type="submit" id="checkout-button">Checkout</button>
      </form>
    </section>
  </body>
</html>
