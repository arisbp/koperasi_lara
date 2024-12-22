<x-guest-layout>
    <head>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>
    <body>
        <div class="card">
            <!-- Logo -->
            <div class="logo-container">
                <img src="{{ asset('images/logo.jpg ') }}" alt="Logo Koperasi" class="logo">
            </div>

            <!-- Title -->
            <h1>{{ __('Welcome Back!') }}</h1>
            <p class="description">Masuk ke akun Anda dan nikmati kemudahan layanan digital kami.</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address / Username -->
                <div>
                    <x-input-label for="id_user" :value="__('Email or Username')" />
                    <x-text-input id="id_user" type="text" name="id_user" :value="old('id_user')" required autofocus />
                    <x-input-error :messages="$errors->get('id_user')" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" />
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex-row">
                    <label>
                        <input type="checkbox" name="remember">
                        {{ __('Remember me') }}
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit">{{ __('Log in') }}</button>
            </form>

            <!-- Footer -->
            <p class="footer-text">Belum memiliki akun? 
                <a href="{{ route('register') }}">{{ __('Daftar di sini') }}</a>
            </p>
        </div>
    </body>
</x-guest-layout>
