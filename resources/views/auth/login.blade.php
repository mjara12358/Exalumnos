{{-- <x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Login Page | theuicode.com</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        *,
        html,
        body {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom right, #00b4d8, #0077b6, #03045e);
        }

        .container {
            width: 50vw;
            height: 60vh;
            display: grid;
            grid-template-columns: 100%;
            grid-template-areas: "login";
            box-shadow: 0 0 17px 10px rgb(0 0 0 / 30%);
            border-radius: 20px;
            background: white;
            overflow: hidden;
        }

        .design {
            grid-area: design;
            display: none;
            position: relative;
        }

        .rotate-45 {
            transform: rotate(-45deg);
        }

        .design .pill-1 {
            bottom: 0;
            left: -40px;
            position: absolute;
            width: 80px;
            height: 200px;
            background: linear-gradient(#00b4d8, #0077b6, #03045e);
            border-radius: 40px;
        }

        .design .pill-2 {
            top: -100px;
            left: -80px;
            position: absolute;
            height: 450px;
            width: 220px;
            background: linear-gradient(#00b4d8, #0077b6, #03045e);
            border-radius: 200px;
            border: 30px solid #e2c5e2;
        }

        .design .pill-3 {
            top: -100px;
            left: 160px;
            position: absolute;
            height: 200px;
            width: 100px;
            background: linear-gradient(#00b4d8, #0077b6, #03045e);
            border-radius: 70px;
        }

        .design .pill-4 {
            bottom: -180px;
            left: 220px;
            position: absolute;
            height: 300px;
            width: 120px;
            background: linear-gradient(#00b4d8, #0077b6);
            border-radius: 70px;
        }

        .login {
            grid-area: login;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            background: white;
        }

        .login h3.title {
            margin: 15px 0;
        }

        .text-input {
            background: #e6e6e6;
            height: 40px;
            display: flex;
            width: 60%;
            align-items: center;
            border-radius: 10px;
            padding: 0 15px;
            margin: 5px 0;
        }

        .text-input input {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            height: 100%;
            margin-left: 10px;
        }

        .text-input i {
            color: #686868;
        }

        ::placeholder {
            color: #9a9a9a;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            max-width: 70%;
            margin-bottom: 10px;
        }

        .login-btn,
        .register-btn {
            width: 48%;
            padding: 10px;
            color: white;
            background: linear-gradient(to right, #00b4d8, #0077b6, #03045e);
            border: none;
            border-radius: 20px;
            cursor: pointer;
            margin-top: 10px;
            box-sizing: border-box;
            text-align: center;
        }

        a {
            font-size: 12px;
            color: #9a9a9a;
            cursor: pointer;
            user-select: none;
            text-decoration: none;
        }

        a.forgot {
            margin-top: 15px;
        }

        .create {
            display: flex;
            align-items: center;
            position: absolute;
            bottom: 30px;
        }

        .create i {
            color: #9a9a9a;
            margin-left: 10px;
        }

        @media (min-width: 768px) {
            .container {
                grid-template-columns: 50% 50%;
                grid-template-areas: "design login";
            }

            .design {
                display: block;
            }
        }

        img {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            width: 90%;


        }
    </style>

</head>

<body>
    
    <div class="container">
        <div class="design">
            <div class="pill-1 rotate-45"></div>
            <div class="pill-2 rotate-45"></div>
            <div class="pill-3 rotate-45"></div>
            <div class="pill-4 rotate-45"></div>
        </div>
        <div class="login">
            <div class="user-profile">
                <div class="logo">
                    <img src="http://127.0.0.1:8000/storage/images/logo.png">
                </div>
            </div>
            
            <x-validation-errors class="mb-4" />
            
            @session('status')
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ $value }}
                </div>
            @endsession

            <div style="width: 20vw;">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <h3 class="title">{{ __('Inicio de Sesión') }}</h3>
                    <div class="text-input">
                        <i class="ri-user-fill"></i>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            autocomplete="username" placeholder="Email">
                    </div>
                    <div class="text-input">
                        <i class="ri-lock-fill"></i>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="Password">
                    </div>

                    <div class="button-container">
                        <button class="login-btn">Login</button>
                        <a href="{{ route('register-exalumno') }}" class="register-btn">{{ __('Register') }}</a>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            href="{{ route('password.request') }}">
                            <svg class="h-6 w-6 text-gray-900" width="24" height="24" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" />
                                <circle cx="12" cy="12" r="9" />
                                <line x1="9" y1="10" x2="9.01" y2="10" />
                                <line x1="15" y1="10" x2="15.01" y2="10" />
                                <path d="M9.5 15.25a3.5 3.5 0 0 1 5 0" />
                            </svg>...................
                            {{ __('Olvido su Password?') }}
                        </a>
                    @endif
                </form>
            </div>
        </div>
    </div>

</body>

</html>
