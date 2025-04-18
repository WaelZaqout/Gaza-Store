@extends('admin.master')

@section('title', __('admin.customer_details'))

@section('content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('admin.customer_details') }}</h1>

    <div class="card shadow-sm p-4">
        <h2 class="mb-3">{{ $customer->name }}</h2>

        <table class="table table-bordered">
            <tr>
                <th>{{ __('admin.email') }}</th>
                <td>{{ $customer->email }}</td>
            </tr>
            <tr>
                <th>{{ __('admin.phone') }}</th>
                <td>{{ $customer->phone ?? __('admin.not_available') }}</td>
            </tr>
            <tr>
                <th>{{ __('admin.address') }}</th>
                <td>{{ $customer->address ?? __('admin.not_available') }}</td>
            </tr>
            <tr>
                <th>{{ __('admin.country_city') }}</th>
                <td>{{ $customer->country ?? __('admin.not_available') }} / {{ $customer->city ?? __('admin.not_available') }}</td>
            </tr>
            <tr>
                <th>{{ __('admin.status') }}</th>
                <td>
                    <span class="badge badge-{{ $customer->status == 'active' ? 'success' : 'danger' }}">
                        {{ $customer->status == 'active' ? __('admin.active') : __('admin.inactive') }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>{{ __('admin.joined_at') }}</th>
                <td>{{ $customer->created_at->format('d M Y') }}</td>
            </tr>
            <tr>
                <th>{{ __('admin.total_orders') }}</th>
                <td>{{ $customer->orders->count() }}</td>
            </tr>
            <tr>
                <th>{{ __('admin.total_spent') }}</th>
                <td>${{ number_format($customer->orders->sum('total_price'), 2) }}</td>
            </tr>
        </table>

        <h3 class="mt-4">{{ __('admin.recent_orders') }}</h3>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('admin.order_id') }}</th>
                    <th>{{ __('admin.total_price') }}</th>
                    <th>{{ __('admin.status') }}</th>
                    <th>{{ __('admin.created_at') }}</th>
                    <th>{{ __('admin.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer->orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                        <td>
                            <span class="badge {{ $order->status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                                {{ $order->status == 'paid' ? __('admin.paid') : __('admin.pending') }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.details', $order->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> {{ __('admin.view') }}
                            </a>

                            @if(!$order->invoice)
                                <a href="{{ route('admin.invoices.create', ['order_id' => $order->id]) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-file-invoice"></i> {{ __('admin.add_invoice') }}
                                </a>
                            @else
                                <a href="{{ route('admin.invoices.show', $order->invoice->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-invoice-dollar"></i> {{ __('admin.view_invoice') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($customer->orders->count())
            <a href="{{ route('admin.customers.print', $customer->id) }}"
               class="btn btn-outline-dark mt-3" target="_blank">
                <i class="fas fa-print"></i> {{ __('admin.print_orders') }}
            </a>
        @endif

        <a href="{{ route('admin.customers.index') }}" class="btn btn-primary mt-3">
            <i class="fas fa-arrow-left"></i> {{ __('admin.back_to_customers') }}
        </a>
    </div>
@endsection
