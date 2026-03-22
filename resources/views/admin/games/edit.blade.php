@extends('layouts.app')

@section('title', 'Editar Jogo')

@section('content')

    <div class="page-header">
        <h1 class="page-title">
            <i class="bi bi-pencil me-2"></i>Editar Jogo — Admin
        </h1>
        <a href="{{ route('admin.studios.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Voltar
        </a>
    </div>

    <div class="card p-4">
        <form method="POST" action="{{ route('admin.games.update', $game->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Estúdio *</label>
                <select name="studio_id" class="form-control @error('studio_id') is-invalid @enderror">
                    <option value="">Selecionar estúdio...</option>
                    @foreach($studios as $studio)
                        <option value="{{ $studio->id }}" {{ old('studio_id', $game->studio_id) == $studio->id ? 'selected' : '' }}>
                            {{ $studio->name }}
                        </option>
                    @endforeach
                </select>
                @error('studio_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Nome do Jogo *</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $game->name) }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Capa / Imagem</label>
                @if($game->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/'.$game->image) }}" width="80" height="80"
                             style="object-fit:cover;border-radius:6px;">
                    </div>
                @endif
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Data de Lançamento</label>
                <input type="date" name="release_date" class="form-control @error('release_date') is-invalid @enderror"
                       value="{{ old('release_date', $game->release_date) }}">
                @error('release_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Género</label>
                <select name="genre" class="form-control @error('genre') is-invalid @enderror">
                    <option value="">Selecionar género...</option>
                    @foreach(['Ação', 'Aventura', 'RPG', 'Desporto', 'Corridas', 'Luta'] as $genre)
                        <option value="{{ $genre }}" {{ old('genre', $game->genre) == $genre ? 'selected' : '' }}>{{ $genre }}</option>
                    @endforeach
                </select>
                @error('genre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Plataforma</label>
                <select name="platform" class="form-control @error('platform') is-invalid @enderror">
                    <option value="">Selecionar plataforma...</option>
                    @foreach(['PS3', 'PS4', 'PS5'] as $platform)
                        <option value="{{ $platform }}" {{ old('platform', $game->platform) == $platform ? 'selected' : '' }}>{{ $platform }}</option>
                    @endforeach
                </select>
                @error('platform')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Classificação PEGI</label>
                <select name="pegi" class="form-control @error('pegi') is-invalid @enderror">
                    <option value="">Selecionar PEGI...</option>
                    @foreach(['3', '7', '12', '16', '18'] as $pegi)
                        <option value="{{ $pegi }}" {{ old('pegi', $game->pegi) == $pegi ? 'selected' : '' }}>PEGI {{ $pegi }}</option>
                    @endforeach
                </select>
                @error('pegi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-1"></i>Guardar Alterações
            </button>
        </form>
    </div>

@endsection
