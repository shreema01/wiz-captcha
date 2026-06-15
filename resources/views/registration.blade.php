<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

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
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 15px;
            background: radial-gradient(circle at top, #6d5dfc, #3b2f7a);
        }

        /* Card */
        .register-card {
            width: 450px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 22px;
            padding: 40px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Title */
        h2 {
            text-align: center;
            margin-bottom: 28px;
            font-size: 28px;
            font-weight: 700;
            color: #222;
        }

        /* Form */
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
            border-radius: 12px;
            border: 1px solid #ddd;
            font-size: 14px;
            transition: 0.25s ease;
            background: #fff;
        }

        .form-control:focus {
            outline: none;
            border-color: #6c63ff;
            box-shadow: 0 0 0 4px rgba(108, 99, 255, 0.15);
        }

        /* CAPTCHA */
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
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            transition: 0.35s ease;
            flex-shrink: 0;
        }

        .refresh-icon-btn i {
            font-size: 18px;
        }

        .refresh-icon-btn:hover {
            background: #574fd6;
            transform: rotate(120deg) scale(1.05);
        }

        /* Register Button */
        .register-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 12px;
            margin-top: 10px;
            font-size: 15px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            background: linear-gradient(135deg, #6c63ff, #4a47d6);
            transition: 0.3s ease;
        }

        .register-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 24px rgba(108, 99, 255, 0.3);
        }

        /* Error */
        .error {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 6px;
        }

        /* Responsive */
        @media (max-width: 500px) {
            .register-card {
                width: 100%;
                padding: 25px;
            }
        }
    </style>
</head>

<body>

<div class="register-card">

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2>Create Account</h2>

        {{-- Name --}}
        <div class="form-group">
            <label>Name</label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="form-control"
                   required>

            @error('name')
            <div class="error">{{ $message }}</div>
            @enderror

        </div>

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

        {{-- Confirm Password --}}
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   class="form-control"
                   required>
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

        <button type="submit" class="register-btn">
            Create Account
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