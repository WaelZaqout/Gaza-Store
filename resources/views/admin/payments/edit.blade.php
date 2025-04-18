@extends('admin.master')
@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit payments</h1>

    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- أو PATCH -->
        @include('admin.payments._form')


        <button class="btn btn-info"><i class="fas fa-save">Update</i></button>
    </form>



@endsection
@section('title','Dashboard')

@section('js')
<script>
//     function showImage(e){
//         console.log();
//         const [file] = e.target.files
//   if (file) {
//     preview.src = URL.createObjectURL(file)
//   }
//     }
    function showImage(e) {
    const [file] = e.target.files;
    if (file) {
        const preview = document.getElementById('preview');
        if (preview) {
            preview.src = URL.createObjectURL(file);
        }
    }
}
    function delImg(e, id) {
    $.ajax({
        type: 'get',
        url: '{{ route("admin.delete_img") }}/' + id,
        success: (res) => {
            if (res) {
                e.target.parentElement.remove(); // هنا تم إضافة الأقواس لتنفيذ الوظيفة remove بشكل صحيح
            }
        },
        error: (err) => {
            console.log(err);
        }
    });
}


</script>

@endsection
