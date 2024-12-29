@extends('admin.master')
@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Categories</h1>

    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- أو PATCH -->
        @include('admin.categories._form')


        <button class="btn btn-info"><i class="fas fa-save">Update</i></button>
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
