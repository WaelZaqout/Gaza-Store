@extends('admin.master')
@section('content')



    @if (session()->has('msg'))
    <div class="alert alert- {{ session('type') }} alert-dismissible fade show" role="alert">
        {{ session('msg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-4 text-gray-800">All Products</h1>
        <a href="{{ route('admin.invoices.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add Invoices
        </a>
    </div>
    <table class="table table-bordered table-hover">
        <tr class="bg-dark text-white">
            <th>ID</th>
            <th>Invoice Number</th>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        @forelse($invoices as $invoice)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $invoice->invoice_number }}</td>
            <td>{{ $invoice->order_id }}</td>
            <td>{{ $invoice->user_id }}</td>

            <td>{{ $invoice->status }}</td>
            <td>
                <a class="btn btn-sm btn-primary" href="{{ route('admin.invoices.edit', $invoice->id) }}"><i class="fas fa-edit"></i></a>
                <form class="d-inline" action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('Are You Sure?!')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.invoice.details', $invoice->id) }}">
                        <i class="fas fa-info-circle"></i> Details
                    </a>
                    <a href="{{ route('admin.invoice.print', $invoice->id) }}" class="btn btn-primary" target="_blank">
                        طباعة الفاتورة
                    </a>

                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="14" class="text-center">No Data Found</td>
        </tr>
        @endforelse

    </table>

    {{ $invoices->links() }}
@endsection

@section('title', 'Dashboard')
