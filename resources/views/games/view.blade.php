@extends('layouts.app')

@section('title', $studio->name)

@section('content')

    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-building me-2"></i>{{ $studio->name }}
            </h1>
            <p class="text-muted mt-1">{{ $studio->location ?? 'Localização desconhecida' }}</p>
        </div>
        <div class="d-flex gap-2">
            @if (auth()->check() && auth()->user()->is_admin)
                <a href="{{ route('admin.games.create') }}?studio_id={{ $studio->id }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-plus-lg me-1"></i>Novo Jogo
                </a>
            @endif
            <a href="{{ route('studios.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i>Voltar
            </a>
        </div>
    </div>

    {{-- FILTROS --}}
    <form method="GET" action="{{ route('studios.games', $studio->id) }}" class="mb-4">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Pesquisar jogo..."
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select name="platform" class="form-control">
                    <option value="">Todas as plataformas</option>
                    @foreach (['PS3', 'PS4', 'PS5'] as $p)
                        <option value="{{ $p }}" {{ request('platform') == $p ? 'selected' : '' }}>
                            {{ $p }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="genre" class="form-control">
                    <option value="">Todos os géneros</option>
                    @foreach (['Ação', 'Aventura', 'RPG', 'Desporto', 'Corridas', 'Luta'] as $g)
                        <option value="{{ $g }}" {{ request('genre') == $g ? 'selected' : '' }}>
                            {{ $g }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-search"></i>
                </button>
                @if (request('search') || request('platform') || request('genre'))
                    <a href="{{ route('studios.games', $studio->id) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x"></i>
                    </a>
                @endif
            </div>
        </div>
    </form>

    @if ($games->isEmpty())
        <div class="card p-5 text-center">
            <i class="bi bi-controller" style="font-size:48px;color:var(--text-muted);"></i>
            <p class="text-muted mt-3">Nenhum jogo encontrado.</p>
        </div>
    @else
        <div class="section-title">{{ $games->total() }} jogos encontrados</div>
        <div class="row g-3">
            @foreach ($games as $game)
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ $game->image ? asset('storage/' . $game->image) : 'https://placehold.co/400x200/1a1a24/7f77dd?text=' . $game->name }}"
                            class="card-img-top" style="height:160px;object-fit:cover;">
                        <div class="card-body d-flex flex-column">
                            <h5 style="color:var(--text-primary);font-size:15px;font-weight:600;">{{ $game->name }}</h5>
                            <div class="d-flex gap-2 flex-wrap mb-2">
                                @if ($game->platform)
                                    <span
                                        class="badge-platform badge-{{ strtolower($game->platform) }}">{{ $game->platform }}</span>
                                @endif
                                @if ($game->pegi)
                                    <span class="badge-pegi">PEGI {{ $game->pegi }}</span>
                                @endif
                                @if ($game->genre)
                                    <span class="badge-games">{{ $game->genre }}</span>
                                @endif
                            </div>
                            @if ($game->release_date)
                                <p class="text-muted mt-auto" style="font-size:12px;">
                                    <i
                                        class="bi bi-calendar me-1"></i>{{ \Carbon\Carbon::parse($game->release_date)->format('d/m/Y') }}
                                </p>
                            @endif
                            @auth
                                @if (auth()->user()->is_admin)
                                    <div class="d-flex gap-2 mt-2">
                                        <a href="{{ route('admin.games.edit', $game->id) }}"
                                            class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-pencil me-1"></i>Editar
                                        </a>
                                        <form method="POST" action="{{ route('admin.games.destroy', $game->id) }}"
                                            onsubmit="return confirm('Tens a certeza?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger-soft btn-sm">
                                                <i class="bi bi-trash me-1"></i>Apagar
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="d-flex gap-2 mt-2">
                                        <a href="{{ route('games.edit', $game->id) }}"
                                            class="btn btn-outline-secondary btn-sm">
                                            <i class="bi bi-pencil me-1"></i>Editar
                                        </a>
                                        <button class="btn btn-outline-secondary btn-sm" disabled
                                            style="opacity:0.4;cursor:not-allowed;">
                                            <i class="bi bi-lock me-1"></i>Apagar
                                        </button>
                                    </div>
                                    <div class="mt-2 p-2"
                                        style="font-size:11px;color:var(--danger);background:var(--danger-bg);border-radius:6px;">
                                        <i class="bi bi-shield-exclamation me-1"></i>Não podes apagar jogos.
                                    </div>
                                @endif
                            @endauth
                            <a href="{{ route('reviews.index', $game->id) }}"
                                class="btn btn-outline-secondary btn-sm mt-2">
                                <i class="bi bi-star me-1"></i>Reviews
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $games->links() }}
        </div>
    @endif

@endsection
