@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-speedometer2 me-2"></i>Dashboard
        </h1>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-value">{{ $totalStudios }}</div>
                <div class="stat-label">Estúdios</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-value">{{ $totalGames }}</div>
                <div class="stat-label">Jogos</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-value">3</div>
                <div class="stat-label">Plataformas</div>
            </div>
        </div>
    </div>

    <div class="card p-4">
        <h4 style="color:var(--accent);">
            <i class="bi bi-hand-wave me-2"></i>Olá, {{ auth()->user()->name }}!
        </h4>
        <p class="text-muted mb-0">Bem-vindo ao teu dashboard.</p>
    </div>

@endsection
