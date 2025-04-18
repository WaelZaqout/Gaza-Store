@extends('admin.master')

@section('title', 'تفاصيل الدفع')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">تفاصيل الطلب #{{ $order->id }}</h1>
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">رجوع إلى قائمة الدفعات</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-info text-white">
            <h6 class="m-0 font-weight-bold">معلومات الطلب</h6>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>رقم الطلب:</strong> #{{ $order->id }}</li>
                <li class="list-group-item"><strong>اسم المستخدم:</strong> {{ $order->user->name ?? 'غير معروف' }}</li>
                <li class="list-group-item"><strong>البريد الإلكتروني:</strong> {{ $order->user->email ?? 'غير متوفر' }}</li>
                <li class="list-group-item"><strong>إجمالي المبلغ:</strong> ${{ number_format($order->total_price, 2) }}</li>
                <li class="list-group-item"><strong>طريقة الدفع:</strong>
                    @if($order->status === 'paid') Stripe @else Delivery  @endif
                </li>
                <li class="list-group-item"><strong>حالة الدفع:</strong>
                    <span class="badge {{ $order->status === 'paid' ? 'badge-success' : 'badge-warning text-dark' }}">
                        <td>{{ ucfirst($order->status) }}</td>
                    </span>
                </li>
                <li class="list-group-item"><strong>تاريخ الإنشاء:</strong> {{ $order->created_at->format('Y-m-d h:i A') }}</li>
            </ul>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header bg-secondary text-white">
            <h6 class="m-0 font-weight-bold">تفاصيل المنتجات في الطلب</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>اسم المنتج</th>
                            <th>الكمية</th>
                            <th>السعر</th>
                            <th>الإجمالي</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->order_details as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->product->trans_name ?? 'منتج غير معروف' }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>${{ number_format($detail->price, 2) }}</td>
                            <td>${{ number_format($detail->total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
