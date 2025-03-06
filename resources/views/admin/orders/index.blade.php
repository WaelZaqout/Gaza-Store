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


    <table class="table table-bordered table-hover">
     <tr class="bg-dark text-white">
        <th>ID</th>
        <th>user_id</th>
        <th>total_price</th>
        <th>status</th>
        <th>created_at</th>
        <th>updated_at</th>
        <th>Actions</th>
    </tr>

    @forelse ( $orders as $order )
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->user_id }}</td> <!-- عرض اسم المستخدم -->


        <td>${{ number_format($order->total_price, 2) }}</td>
        <td>{{ ucfirst($order->status) }}</td>
        <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
        <td>{{ $order->updated_at->format('Y-m-d H:i') }}</td>
        <td>

            <form class="d-inline" action="{{ route('admin.orders.destroy',$order->id)}}
             " method="POST">
             @csrf
             @method('delete')
             <button onclick="return confirm('Are You Sure?!')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
             <a class="btn btn-sm btn-primary" href="{{ route('admin.orders.details', $order->id) }}">
                <i class="fas fa-info-circle"></i> Details
            </a>



            </form>
        </td>
    </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">No Data Found</td>
        </tr>
    @endforelse

    </table>

{{ $orders->links() }}
@endsection
@section('title','Dashboard')

