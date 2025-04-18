@extends('admin.master')

@section('title', __('admin.invoices'))

@section('content')
<div class="container-fluid">

    {{-- رسالة فلاش --}}
    @if (session()->has('msg'))
    <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
        {{ session('msg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    {{-- العنوان وزر الإضافة --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 text-gray-800">{{ __('admin.invoices_list') }}</h1>
        <a href="{{ route('admin.invoices.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> {{ __('admin.add_invoice') }}
        </a>
    </div>

    {{-- جدول الفواتير --}}
    <div class="card shadow">
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>{{ __('admin.invoice_number') }}</th>
                        <th>{{ __('admin.order_id') }}</th>
                        <th>{{ __('admin.customer_name') }}</th>
                        <th>{{ __('admin.status') }}</th>
                        <th>{{ __('admin.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($invoices as $invoice)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $invoice->invoice_number }}</td>
                        <td>#{{ $invoice->order_id }}</td>
                        <td>{{ $invoice->user->name ?? 'N/A' }}</td>
                        <td>
                            <span class="badge {{ $invoice->status === 'paid' ? 'badge-success' : 'badge-warning text-dark' }}">
                                {{ __('admin.' . $invoice->status) }}
                            </span>
                        </td>
                        <td class="d-flex justify-content-center gap-2 flex-wrap">

                            {{-- زر التعديل --}}
                            <a class="btn btn-sm btn-outline-primary me-1" href="{{ route('admin.invoices.edit', $invoice->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>

                            {{-- زر التفاصيل --}}
                            <a class="btn btn-sm btn-outline-info me-1" href="{{ route('admin.invoice.details', $invoice->id) }}">
                                <i class="fas fa-info-circle"></i> {{ __('admin.details') }}
                            </a>

                            {{-- زر الطباعة --}}
                            <a href="{{ route('admin.invoice.print', $invoice->id) }}" class="btn btn-sm btn-outline-dark" target="_blank">
                                <i class="fas fa-print"></i> {{ __('admin.print_invoice') }}
                            </a>
                            <a href="{{ route('admin.invoices.send', $invoice->id) }}" class="btn btn-sm btn-primary">
                                📧 إرسال الفاتورة
                            </a>
                            {{-- زر الحذف --}}
                            <form class="d-inline" action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">
                                @csrf
                                @method('delete')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">{{ __('admin.no_data_found') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- روابط الصفحات --}}
            <div class="d-flex justify-content-center mt-3">
                {{ $invoices->links() }}
            </div>
        </div>
    </div>

</div>
@endsection
