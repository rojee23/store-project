<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Multi-Branch E-Store')</title>

    <!-- Bootstrap + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Theme الخاص بالمتاجر -->
    <link rel="stylesheet" href="{{ asset('css/stores-theme.css') }}">
</head>

<body>

    <!-- SHAPES خلفية -->
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>
    <div class="shape"></div>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg" style="background: linear-gradient(135deg, #667eea, #764ba2);">
        <div class="container">
            <a class="navbar-brand text-white fw-bold" href="{{ url('/') }}">
                <i class="fas fa-store-alt me-2"></i> Multi-Branch
            </a>

            <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('dashboard') }}">لوحة التحكم</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('stores.index') }}">الفروع</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('provinces.index') }}">المحافظات</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                تسجيل خروج
                            </a>
                        </li>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">@csrf</form>

                    @else
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ url('/login') }}">تسجيل الدخول</a>
                        </li>
                    @endauth

                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main class="py-4" style="position: relative; z-index: 2;">
        <div class="container">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="text-center py-3 mt-5" style="background: #fafafa; border-top: 1px solid #eee; position: relative; z-index: 2;">
        <p class="mb-0 text-muted">© {{ date('Y') }} Multi-Branch E-Store. جميع الحقوق محفوظة.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>
