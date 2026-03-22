<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamesHub — @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css\app.css') }}" rel="stylesheet">
</head>


<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('studios.index') }}">
                <div class="brand-icon">
                    <i class="bi bi-controller"></i>
                </div>
                Games<span class="brand-dot">Hub</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">

                <ul class="navbar-nav ms-auto gap-2 align-items-center">
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-person-plus"></i> Registar
                            </a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item d-flex align-items-center">
                            <span style="font-size:13px;color:var(--text-muted);">
                                Olá, <strong style="color:var(--accent);">{{ auth()->user()->name }}</strong>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>
                        @if (auth()->user()->is_admin)
                            <li class="nav-item">
                                <a href="{{ route('admin.studios.index') }}" class="btn btn-admin btn-sm">
                                    <i class="bi bi-shield-lock"></i> Admin
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </button>
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    {{-- CONTEÚDO --}}
    <main class="flex-grow-1 py-4">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mb-3">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-3">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <span style="color:var(--text-primary);font-size:15px;font-weight:600;">
                    Games<span style="color:var(--accent);">Hub</span>
                </span>

                <span style="color:var(--text-muted);font-size:12px;">© 2026 GamesHub — NunoCosta</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
