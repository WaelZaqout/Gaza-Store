@extends('admin.master')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Order Details - #{{ $order->id }}</h1>

    <table class="table table-bordered">
        <tr>
            <th>Order ID</th>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <th>User</th>
            <td>{{ $order->user->name }}</td>
        </tr>
        <tr>
            <th>Total Price</th>
            <td>${{ number_format($order->total_price, 2) }}</td>
        </tr>
        <tr>
            <th>Payment Status</th>
            <td>{{ $order->payments ? $order->payments->status : 'Pending' }}</td>
        </tr>
    </table>

    <h3 class="mt-4">Order Items</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->order_details as $detail)
                <tr>
                    <td><img src="{{ $detail->product->image->path
                        ? asset('images/' . $detail->product->image->path)
                        : asset('images/default.jpg') }}"
                        alt="{{ $detail->product->trans_name }}"
                        style="width: 100px; height: auto;"></td>
                    <td>{{ $detail->product->trans_name }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>${{ number_format($detail->price, 2) }}</td>
                    <td>${{ number_format($detail->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary mt-3">Back to Orders</a>
@endsection
