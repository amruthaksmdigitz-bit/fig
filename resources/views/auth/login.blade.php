
@extends('layouts.main')

@section('content')
    @php
        $captcha_id = uniqid();
    @endphp

    <style>
        body {
            background: linear-gradient(135deg, #1A3628 0%, #2F5D44 50%, #8B6B3E 100%);
        }

        .auth-page {
            min-height: calc(100vh - 120px);
            margin-top: 120px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .auth-card {
            width: 100%;
            max-width: 900px;
            display: flex;
            border-radius: 40px;
            overflow: hidden;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
            background: #ffffff;
        }

        .card-left {
            flex: 1;
            background: #ffffff;
            padding: 60px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .card-left img {
            max-width: 150px;
            margin-bottom: 20px;
        }

        .card-left h3 {
            font-weight: 700;
            margin-bottom: 12px;
            color: #1d3557;
        }

        .card-left p {
            color: #6c757d;
            font-size: 14px;
            max-width: 260px;
        }

        .card-right {
            flex: 1;
            background: linear-gradient(135deg,
                    #8c6a2f 0%,
                    #b88a3c 30%,
                    #d4a64a 60%,
                    #a6762b 100%);
            padding: 60px 40px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 100%;
            max-width: 320px;
        }

        .login-title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 30px;
            color: #ffffff;
            letter-spacing: 1px;
        }

        .form-control {
            height: 44px;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 0 15px;
            width: 100%;
        }

        .form-control:focus {
            outline: none;
            border-color: #b88a3c;
            box-shadow: 0 0 0 0.15rem rgba(184, 138, 60, 0.25);
        }

        .btn-login {
            background: linear-gradient(135deg, #0b3d26 0%, #145c3b 50%, #0e4f30 100%);
            border: none;
            height: 44px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.25s ease;
            width: 100%;
            color: white;
            cursor: pointer;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
        }

        .signup-link {
            color: #ffffff;
            margin-top: 20px;
            text-align: center;
        }

        .signup-link a {
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .signup-link a:hover {
            color: #0b3d26;
        }

        .captcha-container {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .captcha-image {
            border-radius: 8px;
            border: 2px solid #fff;
            height: 44px;
            width: 130px;
            object-fit: cover;
            background-color: #fff;
            cursor: pointer;
        }

        .btn-refresh {
            background: linear-gradient(135deg, #0b3d26 0%, #145c3b 50%, #0e4f30 100%);
            border: none;
            color: white;
            height: 44px;
            width: 44px;
            border-radius: 8px;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .btn-refresh:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
        }

        .text-white-50 {
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            display: block;
            margin-top: 5px;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-light {
            background-color: #ffffff;
            border: none;
            color: #333;
        }

        .text-danger {
            color: #dc3545;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-3 {
            margin-bottom: 15px;
        }

        .mt-2 {
            margin-top: 10px;
        }

        .d-grid {
            display: grid;
        }

        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column;
                max-width: 95%;
            }

            .card-left,
            .card-right {
                padding: 30px 20px;
            }

            .card-left p {
                display: none;
            }
        }

        /* KEEP YOUR SAME CSS — NO CHANGE */
        body {
            background: linear-gradient(135deg, #1A3628 0%, #2F5D44 50%, #8B6B3E 100%);
        }

        /* ALL YOUR EXISTING CSS SAME */
    </style>


    <div class="auth-page">
        <div class="auth-card">

            <div class="card-left">
                <img src="{{ asset('img/fig.png') }}">
                <p>Welcome back! Access your FIG account and explore opportunities.</p>
            </div>


            <div class="card-right">
                <div class="login-box">

                    <h3 class="login-title">Log In</h3>


                    @if (session('success'))
                        <div class="alert alert-light">
                            {{ session('success') }}
                        </div>
                    @endif


                    @if ($errors->any())
                        <div class="alert alert-light">

                            <ul class="mb-0 text-danger">

                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach

                            </ul>

                        </div>
                    @endif



                    <form method="POST" action="{{ route('login.post') }}">

                        @csrf



                        <div class="mb-3">

                            <input type="email" name="email" class="form-control" placeholder="Email address"
                                value="{{ old('email') }}" required>

                        </div>



                        <div class="mb-3">

                            <input type="password" name="password" class="form-control" placeholder="Password" required>

                        </div>



                        {{-- CAPTCHA SAME AS SIGNUP --}}

                        <div class="mb-3">

                            <label class="form-label text-white">Captcha</label>


                            <div class="d-flex">

                                <img id="captchaImage" src="{{ route('captcha.image') }}">




                                <button type="button" class="btn btn-light" onclick="refreshCaptcha()">

                                    ↻

                                </button>


                            </div>



                            <input type="text" name="captcha" class="form-control mt-2" placeholder="Enter captcha"
                                required>


                            @error('captcha')
                                <div class="text-danger">

                                    {{ $message }}

                                </div>
                            @enderror


                        </div>




                        <div class="d-grid mb-3">

                            <button type="submit" class="btn-login">

                                Login

                            </button>

                        </div>



                        <div class="signup-link">

                            Don't have an account?

                            <a href="{{ route('signup') }}">

                                Sign up

                            </a>

                        </div>


                    </form>


                </div>
            </div>


        </div>
    </div>




    <script>
        function refreshCaptcha() {

            let id = "{{ $captcha_id }}";


            document.getElementById('captchaImage').src =

                "{{ route('captcha.image') }}?id=" + id + "&" + new Date().getTime();

        }
    </script>
@endsection
