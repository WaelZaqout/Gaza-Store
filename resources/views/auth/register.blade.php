{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Noto Sans", sans-serif;
        }

        body {
            background-image: url("https://img.cdn-pictorem.com/uploads/collection/E/EH4LNA1KMP/900_7ob_Trees_Moon_Lake_Moonlight_Night_Image_Manipulation_Mystic_Light_Mood_Illuminated_Night.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        body::before {
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.3);
        }

        .container {
            box-shadow: 0px 0px 10px white;
            border-radius: 10px;
            backdrop-filter: blur(5px);
            color: #fff;
            height: 500px;
            width: 340px;
            padding: 20px;
        }

        .title {
            font-size: 40px;
            text-align: center;
        }

        .form-container .input-box {
            position: relative;
            display: flex;
            align-items: center;
        }

        .form-container .name,
        .form-container .email,
        .form-container .password,
        .form-container .password-confirmation {
            margin-top: 20px;
        }

        .input-box input {
            width: 100%;
            outline: 0;
            border: 2px solid #cecece;
            border-radius: 50px;
            padding: 8px 8px 8px 15px;
            background: transparent;
            color: #fff;
            font-size: 16px;
        }

        input::placeholder {
            color: #fff;
        }

        .input-box img {
            position: absolute;
            right: 25px;
        }

        .button {
            display: flex;
            justify-content: center;
            margin-top: 28px;
        }

        .button button {
            border: none;
            background-color: #fff;
            border-radius: 50px;
            color: #000;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            padding: 10px 0;
            outline: none;
            width: 100%;
        }

        .button button:hover {
            background-color: #cecece;
        }

        .login-link p {
            font-size: 14px;
            margin-top: 10px;
            text-align: center;
        }

        .login-link p a {
            color: #fff;
        }

        .login-link p a:hover {
            color: blue;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="title">Register</h2>
        <form method="POST" action="{{ route('register') }}" class="form-container">
            @csrf
            <div class="input-box name">
                <input type="text" name="name" id="name-input" required placeholder="Name">
                <img src="https://cdn-icons-png.flaticon.com/512/1077/1077114.png" alt="user-image" width="25px">
            </div>
            <div class="input-box email">
                <input type="email" name="email" id="email-input" required placeholder="Email">
                <img src="https://cdn-icons-png.flaticon.com/512/732/732200.png" alt="email-image" width="25px">
            </div>
            <div class="input-box password">
                <input type="password" name="password" id="password-input" required placeholder="Password">
                <img src="https://cdn-icons-png.flaticon.com/512/2489/2489659.png" alt="lock-image" width="22px">
            </div>
            <div class="input-box password-confirmation">
                <input type="password" name="password_confirmation" id="password-confirmation-input" required placeholder="Confirm Password">
                <img src="https://cdn-icons-png.flaticon.com/512/2489/2489659.png" alt="lock-image" width="22px">
            </div>
            <div class="button">
                <button type="submit" class="register">Register</button>
            </div>
            <div class="login-link">
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
            </div>
        </form>
    </div>
</body>

</html>