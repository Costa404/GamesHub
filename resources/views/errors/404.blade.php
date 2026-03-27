@extends('layouts.app')

@section('title', 'Página não encontrada')

@section('content')

    <div class="text-center py-5">
        <div style="font-size:80px;font-weight:700;color:var(--accent);">404</div>
        <h2 style="color:var(--text-primary);font-size:24px;font-weight:500;">Página não encontrada</h2>
        <p class="text-muted mt-2">A página que procuras não existe ou foi removida.</p>
        <a href="{{ route('studios.index') }}" class="btn btn-primary mt-3">
            <i class="bi bi-house me-1"></i>Voltar ao início
        </a>
    </div>

@endsection
