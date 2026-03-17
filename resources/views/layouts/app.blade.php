<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GamesHub — @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #0f0f13;
            color: #e2e2e8;
            font-family: sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background: #18181f;
            border-bottom: 1px solid #2a2a35;
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar-brand span {
            background: #7f77dd;
            padding: 2px 8px;
            border-radius: 6px;
            margin-right: 6px;
        }

        .nav-link {
            color: #a0a0b0 !important;
        }

        .nav-link:hover {
            color: #fff !important;
        }

        .nav-link.active {
            color: #afa9ec !important;
        }

        .btn-primary {
            background: #7f77dd;
            border: none;
        }

        .btn-primary:hover {
            background: #6d65c5;
        }

        .btn-outline-secondary {
            border-color: #2a2a35;
            color: #a0a0b0;
        }

        .btn-outline-secondary:hover {
            border-color: #7f77dd;
            color: #afa9ec;
            background: transparent;
        }

        .card {
            background: #18181f;
            border: 1px solid #2a2a35;
            color: #e2e2e8;
        }

        .card:hover {
            border-color: #7f77dd;
            transition: border-color 0.2s;
        }

        footer {
            background: #18181f;
            border-top: 1px solid #2a2a35;
            padding: 1.5rem 0;
            margin-top: auto;
        }

        footer a {
            color: #7070a0;
            text-decoration: none;
            font-size: 13px;
        }

        footer a:hover {
            color: #afa9ec;
        }

        .badge-games {
            background: #26215c;
            color: #afa9ec;
            font-size: 11px;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .text-muted {
            color: #7070a0 !important;
        }

        .form-control {
            background: #18181f;
            border: 1px solid #2a2a35;
            color: #e2e2e8;
        }

        .form-control:focus {
            background: #18181f;
            border-color: #7f77dd;
            color: #e2e2e8;
            box-shadow: none;
        }

        .form-label {
            color: #a0a0b0;
            font-size: 13px;
        }

        .table {
            color: #e2e2e8;
        }

        .table thead th {
            color: #7070a0;
            border-color: #2a2a35;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .table td {
            border-color: #2a2a35;
        }

        .alert-danger {
            background: #3b1a1a;
            border-color: #e24b4a;
            color: #f09595;
        }

        .alert-success {
            background: #0a2a1a;
            border-color: #1d9e75;
            color: #5dcaa5;
        }

        .dropdown-menu {
            background: #18181f;
            border: 1px solid #2a2a35;
        }

        .dropdown-item {
            color: #a0a0b0;
        }

        .dropdown-item:hover {
            background: #22222e;
            color: #fff;
        }

        .dropdown-divider {
            border-color: #2a2a35;
        }
    </style>
</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('studios.index') }}">
                <span>G</span>GamesHub
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('studios.*') ? 'active' : '' }}"
                            href="{{ route('studios.index') }}">Estúdios</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto gap-2">
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Registar</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item d-flex align-items-center">
                            <span class="text-muted me-2" style="font-size:13px;">Olá, <strong
                                    style="color:#afa9ec;">{{ auth()->user()->name }}</strong></span>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm">Dashboard</a>
                        </li>
                        @if (auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a href="{{ route('admin.studios.index') }}" class="btn btn-sm"
                                    style="background:#3b1a1a;color:#e24b4a;">Admin</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-sm">Logout</button>
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
                <div class="alert alert-success mb-3">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger mb-3">{{ session('error') }}</div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- FOOTER --}}
    <footer>
        <div class="container d-flex justify-content-between align-items-center">
            <span style="color:#fff;font-size:14px;font-weight:500;">GamesHub</span>
            <div class="d-flex gap-3">
                <a href="{{ route('studios.index') }}">Estúdios</a>
                @auth
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                @endauth
            </div>
            <span style="color:#3a3a55;font-size:12px;">© 2025 GamesHub — Projeto académico</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
