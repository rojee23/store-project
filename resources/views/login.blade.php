<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Multi-Branch E-Store</title>

    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0; padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(120deg, #2980b9, #8e44ad);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            animation: move 20s infinite;
        }

        .shape:nth-child(1) { width: 300px; height: 300px; top: -150px; left: -150px; }
        .shape:nth-child(2) { width: 400px; height: 400px; bottom: -200px; right: -200px; }
        .shape:nth-child(3) { width: 200px; height: 200px; bottom: 50px; left: 100px; }
        .shape:nth-child(4) { width: 150px; height: 150px; top: 100px; right: 150px; }

        @keyframes move {
            0%, 100% { transform: translate(0,0) scale(1); }
            25% { transform: translate(50px,50px) scale(1.1); }
            50% { transform: translate(-30px,20px) scale(0.9); }
            75% { transform: translate(20px,-40px) scale(1.05); }
        }

        .login-container {
            width: 100%;
            max-width: 450px;
            padding: 20px;
            z-index: 10;
        }

        .login-card {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow-y: auto;
            max-height: 85vh;
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px;
            text-align: center;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }

        .header-icon {
            width: 80px; height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 15px;
            border: 3px solid rgba(255,255,255,0.5);
        }

        .header-icon i {
            font-size: 40px;
            color: white;
        }

        .card-header h2 {
            color: white;
            font-size: 26px;
            font-weight: 700;
        }

        .card-header p {
            color: rgba(255,255,255,0.9);
            font-size: 14px;
        }

        .card-body {
            padding: 25px 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
        }

        .form-control {
            padding: 12px 15px 12px 45px;
            border-radius: 12px;
            border: 2px solid #e1e1e1;
            background: #f8f9fa;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            margin-top: 10px;
            cursor: pointer;
        }

        .card-footer {
            padding: 15px 20px;
            text-align: center;
            background: #fafafa;
        }
    </style>

</head>

<body>

<!-- Background shapes -->
<div class="shape"></div>
<div class="shape"></div>
<div class="shape"></div>
<div class="shape"></div>

<div class="login-container">
    <div class="login-card">

        <div class="card-header">
            <div class="header-icon">
                <i class="fas fa-store-alt"></i>
            </div>
            <h2>Multi-Branch E-Store</h2>
            <p>Management System</p>
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('login.action') }}">
                @csrf

                <div class="form-group">
                    <label>Username</label>
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control" name="username" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <span>Log In</span>
                    <i class="fas fa-arrow-right"></i>
                </button>

            </form>

        </div>

        <div class="card-footer">
            <small>&copy; 2026 Multi-Branch E-Store. All rights reserved.</small>
        </div>

    </div>
</div>

{{-- Toast Component (المكان الصحيح) --}}
@include('components.toast')

</body>
</html>
