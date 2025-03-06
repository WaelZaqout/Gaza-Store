@extends('admin.master')

@section('content')
<div class="container">
    <div class="card shadow mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">تفاصيل الفاتورة - #{{ $invoice->invoice_number }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-striped">
                        <tr>
                            <th>رقم الفاتورة:</th>
                            <td>{{ $invoice->invoice_number }}</td>
                        </tr>
                        <tr>
                            <th>تاريخ الفاتورة:</th>
                            <td>{{ $invoice->invoice_date }}</td>
                        </tr>
                        <tr>
                            <th>تاريخ الاستحقاق:</th>
                            <td>{{ $invoice->due_date }}</td>
                        </tr>
                        <tr>
                            <th>المبلغ المحصل:</th>
                            <td><span class="badge bg-success">${{ number_format($invoice->amount_collection, 2) }}</span></td>
                        </tr>
                        <tr>
                            <th>مبلغ العمولة:</th>
                            <td><span class="badge bg-info">${{ number_format($invoice->amount_commission, 2) }}</span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped">
                        <tr>
                            <th>الخصم:</th>
                            <td>${{ number_format($invoice->discount, 2) }}</td>
                        </tr>
                        <tr>
                            <th>قيمة الضريبة:</th>
                            <td>${{ number_format($invoice->value_vat, 2) }}</td>
                        </tr>
                        <tr>
                            <th>نسبة الضريبة:</th>
                            <td>{{ $invoice->rate_vat }}%</td>
                        </tr>
                        <tr>
                            <th>الإجمالي:</th>
                            <td><strong>${{ number_format($invoice->total, 2) }}</strong></td>
                        </tr>
                        <tr>
                            <th>حالة الفاتورة:</th>
                            <td>
                                <span class="badge ">
                                    {{ $invoice->status }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>الملاحظات:</th>
                            <td>{{ $invoice->note ?? 'لا توجد ملاحظات' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow">
        <div class="card-header bg-secondary text-white">
            <h4 class="mb-0">عناصر الفاتورة</h4>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>رقم المنتج</th>
                        <th>الصورة</th>
                        <th>المنتج</th>
                        <th>الكمية</th>
                        <th>السعر</th>
                        <th>الإجمالي</th>
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

    <div class="mt-4">
        <a href="{{ route('admin.invoices.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> العودة إلى الفواتير
        </a>
    </div>
</div>
@endsection
