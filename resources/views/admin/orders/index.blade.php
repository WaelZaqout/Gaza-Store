@extends('admin.master')

@section('title', __('admin.order'))

@section('content')

    <h1 class="h3 mb-4 text-gray-800">{{ __('admin.all_orders') }}</h1>

    @if (session()->has('msg'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <table class="table table-bordered table-hover shadow-sm">
        <thead class="bg-dark text-white">
            <tr>
                <th>#</th>
                <th>{{ __('admin.customer_name') }}</th>
                <th>{{ __('admin.total_amount') }}</th>
                <th>{{ __('admin.status') }}</th>
                <th>{{ __('admin.created_at') }}</th>
                <th>{{ __('admin.updated_at') }}</th>
                <th>{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? __('admin.not_available') }}</td>
                    <td><span class="text-success font-weight-bold">${{ number_format($order->total_price, 2) }}</span></td>
                    <td>
                        <span class="badge rounded-pill {{ $order->status === 'paid' ? 'bg-success text-white' : 'bg-warning text-dark' }}">
                            {{ $order->status === 'paid' ? __('admin.paid') : __('admin.pending') }}
                        </span>
                    </td>
                    <td>
                        <i class="far fa-calendar-alt text-primary"></i>
                        {{ $order->created_at->format('Y-m-d H:i') }}
                    </td>
                    <td>
                        <i class="fas fa-history text-muted"></i>
                        {{ $order->updated_at->format('Y-m-d H:i') }}
                    </td>
                    <td class="d-flex gap-2">
                        <a class="btn btn-sm btn-outline-primary me-1" href="{{ route('admin.orders.details', $order->id) }}">
                            <i class="fas fa-info-circle"></i> {{ __('admin.details') }}
                        </a>

                        <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i> {{ __('admin.delete') }}
                            </button>
                        </form>

                        <a class="btn btn-sm btn-outline-primary me-1" href="{{ route('admin.orders.edit', $order->id) }}">
                            <i class="fas fa-edit"></i> {{ __('admin.edit') }}
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">{{ __('admin.no_data_found') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $orders->links() }}
@endsection
