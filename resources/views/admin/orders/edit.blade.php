@extends('admin.master')
@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit orders</h1>

    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- أو PATCH -->
        @include('admin.orders._form')


        <button class="btn btn-info"><i class="fas fa-save">Update</i></button>
    </form>



@endsection
@section('title','Dashboard')

@section('js')

@endsection
