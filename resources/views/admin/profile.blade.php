@extends('admin.master')
@section('css')
    <style>
        .prev-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            padding: 5px;
            border: 1px dashed #a7a7a7;
            cursor: pointer;
            transition: all .3 ease;
        }

        .prev-img:hover {
            opacity: .8;
        }

        .prev-img-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #06060687;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(8px);
            display: none;
        }

        .prev-img-modal img {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            object-fit: cover;
        }
    </style>
@endsection
@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Profile Page</h1>



    <form action="{{ route('admin.profile_data') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="prev-img-modal">
            <img src="https://via.palceholder.com/300x300" alt="">
        </div>
        <div class="row">
            <div class="col-md-3">
                @php

                    if ($admin->image) {
                        $src = asset('images/' . $admin->image->path);
                    } else {
                        $src = 'https://ui-avatars.com/api/?background=random&name=' . $admin->name;
                    }

                @endphp

                <div class="text-center">
                    <img title="Edit Your Photo" class="prev-img" id="prevImg" src="{{ $src }}" alt="">
                    <br>
                    <label for="image" class="mt-2 btn btn-sm btn-dark">Edit Image</label>
                    <input type="file" onchange="showImg(event)" name="image" id="image" style="display:none">
                </div>


            </div>
            <div class="col-md-9">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $admin->name) }}">
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" disabled value="{{ old('name', $admin->email) }}">
                </div>
                <br>
                <h4>Update Your Password</h4>
                <div class="mb-3">
                    <label>Current Password</label>
                    <input type="password" class="form-control" id="current" name="current_password">
                </div>
                <div class="mb-3">
                    <label>New Password</label>
                    <input type="password" disabled class="form-control new" name="password">
                </div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" disabled class="form-control new" name="password_confirmation">


                </div>

                <button class="btn btn-success"><i class="fas fa-save"></i>Update</button>
            </div>
        </div>
    </form>
@endsection
@section('title', 'Dashboard')
@section('js')
    <script>
        function showImg(e) {
            const file = e.target.files[0]
            if (file) {
                prevImg.src = URL.createObjectURL(file)
            }
        }


        $('.prev-img').click(function() {
            let url = $(this).attr('src') // تعديل $this إلى $(this)

            $('.prev-img-modal img').attr('src', url)
            $('.prev-img-modal').css('display', 'flex')
        })

        $('.prev-img-modal').click(function() {
            $(this).css('display', 'none') // لإخفاء النافذة عند الضغط عليها
        })

        $('#current').blur(function() {
            $.ajax({
                url: '{{ route('admin.check_password') }}',
                type: 'post',
                data: {
                    _token: '{{ csrf_token() }}',
                    password: $('#current').val()
                },
                success: function(res) {
                    if (res) {
                        $('.new').prop('disabled', false);
                        $('#current').removeClass('is-invalid');
                        $('#current').addClass('is-valid');
                    } else {
                        $('.new').prop('disabled', true);
                        $('.new').val('');
                        $('#current').removeClass('is-valid');
                        $('#current').addClass('is-invalid');
                    }
                }
            });
        });

        // $('#current').keyup(function() {

        //     if($(this).val().length>0){
        //         $('.new').prop('disabled',false)
        //     }else{
        //          $('.new').prop('disabled',true)//*  يبقى غير مسموح للكتابة   */
        //         $('.new').val('')//* هنا عند حدف الكلمة القديمة الخانة فاضية*/

        //     }
    </script>
@endsection
