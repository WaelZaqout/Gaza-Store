@extends('admin.master')
@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">All Orders</h1>


    @if (session()->has('msg'))
         <div class="alert alert- {{ session('type') }} alert-dismissible fade show" role="alert">

        {{ session('msg') }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
     @endif

     <table class="table table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>رقم الطلب</th>
                <th>اسم المستخدم</th>
                <th>المبلغ</th>
                <th>طريقة الدفع</th>
                <th>الحالة</th>
                <th>تاريخ الدفع</th>
                <th>الإجراءات</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>#{{ $order->id }}</td>
                <td>{{ $order->user->name ?? 'غير معروف' }}</td>
                <td>${{ number_format($order->total_price, 2) }}</td>
                <td>
                    @if($order->status === 'paid')
                        Stripe
                    @else
                        الدفع عند الاستلام
                    @endif
                </td>
                <td>
                    <span class="badge {{ $order->status === 'paid' ? 'bg-success' : 'bg-warning' }}">
                        {{ $order->status === 'paid' ? 'مدفوع' : 'قيد الانتظار' }}
                    </span>
                </td>
                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-info">تفاصيل</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">لا توجد دفعات حتى الآن.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

@endsection
@section('title','Dashboard')

