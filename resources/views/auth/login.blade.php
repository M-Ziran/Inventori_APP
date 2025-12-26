<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page | Warung Ziran</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('adminlte') }}/dist/css/adminlte.min.css">

    <style>
        /* 1. Animasi Background Cahaya Bergerak */
        body.login-page {
            background: linear-gradient(-45deg, #0f0c29, #302b63, #24243e, #007bff);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin: 0;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* 2. Efek Glassmorphism pada Card */
        .login-box {
            width: 400px;
        }

        .login-box .card {
            background: rgba(255, 255, 255, 0.15) !important;
            /* Transparansi */
            backdrop-filter: blur(15px) saturate(180%);
            /* Efek Kaca */
            -webkit-backdrop-filter: blur(15px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            /* Border tipis kaca */
            border-radius: 20px !important;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            color: #fff;
        }

        .card-header {
            background: transparent !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
            padding-top: 25px !important;
        }

        .card-body {
            background: transparent !important;
        }

        /* 3. Tipografi & Warna Teks */
        .login-box .h1 b {
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
        }

        .login-box-msg {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        /* 4. Styling Input Field agar Serasi */
        .form-control {
            background: rgba(255, 255, 255, 0.9) !important;
            border: none !important;
            border-radius: 30px 0 0 30px !important;
            height: 45px;
        }

        .input-group-text {
            background: rgba(255, 255, 255, 0.9) !important;
            border: none !important;
            border-radius: 0 30px 30px 0 !important;
            color: #333 !important;
        }

        /* 5. Tombol Login Modern */
        .btn-primary {
            background: linear-gradient(to right, #007bff, #00d4ff);
            border: none;
            border-radius: 30px;
            height: 45px;
            font-weight: bold;
            transition: 0.3s;
            margin-top: 10px;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
            background: linear-gradient(to right, #00d4ff, #007bff);
        }

        /* Error Alert Styling */
        .alert-danger {
            background: rgba(220, 53, 69, 0.8);
            border: none;
            border-radius: 10px;
            color: white;
        }
    </style>
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="card card-outline">
            <div class="card-header text-center">
                <a href="#" class="h1"><b>Warung</b> Ziran</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li><small>{{ $error }}</small></li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">LOGIN</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="{{ asset('adminlte') }}/plugins/jquery/jquery.min.js"></script>
    <script src="{{ asset('adminlte') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('adminlte') }}/dist/js/adminlte.min.js"></script>

</body>

</html>
