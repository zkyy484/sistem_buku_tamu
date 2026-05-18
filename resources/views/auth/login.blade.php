<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Buku Tamu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Style internal yang selaras dengan halaman form & pembuka sebelumnya -->
    <style>
        body {
            background-color: #D0E3FF;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        .login-card {
            background-color: #FFFFFF;
            width: 100%;
            max-width: 440px;
            border-radius: 16px;
            box-shadow: 0 12px 35px rgba(8, 31, 92, 0.15);
            overflow: hidden;
        }

        .header {
            background-color: #081F5C;
            color: #FFFFFF;
            text-align: center;
            padding: 35px 24px;
        }

        .header h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .header p {
            margin: 6px 0 0 0;
            font-size: 14px;
            color: #D0E3FF;
            opacity: 0.9;
        }

        .form-container {
            padding: 30px;
        }

        .alert-status {
            background-color: #e1ecfd;
            border-left: 4px solid #081F5C;
            color: #081F5C;
            padding: 12px 14px;
            border-radius: 0 8px 8px 0;
            margin-bottom: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        label {
            color: #000000;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        input[type="email"], input[type="password"] {
            padding: 12px 14px;
            border: 1px solid #cccccc;
            border-radius: 8px;
            font-size: 14px;
            background-color: #f9f9f9;
            color: #000000;
            outline: none;
            transition: all 0.2s ease;
            box-sizing: border-box;
            width: 100%;
        }

        input[type="email"]:focus, input[type="password"]:focus {
            border-color: #081F5C;
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(8, 31, 92, 0.15);
        }

        .error-text {
            color: #e53e3e;
            font-size: 12px;
            margin-top: 6px;
            font-weight: 500;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 26px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            cursor: pointer;
            color: #333333;
        }

        .remember-me input {
            margin-right: 8px;
            accent-color: #081F5C;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        .forgot-link {
            color: #081F5C;
            text-decoration: underline;
            font-weight: 500;
        }

        .forgot-link:hover {
            color: #05133b;
        }

        .btn-submit {
            background-color: #081F5C;
            color: #FFFFFF;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            box-shadow: 0 4px 6px rgba(8, 31, 92, 0.2);
        }

        .btn-submit:hover {
            background-color: #05133b;
        }

        .btn-submit:active {
            transform: scale(0.99);
        }
    </style>
</head>

<body>

    <div class="login-card">
        <!-- Header Identitas Aplikasi -->
        <div class="header">
            <h2>Sistem Buku Tamu</h2>
            <p>Silakan masuk ke akun pengelolaan Anda</p>
        </div>

        <div class="form-container">
            <!-- Session Status / Info Status Log Bawaan Laravel -->
            @if (session('status'))
                <div class="alert-status">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan alamat email">
                    @error('email')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Masukkan password">
                    @error('password')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="remember-forgot">
                    <label for="remember_me" class="remember-me">
                        <input id="remember_me" type="checkbox" name="remember">
                        <span>Ingat Saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="forgot-link" href="{{ route('password.request') }}">
                            {{-- Lupa Password? --}}
                        </a>
                    @endif
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn-submit">
                    Masuk ke Sistem
                </button>
            </form>
        </div>
    </div>

</body>

</html>