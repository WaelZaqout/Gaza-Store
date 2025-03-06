@extends('admin.master')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Customer Details</h1>

    <div class="card shadow-sm p-4">
        <h2 class="mb-3">{{ $customer->name }}</h2>

        <table class="table table-bordered">
            <tr>
                <th>Email</th>
                <td>{{ $customer->email }}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{ $customer->phone ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $customer->address ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Country / City</th>
                <td>{{ $customer->country ?? 'N/A' }} / {{ $customer->city ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <span class="badge badge-{{ $customer->status == 'active' ? 'success' : 'danger' }}">
                        {{ ucfirst($customer->status) }}
                    </span>
                </td>
            </tr>
            <tr>
                <th>Joined At</th>
                <td>{{ $customer->created_at->format('d M Y') }}</td>
            </tr>

            <tr>
                <th>Total Orders</th>
                <td>{{ $customer->orders->count() }}</td>
            </tr>
            <tr>
                <th>Total Spent</th>
                <td>${{ number_format($customer->orders->sum('total_price'), 2) }}</td>
            </tr>
        </table>

        <h3 class="mt-4">Recent Orders</h3>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customer->orders as $order)
                    <tr>
                        <td>#{{ $order->id }}</td>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                        <td>
                            <span class="badge {{ $order->status == 'Paid' ? 'bg-success' : 'bg-warning' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.details', $order->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> View
                            </a>

                            <!-- زر إنشاء الفاتورة -->
                            @if(!$order->invoice)
                            <a href="{{ route('admin.invoices.create', ['order_id' => $order->id]) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-file-invoice"></i> إنشاء فاتورة
                            </a>

                            @else
                                <a href="{{ route('admin.invoices.show', $order->invoice->id) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-file-invoice-dollar"></i> عرض الفاتورة
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


        <a href="{{ route('admin.customers.index') }}" class="btn btn-primary mt-3">Back to Customers</a>
    </div>
@endsection
