<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Invoice Number {{ $invoice->invoice_number }}</title>
    <style>
        @font-face {
            font-family: 'Cairo';
            font-style: normal;
            font-weight: normal;
            src: url({{ storage_path('fonts/Cairo-Regular.ttf') }}) format('truetype');
        }
        body {
            font-family: 'Cairo', sans-serif;
            direction: ltr;
            text-align: left;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .invoice-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            text-align: center;
            color: #333;
        }
        hr {
            border: 1px solid #ddd;
        }
        p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        td {
            background-color: #f8f9fa;
        }
        .total {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <h2>Invoice Number: {{ $invoice->invoice_number }}</h2>

        <h3> Customer Information</h3>
        <p><strong>Name:</strong> {{ $invoice->user->name ?? 'N/A' }}</p>
        <p><strong> Address:</strong> {{ $invoice->user->address }}</p>
        <p><strong> Phone:</strong> {{ $invoice->user->phone }}</p>
        <p><strong> Email:</strong> {{ $invoice->user->email  }}</p>
        <hr>

        <h3> Invoice Details</h3>
        <p><strong> Invoice Date:</strong> {{ $invoice->invoice_date }}</p>
        <p><strong> Due Date:</strong> {{ $invoice->due_date }}</p>
        <p><strong> Status:</strong> {{ $invoice->status }}</p>
        <hr>

        <h3> Order Items</h3>
        <table>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            @foreach ($invoice->order->order_details as $detail)
            <tr>
                <td>{{ $detail->product->id }}</td>

                <td>{{ $detail->product->trans_name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>${{ number_format($detail->price, 2) }}</td>
                <td><strong>${{ number_format($detail->total, 2) }}</strong></td>
            </tr>
            @endforeach
        </table>
        <hr>

        <h3> Payment Summary</h3>
        <table>
            <tr>
                <th>Details</th>
                <th>Amount</th>
            </tr>
            <tr>
                <td> Amount Collected</td>
                <td>${{ number_format($invoice->amount_collection, 2) }}</td>
            </tr>
            <tr>
                <td> VAT ({{ $invoice->rate_vat }}%)</td>
                <td>${{ number_format($invoice->value_vat, 2) }}</td>
            </tr>
            <tr class="total">
                <td>💵 Total</td>
                <td>${{ number_format($invoice->total, 2) }}</td>
            </tr>
        </table>
        <hr>

        <h3> Payment Method</h3>
        <p><strong>🛠 Method:</strong> {{ $invoice->payment_method }}</p>
        <p><strong> Transaction ID:</strong> {{ $invoice->transaction_id }}</p>
        <hr>

        <h3> Notes</h3>
        <p>{{ $invoice->notes }}</p>
    </div>
</body>
</html>
