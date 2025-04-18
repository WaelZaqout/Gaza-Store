@extends('admin.master')

@section('title', __('admin.payments'))

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">{{ __('admin.payments_list') }}</h1>
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">{{ __('admin.back_to_dashboard') }}</a>
    </div>

    @if (session()->has('msg'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    {{-- 🔍 Search and Filter --}}
    <form method="GET" action="{{ route('admin.payments.index') }}" class="row mb-4">
        <div class="col-md-3">
            <input type="text" name="user" class="form-control" placeholder="{{ __('admin.customer_name') }}" value="{{ request('user') }}">
        </div>
        <div class="col-md-3">
            <input type="text" name="order_id" class="form-control" placeholder="{{ __('admin.order_id') }}" value="{{ request('order_id') }}">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-control">
                <option value="">{{ __('admin.all_statuses') }}</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>{{ __('admin.paid') }}</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('admin.pending') }}</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary w-100">{{ __('admin.search') }}</button>
        </div>
    </form>

    <div class="card shadow mb-4">
        <div class="card-header py-3 bg-primary text-white">
            <h6 class="m-0 font-weight-bold">{{ __('admin.all_registered_payments') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>#</th>
                            <th>{{ __('admin.order_id') }}</th>
                            <th>{{ __('admin.customer_name') }}</th>
                            <th>{{ __('admin.amount') }}</th>
                            <th>{{ __('admin.payment_method') }}</th>
                            <th>{{ __('admin.status') }}</th>
                            <th>{{ __('admin.payment_date') }}</th>
                            <th>{{ __('admin.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? __('admin.not_available') }}</td>
                            <td><span class="text-success font-weight-bold">${{ number_format($order->total_price, 2) }}</span></td>
                            <td>
                                @if($order->status === 'paid')
                                    <span class="badge badge-info">{{ __('admin.stripe') }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ __('admin.cash_on_delivery') }}</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $order->status === 'paid' ? 'badge-success' : 'badge-warning text-dark' }}">
                                    {{ __('admin.' . $order->status) }}
                                </span>
                            </td>
                            <td>{{ $order->created_at->format('Y-m-d h:i A') }}</td>
                            <td>
                                <a href="{{ route('admin.payments.show', $order->id) }}" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-eye"></i> {{ __('admin.view') }}
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">{{ __('admin.no_payments_found') }}</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-3">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
