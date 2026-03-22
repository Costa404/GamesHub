@extends('layouts.app')

@section('title', 'Editar Estúdio')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 style="color:#fff;font-size:22px;font-weight:500;">Editar Estúdio</h2>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.games.create') }}?studio_id={{ $studio->id }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i>Novo Jogo
        </a>
        <a href="{{ route('admin.studios.index') }}" class="btn btn-outline-secondary btn-sm">Voltar</a>
    </div>
</div>

    <div class="card p-4">
        <form method="POST" action="{{ route('admin.studios.update', $studio->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nome do Estúdio *</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $studio->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Localização</label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                    value="{{ old('location', $studio->location) }}">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Logo / Imagem</label>
                @if ($studio->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $studio->image) }}" width="80" height="80"
                            style="object-fit:cover;border-radius:6px;">
                    </div>
                @endif
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Guardar Alterações</button>
        </form>
    </div>

@endsection
