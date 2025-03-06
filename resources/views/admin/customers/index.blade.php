@extends('admin.master')
@section('content')



    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-4 text-gray-800">All Customers</h1>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Add Customer
        </a>
    </div>

    @if (session()->has('msg'))
        <div class="alert alert-{{ session('type') }} alert-dismissible fade show" role="alert">
            {{ session('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <table class="table table-bordered table-hover">
        <tr class="bg-dark text-white">
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? 'N/A' }}</td> <!-- عرض "N/A" إذا كان الهاتف غير متوفر -->
                <td>
                    <span class="badge badge-{{ $user->status == 'active' ? 'success' : 'danger' }}">
                        {{ ucfirst($user->status) }}
                    </span>
                </td>
                <td>
                    <a class="btn btn-sm btn-info" href="{{ route('admin.customers.show', $user->id) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a class="btn btn-sm btn-primary" href="{{ route('admin.customers.edit', $user->id) }}">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form class="d-inline" action="{{ route('admin.customers.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Are you sure you want to delete this user?')" class="btn btn-sm btn-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $customers->links() }}

@endsection
@section('title','Customers')
