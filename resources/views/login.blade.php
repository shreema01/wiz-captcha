<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: radial-gradient(circle at top, #7c8cff, #4b3f8f);
            padding: 20px;
        }

        /* Card */
        .login-card {
            width: 420px;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            font-weight: 700;
            color: #2b2b2b;
        }

        /* Input */
        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
            color: #444;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #ddd;
            border-radius: 12px;
            font-size: 14px;
            transition: 0.3s ease;
            background: #fff;
        }

        .form-control:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 0 4px rgba(108, 99, 255, 0.15);
            outline: none;
        }

        /* CAPTCHA BOX */
        .captcha-box {
            background: linear-gradient(135deg, #f7f8ff, #ffffff);
            border: 1px solid #e6e6f5;
            border-radius: 14px;
            padding: 16px;
        }

        .captcha-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        /* Refresh Button */
        .refresh-icon-btn {
            width: 44px;
            height: 44px;
            border: none;
            border-radius: 50%;
            background: #6c63ff;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: 0.4s ease;
            flex-shrink: 0;
        }

        .refresh-icon-btn i {
            font-size: 18px;
        }

        .refresh-icon-btn:hover {
            background: #574fd6;
            transform: rotate(90deg) scale(1.05);
        }

        /* Button */
        
        .login-btn {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #6c63ff, #4a47d6);
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s ease;
            margin-top: 10px;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(108, 99, 255, 0.3);
        }

        /* Error */
        
        .error {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 6px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                width: 100%;
                padding: 25px;
            }
        }
    </style>
</head>

<body>

<div class="login-card">

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <h2>Welcome Back</h2>

        {{-- Email --}}
        <div class="form-group">
            <label>Email</label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="form-control"
                   required>

            @error('email')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="form-group">
            <label>Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   required>

            @error('password')
            <div class="error">{{ $message }}</div>
            @enderror
        </div>

        {{-- CAPTCHA --}}
        
        @if(config('wiz-captcha.enabled'))
        <div class="form-group captcha-box">

            <div class="captcha-header">

                {!! wiz_captcha_img('math', ['id' => 'captcha-image']) !!}

                
                <button type="button"
                        class="refresh-icon-btn"
                        onclick="refreshCaptcha()">
                    <i class="fa-solid fa-rotate"></i>
                </button>

            </div>

            <br>

            <input type="text"
                   name="captcha"
                   class="form-control"
                   placeholder="Enter CAPTCHA"
                   autocomplete="off"
                   required>

            @error('captcha')
            <div class="error">{{ $message }}</div>
            @enderror
            
        </div>
        @endif

        <button type="submit" class="login-btn">
            Sign In
        </button>

    </form>

</div>

@if(config('wiz-captcha.enabled'))

<script>
function refreshCaptcha() {
    document.getElementById('captcha-image').src =
        "{{ route('wiz-captcha.image', ['preset' => 'math']) }}?" + Date.now();
}
</script>
@endif

</body>
</html>