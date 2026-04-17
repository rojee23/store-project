<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Multi-Branch E-Store</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
          * {
            margin: 0;
            padding: 0;
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

        /* Animated background shapes */
        .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: move 20s infinite;
        }

        .shape:nth-child(1) {
            width: 300px;
            height: 300px;
            top: -150px;
            left: -150px;
            animation-delay: 0s;
        }

        .shape:nth-child(2) {
            width: 400px;
            height: 400px;
            bottom: -200px;
            right: -200px;
            animation-delay: 2s;
        }

        .shape:nth-child(3) {
            width: 200px;
            height: 200px;
            bottom: 50px;
            left: 100px;
            animation-delay: 4s;
        }

        .shape:nth-child(4) {
            width: 150px;
            height: 150px;
            top: 100px;
            right: 150px;
            animation-delay: 6s;
        }

        @keyframes move {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            25% {
                transform: translate(50px, 50px) scale(1.1);
            }
            50% {
                transform: translate(-30px, 20px) scale(0.9);
            }
            75% {
                transform: translate(20px, -40px) scale(1.05);
            }
        }

        /* Glassmorphism card */
        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 450px;
            padding: 20px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            transform: translateY(0);
            transition: all 0.3s ease;
            animation: fadeIn 0.6s ease;
            }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 70px rgba(0, 0, 0, 0.4);
        }

        /* Header with modern design */
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }

        .header-icon {
            width: 90px;
            height: 90px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border: 3px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2), 0 0 20px rgba(255, 255, 255, 0.5);
        }

        .header-icon i {
            font-size: 45px;
            color: white;
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.8));
        }

        .card-header h2 {
            color: white;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .card-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin: 0;
            letter-spacing: 1px;
        }

        /* Card body */
        .card-body {
            padding: 40px 35px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
            transition: all 0.3s ease;
        }

        /* تأثير hover على مجموعة الحقل كاملة */
        .form-group:hover {
            transform: translateX(10px);
        }

        /* تأثير موحد للحقول - نفس التأثير للحقلين */
        .form-group:hover .input-icon {
            color: #667eea;
            transform: rotate(360deg) scale(1.2);
            transition: all 0.5s ease;
        }

        .form-group:hover label {
            color: #667eea;
        }

        .form-group:hover .form-control {
            border-color: #667eea;
            background: #f0f2ff;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            color: #667eea;
            font-size: 16px;
            z-index: 2;
            transition: all 0.3s ease;
        }

        .form-control {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e1e1e1;
            border-radius: 12px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
            background: white;
            transform: scale(1.02);
        }

        .form-control::placeholder {
            color: #aaa;
            font-size: 13px;
            font-weight: 300;
            transition: all 0.3s ease;
        }

        /* تأثير على placeholder عند hover */
        .form-group:hover .form-control::placeholder {
            color: #667eea;
            transform: translateX(10px);
            opacity: 0.7;
        }

        /* Modern login button */
        .btn-login {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            margin-top: 15px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login i {
            margin-left: 8px;
            transition: transform 0.3s ease;
        }

        .btn-login:hover i {
            transform: translateX(5px);
        }

        /* Alert messages */
        .alert {
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: shake 0.5s ease;
            border: none;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        .alert-info {
            background: #e3f2fd;
            color: #0d47a1;
        }

        .alert-danger {
            background: #ffebee;
            color: #c62828;
        }

        .alert i {
            font-size: 18px;
        }

        /* Footer */
        .card-footer {
            padding: 20px 35px;
            text-align: center;
            border-top: 1px solid #f0f0f0;
            background: #fafafa;
        }

        .card-footer small {
            color: #888;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .card-footer:hover small {
            color: #667eea;
            letter-spacing: 2px;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                max-width: 100%;
            }

            .card-header {
                padding: 30px 20px;
            }

            .card-header h2 {
                font-size: 24px;
            }

            .card-body {
                padding: 30px 20px;
            }

            .card-footer {
                padding: 15px 20px;
            }
        }
   </style>
</head>

<body>

<!-- الخلفيات المتحركة -->
<div class="shape"></div>
<div class="shape"></div>
<div class="shape"></div>
<div class="shape"></div>

<div class="login-container">
    <div class="login-card">

        <!-- Header -->
        <div class="card-header">
            <div class="header-icon">
                <i class="fas fa-store-alt"></i>
            </div>
            <h2>Multi-Branch E-Store</h2>
            <p>Management System</p>
        </div>

        <!-- Body -->
        <div class="card-body">

            @if(session('error'))
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.action') }}">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control" name="username" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
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

</body>
</html>
