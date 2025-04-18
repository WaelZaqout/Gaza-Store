@extends('admin.master')

@section('title', __('admin.coustomer'))

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-4 text-gray-800">{{ __('admin.customers_list') }}</h1>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> {{ __('admin.add_customer') }}
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

    <table class="table table-bordered table-hover text-center">
        <thead class="bg-dark text-white">
            <tr>
                <th>#</th>
                <th>{{ __('admin.name') }}</th>
                <th>{{ __('admin.email') }}</th>
                <th>{{ __('admin.phone') }}</th>
                <th>{{ __('admin.status') }}</th>
                <th>{{ __('admin.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone ?? __('admin.not_available') }}</td>
                    <td>
                        <span class="badge badge-{{ $user->status == 'active' ? 'success' : 'danger' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>
                    <td class="d-flex justify-content-center gap-2">
                        <a class="btn btn-sm btn-outline-info" href="{{ route('admin.customers.show', $user->id) }}">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.customers.edit', $user->id) }}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form class="d-inline" action="{{ route('admin.customers.destroy', $user->id) }}" method="POST" onsubmit="return confirm('{{ __('admin.confirm_delete') }}')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $customers->links() }}
@endsection
