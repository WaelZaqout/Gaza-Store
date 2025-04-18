@extends('admin.master')

@section('title', __('admin.print_orders'))

@section('content')
<style>
    .invoice-box {
        padding: 30px;
        font-size: 16px;
        color: #555;
        background: #fff;
    }

    .invoice-header {
        border-bottom: 2px solid #333;
        margin-bottom: 30px;
    }

    .order-box {
        border: 1px solid #ccc;
        padding: 20px;
        margin-bottom: 40px;
        border-radius: 10px;
        background-color: #f9f9f9;
    }

    .order-box h5 {
        font-weight: bold;
        margin-bottom: 15px;
        color: #007bff;
    }

    .table th {
        background-color: #343a40;
        color: white;
    }

    .summary-box {
        border-top: 2px solid #000;
        padding-top: 20px;
    }

    @media print {
        body * {
            visibility: hidden;
        }

        .invoice-box, .invoice-box * {
            visibility: visible;
        }

        .invoice-box {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }

        .sidebar, .navbar, footer, .btn, .sidebar-dark {
            display: none !important;
        }

        body {
            background: white !important;
        }
    }
</style>

<div class="invoice-box">
    <div class="invoice-header">
        <h3>{{ __('admin.all_orders_invoice') }}</h3>
        <p><strong>{{ __('admin.name') }}:</strong> {{ $customer->name }}</p>
        <p><strong>{{ __('admin.phone') }}:</strong> {{ $customer->phone ?? __('admin.not_available') }}</p>
        <p><strong>{{ __('admin.email') }}:</strong> {{ $customer->email }}</p>
    </div>

    @foreach($customer->orders as $order)
    <div class="order-box">
        <h5>{{ __('admin.order_id') }}: #{{ $order->id }}</h5>
        <p><strong>{{ __('admin.status') }}:</strong>
            <span class="badge {{ $order->status === 'paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                {{ __('admin.' . $order->status) }}
            </span>
        </p>
        <p><strong>{{ __('admin.order_date') }}:</strong> {{ $order->created_at->format('Y-m-d') }}</p>
        <p><strong>{{ __('admin.total_amount') }}:</strong> ${{ number_format($order->total_price, 2) }}</p>

        <table class="table table-bordered mt-3 text-center">
            <thead>
                <tr>
                    <th>{{ __('admin.product_name') }}</th>
                    <th>{{ __('admin.quantity') }}</th>
                    <th>{{ __('admin.price') }}</th>
                    <th>{{ __('admin.total') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->order_details as $item)
                <tr>
                    <td>{{ $item->product->trans_name ?? __('admin.not_available') }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ number_format($item->price, 2) }}</td>
                    <td>${{ number_format($item->total, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endforeach

    {{-- Summary --}}
    <div class="summary-box">
        <h5>{{ __('admin.orders_summary') }}</h5>
        <p><strong>{{ __('admin.total_orders') }}:</strong> {{ $customer->orders->count() }}</p>
        <p><strong>{{ __('admin.total_spent') }}:</strong> ${{ number_format($customer->orders->sum('total_price'), 2) }}</p>
        <p><strong>{{ __('admin.average_order') }}:</strong> ${{ number_format($customer->orders->avg('total_price'), 2) }}</p>
    </div>
</div>

<script>
    window.onload = function () {
        window.print();
    };
</script>
@endsection
