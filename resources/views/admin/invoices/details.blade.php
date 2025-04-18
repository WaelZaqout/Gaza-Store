@extends('admin.master')

@section('title', __('admin.invoice_details'))

@section('content')
<div class="container">
    {{-- ✅ بيانات الفاتورة --}}
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ __('admin.invoice_details') }} - #{{ $invoice->invoice_number }}</h4>
        </div>
        <div class="card-body">
            <div class="row">

                {{-- العمود الأيسر --}}
                <div class="col-md-6">
                    <table class="table table-striped">
                        <tr>
                            <th>{{ __('admin.invoice_number') }}:</th>
                            <td>{{ $invoice->invoice_number }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('admin.invoice_date') }}:</th>
                            <td>{{ $invoice->invoice_date }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('admin.due_date') }}:</th>
                            <td>{{ $invoice->due_date }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('admin.amount_collection') }}:</th>
                            <td><span class="badge bg-success">${{ number_format($invoice->amount_collection, 2) }}</span></td>
                        </tr>
                        <tr>
                            <th>{{ __('admin.amount_commission') }}:</th>
                            <td><span class="badge bg-info text-dark">${{ number_format($invoice->amount_commission, 2) }}</span></td>
                        </tr>
                    </table>
                </div>

                {{-- العمود الأيمن --}}
                <div class="col-md-6">
                    <table class="table table-striped">
                        <tr>
                            <th>{{ __('admin.discount') }}:</th>
                            <td>${{ number_format($invoice->discount, 2) }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('admin.vat_value') }}:</th>
                            <td>${{ number_format($invoice->value_vat, 2) }}</td>
                        </tr>
                        <tr>
                            <th>{{ __('admin.vat_rate') }}:</th>
                            <td>{{ $invoice->rate_vat }}%</td>
                        </tr>
                        <tr>
                            <th>{{ __('admin.total') }}:</th>
                            <td><strong>${{ number_format($invoice->total, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <th>{{ __('admin.status') }}:</th>
                            <td>
                                <span class="badge
                                    @if($invoice->status === __('admin.paid')) bg-success
                                    @elseif($invoice->status === __('admin.pending')) bg-warning text-dark
                                    @else bg-secondary
                                    @endif">
                                    {{ $invoice->status }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>{{ __('admin.note') }}:</th>
                            <td>{{ $invoice->note ?? __('admin.no_notes') }}</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>

    {{-- ✅ عناصر الطلب --}}
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">{{ __('admin.invoice_items') }}</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>{{ __('admin.product_id') }}</th>
                        <th>{{ __('admin.image') }}</th>
                        <th>{{ __('admin.product_name') }}</th>
                        <th>{{ __('admin.quantity') }}</th>
                        <th>{{ __('admin.price') }}</th>
                        <th>{{ __('admin.total') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoice->order->order_details as $detail)
                        <tr>
                            <td>{{ $detail->product->id }}</td>
                            <td>
                                <img src="{{ $detail->product->image ? asset('images/' . $detail->product->image->path) : asset('images/default.jpg') }}"
                                     alt="{{ $detail->product->trans_name }}"
                                     class="img-thumbnail"
                                     style="width: 80px; height: 80px;">
                            </td>
                            <td>{{ $detail->product->trans_name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>${{ number_format($detail->price, 2) }}</td>
                            <td><strong>${{ number_format($detail->total, 2) }}</strong></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- زر العودة --}}
    <div class="mt-4 text-end">
        <a href="{{ route('admin.invoices.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> {{ __('admin.back_to_invoices') }}
        </a>
    </div>
</div>
@endsection
