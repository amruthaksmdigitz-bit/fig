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

        .signup-box {
            width: 100%;
            max-width: 320px;
        }

        .signup-title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 5px;
            color: #ffffff;
            letter-spacing: 1px;
        }

        .form-control {
            height: 44px;
            border-radius: 8px;
            border: none;
            font-size: 14px;
            padding: 8px 12px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.15rem rgba(255, 255, 255, 0.4);
        }

        .card-right .form-label {
            color: #ffffff;
            font-weight: 500;
            margin-bottom: 6px;
        }

        /* Terms Checkbox Styling */
        .terms-checkbox-wrapper {
            margin: 20px 0;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 215, 0, 0.3);
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            cursor: pointer;
        }

        .terms-checkbox input[type="checkbox"] {
            display: none;
        }

        .checkbox-custom {
            min-width: 24px;
            height: 24px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid #FFD700;
            border-radius: 6px;
            position: relative;
            transition: all 0.3s ease;
            margin-top: 2px;
        }

        .terms-checkbox input[type="checkbox"]:checked+.checkbox-custom {
            background: #FFD700;
            border-color: #FFD700;
            animation: checkPop 0.3s ease;
        }

        .terms-checkbox input[type="checkbox"]:checked+.checkbox-custom::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #2C5F2D;
            font-size: 16px;
            font-weight: bold;
        }

        @keyframes checkPop {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.2);
            }

            100% {
                transform: scale(1);
            }
        }

        .terms-text {
            color: #ffffff;
            font-size: 14px;
            line-height: 1.5;
            flex: 1;
        }

        .terms-links {
            color: #FFD700;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
        }

        .terms-links:hover {
            color: #ffffff;
            text-shadow: 0 0 8px rgba(255, 215, 0, 0.5);
        }

        .terms-links::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 1px;
            background: #FFD700;
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .terms-links:hover::after {
            transform: scaleX(1);
        }

        .terms-error {
            color: #ff6b6b;
            font-size: 13px;
            margin-top: 8px;
            padding-left: 36px;
            animation: shake 0.5s ease;
        }

        @keyframes shake {

            0%,
            100% {
                transform: translateX(0);
            }

            10%,
            30%,
            50%,
            70%,
            90% {
                transform: translateX(-5px);
            }

            20%,
            40%,
            60%,
            80% {
                transform: translateX(5px);
            }
        }

        .btn-signup {
            background: linear-gradient(135deg,
                    #0b3d26 0%,
                    #145c3b 50%,
                    #0e4f30 100%);
            border: none;
            height: 44px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-signup:hover,
        .btn-signup:focus,
        .btn-signup:active {
            background: linear-gradient(135deg,
                    #0b3d26 0%,
                    #145c3b 50%,
                    #0e4f30 100%) !important;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25);
            border: none;
        }

        .btn-signup::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .btn-signup:hover::before {
            left: 100%;
        }

        .btn-signup:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none !important;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #ffffff;
            font-weight: 600;
            text-decoration: none;
            transition: 0.2s;
        }

        .login-link a:hover {
            color: #FFD700;
        }

        .card-right .alert {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 8px;
        }

        .card-right .alert-danger {
            color: #dc3545;
        }

        .card-right .alert-success {
            color: #198754;
        }

        @media (max-width: 768px) {
            .auth-card {
                flex-direction: column;
                max-width: 95%;
                border-radius: 30px;
            }

            .card-left,
            .card-right {
                padding: 30px 20px;
            }

            .card-left p {
                display: none;
            }

            .card-left img {
                max-width: 80px;
                margin-bottom: 10px;
            }

            .signup-box {
                max-width: 100%;
            }

            .signup-title {
                margin-bottom: 15px;
                font-size: 24px;
            }

            .form-control {
                height: 40px;
                font-size: 13px;
            }

            .btn-signup {
                height: 40px;
            }

            .card-right .form-label {
                font-size: 13px;
                margin-bottom: 4px;
            }

            .mb-3 {
                margin-bottom: 12px !important;
            }

            .terms-checkbox-wrapper {
                padding: 12px;
            }

            .terms-text {
                font-size: 13px;
            }

            .checkbox-custom {
                min-width: 22px;
                height: 22px;
            }
        }

        @media (max-width: 480px) {
            .auth-card {
                max-width: 92%;
                border-radius: 25px;
            }

            .card-left,
            .card-right {
                padding: 25px 15px;
            }

            .signup-box {
                max-width: 100%;
            }
        }

        @media (max-width: 360px) {
            .auth-card {
                max-width: 90%;
            }

            .card-left,
            .card-right {
                padding: 20px 12px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .auth-card {
                max-width: 850px;
            }

            .card-left,
            .card-right {
                padding: 50px 30px;
            }
        }

        /* Tooltip for terms links */
        [data-tooltip] {
            position: relative;
            cursor: help;
        }

        [data-tooltip]:before {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            padding: 5px 10px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            font-size: 12px;
            border-radius: 4px;
            white-space: nowrap;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            pointer-events: none;
            margin-bottom: 5px;
        }

        [data-tooltip]:hover:before {
            opacity: 1;
            visibility: visible;
        }
    </style>

    <div class="auth-page signup">
        <div class="auth-card">
            <div class="card-left">
                <img src="{{ asset('img/fig.png') }}" alt="FIG Logo">
                <p>Connect with others and explore opportunities with FIG.</p>
            </div>

            <div class="card-right">
                <div class="signup-box">
                    <h3 class="signup-title">Sign Up</h3>

                    @if ($errors->any())
                        <div class="alert alert-danger mb-3">
                            <ul class="mb-0" style="padding-left: 15px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success mb-3">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('signup.post') }}" method="POST" id="signupForm">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Furniture Manufacturing / Showroom full name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Business Email address</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <select name="location" class="form-control @error('location') is-invalid @enderror"
                                id="homelocation" required>
                                <option value="">Select one</option>
                                <!-- Add your location options here -->
                            </select>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        {{-- CAPTCHA WITH REFRESH --}}
                        @php
                            $captcha = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ23456789'), 0, 6);
                        @endphp

                        <div class="mb-3">
                            <label class="form-label">Captcha</label>
                            <div class="d-flex">

                                <img id="captchaImage" src="{{ route('captcha.image') }}">

                                <button type="button" class="btn btn-light btncaptche" onclick="refreshCaptcha()">
                                    ↻
                                </button>

                            </div>
                            <input type="hidden" name="captcha_generated" id="captcha_generated"
                                value="{{ $captcha }}">
                            <input type="text" name="captcha" class="form-control mt-2" placeholder="Enter captcha"
                                required>
                            @error('captcha')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Terms and Conditions Checkbox -->
                        <div class="terms-checkbox-wrapper">
                            <label class="terms-checkbox">
                                <input type="checkbox" name="terms" id="terms" required>
                                <span class="checkbox-custom"></span>
                                <span class="terms-text">
                                    I agree to the
                                    <a href="{{ route('terms-and-conditions') }}" target="_blank" class="terms-links"
                                        data-tooltip="View Terms & Conditions">Terms & Conditions</a>
                                    and
                                    <a href="{{ route('privacy-policy') }}" target="_blank" class="terms-links"
                                        data-tooltip="View Privacy Policy">Privacy Policy</a>
                                </span>
                            </label>
                            @error('terms')
                                <div class="terms-error">{{ $message }}</div>
                            @enderror
                            <div id="termsError" class="terms-error" style="display: none;"></div>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-signup text-white" id="submitBtn">
                                Sign Up
                            </button>
                        </div>

                        <div class="text-center login-link">
                            Already have an account?
                            <a href="{{ route('login') }}">Log in</a>
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



        // Client-side terms validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('signupForm');
            const termsCheckbox = document.getElementById('terms');
            const submitBtn = document.getElementById('submitBtn');
            const termsError = document.getElementById('termsError');

            form.addEventListener('submit', function(e) {
                if (!termsCheckbox.checked) {
                    e.preventDefault();
                    termsError.style.display = 'block';
                    termsError.textContent =
                        'You must agree to the Terms & Conditions and Privacy Policy to continue.';

                    // Highlight the checkbox wrapper
                    document.querySelector('.terms-checkbox-wrapper').style.border = '2px solid #ff6b6b';

                    // Scroll to terms
                    document.querySelector('.terms-checkbox-wrapper').scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });

                    // Shake animation
                    document.querySelector('.terms-checkbox-wrapper').classList.add('shake');
                    setTimeout(() => {
                        document.querySelector('.terms-checkbox-wrapper').classList.remove('shake');
                    }, 500);
                }
            });

            // Remove error styling when checkbox is checked
            termsCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    termsError.style.display = 'none';
                    document.querySelector('.terms-checkbox-wrapper').style.border =
                        '1px solid rgba(255, 215, 0, 0.3)';
                }
            });

            // Animate checkbox on hover
            const checkboxCustom = document.querySelector('.checkbox-custom');
            if (checkboxCustom) {
                checkboxCustom.addEventListener('mouseenter', function() {
                    if (!termsCheckbox.checked) {
                        this.style.transform = 'scale(1.1)';
                    }
                });

                checkboxCustom.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            }
        });
    </script>
@endsection
