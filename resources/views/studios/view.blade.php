@extends('layouts.app')

@section('title', 'Início')

@section('content')

    {{-- HERO --}}
    <div class="text-center py-5">
        <h1 style="font-size:36px;font-weight:500;color:#fff;">Descobre o universo dos jogos</h1>
        <p style="color:#7070a0;font-size:16px;">Explora estúdios, jogos e muito mais numa só plataforma</p>
        <form method="GET" action="{{ route('studios.index') }}" class="d-flex justify-content-center gap-2 mt-3">
            <input type="text" name="search" class="form-control" style="max-width:350px;"
                placeholder="Pesquisar estúdio..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
        </form>
    </div>

    {{-- STATS --}}
    <div class="row g-3 mb-4">
        <div class="col-4">
            <div class="card text-center p-3">
                <div style="font-size:28px;font-weight:500;color:#fff;">{{ $totalStudios }}</div>
                <div class="text-muted" style="font-size:13px;">Estúdios</div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-center p-3">
                <div style="font-size:28px;font-weight:500;color:#fff;">{{ $totalGames }}</div>
                <div class="text-muted" style="font-size:13px;">Jogos</div>
            </div>
        </div>
        <div class="col-4">
            <div class="card text-center p-3">
                <div style="font-size:28px;font-weight:500;color:#fff;">3</div>
                <div class="text-muted" style="font-size:13px;">Plataformas</div>
            </div>
        </div>
    </div>

    {{-- LISTA DE ESTÚDIOS --}}
    <div
        style="font-size:11px;font-weight:500;color:#7070a0;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:1rem;">
        Estúdios em destaque
    </div>

    <div class="row g-3">
        @forelse($studios as $studio)
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="{{ $studio->image ? asset('storage/' . $studio->image) : 'https://placehold.co/400x150/18181f/7f77dd?text=' . $studio->name }}"
                        class="card-img-top" style="height:140px;object-fit:cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title" style="color:#fff;font-size:15px;">{{ $studio->name }}</h5>
                        <p class="text-muted" style="font-size:13px;">{{ $studio->location ?? 'Localização desconhecida' }}
                        </p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="badge-games">{{ $studio->games_count }} jogos</span>
                            <a href="{{ route('studios.games', $studio->id) }}" class="btn btn-primary btn-sm">Ver jogos</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                Nenhum estúdio encontrado.
            </div>
        @endforelse
    </div>


    <div class="mt-4 d-flex justify-content-center">
        {{ $studios->links() }}
    </div>

@endsection
