@extends('admin.master')

@section('title', __('admin.order_details'))

@section('content')

<h1 class="h3 mb-4 text-primary">{{ __('admin.order_details') }} - {{ __('admin.order_id') }} #{{ $order->id }}</h1>

<table class="table table-bordered table-striped shadow-sm">
    <tbody>
        <tr>
            <th class="bg-light">{{ __('admin.order_id') }}</th>
            <td>#{{ $order->id }}</td>
        </tr>
        <tr>
            <th class="bg-light">{{ __('admin.customer_name') }}</th>
            <td>{{ $order->user->name ?? __('admin.not_available') }}</td>
        </tr>
        <tr>
            <th class="bg-light">{{ __('admin.total_amount') }}</th>
            <td><span class="text-success fw-bold">${{ number_format($order->total_price, 2) }}</span></td>
        </tr>
        <tr>
            <th class="bg-light">{{ __('admin.status') }}</th>
            <td>
                <span class="badge rounded-pill
                    {{ $order->status === 'paid' ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                    {{ $order->status === 'paid' ? __('admin.paid') : __('admin.pending') }}
                </span>
            </td>
        </tr>
    </tbody>
</table>

<h3 class="mt-4">{{ __('admin.order_items') }}</h3>
<table class="table table-bordered table-hover shadow-sm">
    <thead class="bg-light text-dark">
        <tr class="text-center">
            <th>{{ __('admin.image') }}</th>
            <th>{{ __('admin.product_name') }}</th>
            <th>{{ __('admin.quantity') }}</th>
            <th>{{ __('admin.price') }}</th>
            <th>{{ __('admin.total') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->order_details as $detail)
        <tr class="align-middle text-center">
            <td>
                <img src="{{ $detail->product->image->path ? asset('images/' . $detail->product->image->path) : asset('images/default.jpg') }}"
                     alt="{{ $detail->product->trans_name }}"
                     class="img-thumbnail" style="width: 100px; height: auto;">
            </td>
            <td class="text-primary fw-bold">{{ $detail->product->trans_name }}</td>
            <td>{{ $detail->quantity }}</td>
            <td><span class="text-success">${{ number_format($detail->price, 2) }}</span></td>
            <td><span class="text-danger">${{ number_format($detail->total, 2) }}</span></td>
        </tr>
        @endforeach
    </tbody>
</table>

<a href="{{ route('admin.orders.index') }}" class="btn btn-primary mt-3">
    <i class="fas fa-arrow-left"></i> {{ __('admin.back_to_orders') }}
</a>

@endsection
