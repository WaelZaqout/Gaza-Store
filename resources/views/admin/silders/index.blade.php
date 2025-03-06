@extends('admin.master')
@section('content')

    <!-- Page Heading -->


    @if (session()->has('msg'))
    <div class="alert alert- {{ session('type') }} alert-dismissible fade show" role="alert">

        {{ session('msg') }}

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3 mb-4 text-gray-800">All Silders</h1>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Add New Silder
        </a>
    </div>

    <table class="table table-bordered table-hover">
     <tr class="bg-dark text-white">
        <th>ID</th>
        <th>Image</th>
        <th>Title</th>
        <th>SubTitle</th>
        <th>Actions</th>
    </tr>

    @forelse ( $silders as $silder )
    <tr>
        <td>{{ $loop->iteration }}</td>

        <td>
            <img width="100" src="{{ $silder->img_path }}" alt="">
        </td>

        <td> {{ $silder->trans_name }} </td>

        <td>${{ $silder->trans_description}} </td>
        <td>

            <a class="btn btn-sm btn-primary" href="{{ route('admin.silders.edit', $silder->id) }}"><i class="fas fa-edit"></i></a>
            <form class="d-inline" action="{{ route('admin.silders.destroy',$silder->id)}}
             " method="POST">
             @csrf
             @method('delete')
             <button onclick="return confirm('Are You Sure?!')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>

            </form>
        </td>
    </tr>
    @empty
        <tr>
            <td colspan="7" class="text-center">No Data Found</td>
        </tr>
    @endforelse

    </table>

{{ $silders->links() }}
@endsection
@section('title','Dashboard')

