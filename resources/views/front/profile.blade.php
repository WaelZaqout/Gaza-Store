@extends('front.master')
@section('css')
    <style>
        .prev-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            padding: 5px;
            border: 2px solid #4CAF50;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .prev-img:hover {
            transform: scale(1.1);
            box-shadow: 0 0 15px rgba(76, 175, 80, 0.7);
        }

        .prev-img-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(10px);
            display: none;
        }

        .prev-img-modal img {
            width: 350px;
            height: 350px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ffffff;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
        }

        .btn-dark {
            background-color: #4CAF50;
            border-color: #4CAF50;
            color: white;
            transition: background-color 0.3s ease;
        }

        .btn-dark:hover {
            background-color: #388E3C;
            border-color: #388E3C;
        }

        .form-control {
            border: 1px solid #4CAF50;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #388E3C;
            box-shadow: 0 0 8px rgba(76, 175, 80, 0.5);
        }
    </style>
@endsection

@section('content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"
    style="margin: 30px;
       background-color: #a69c9cde;
        margin: 30px;
        text-align: center;
        height: 50px;
        font-size: 42px;">
        Profile Page</h1>



    <form action="{{ route('front.profile_data') }}" method="POST" enctype="multipart/form-data">
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
            <div class="col-md-9" style="margin-bottom:100px; max-width:50%;margin-left: 200px;padding-left: 120px;">
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


    </script>
@endsection
