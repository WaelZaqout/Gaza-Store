@extends('admin.master')
@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Add New Products</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf


        @include('admin.products._form')

        <button class="btn btn-success"><i class="fas fa-save">Add</i></button>
    </form>



@endsection

@section('title','Dashboard')

@section('js')
<script>
    function showImage(e){
        console.log();
        const [file] = e.target.files
  if (file) {
    preview.src = URL.createObjectURL(file)
  }
    }
</script>

@endsection
