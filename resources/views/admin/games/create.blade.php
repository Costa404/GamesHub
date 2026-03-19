@extends('layouts.app')

@section('title', 'Criar Jogo')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color:#fff;font-size:22px;font-weight:500;">Criar Jogo</h2>
        <a href="{{ route('admin.studios.index') }}" class="btn btn-outline-secondary btn-sm">Voltar</a>
    </div>

    <div class="card p-4">
        <form method="POST" action="{{ route('admin.games.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Estúdio *</label>
                <select name="studio_id" class="form-control @error('studio_id') is-invalid @enderror">
                    <option value="">Selecionar estúdio...</option>
                    @foreach ($studios as $studio)
                        <option value="{{ $studio->id }}" {{ old('studio_id') == $studio->id ? 'selected' : '' }}>
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
                    value="{{ old('name') }}" placeholder="Ex: God of War">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Capa / Imagem</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Data de Lançamento</label>
                <input type="date" name="release_date" class="form-control @error('release_date') is-invalid @enderror"
                    value="{{ old('release_date') }}">
                @error('release_date')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Género</label>
                <select name="genre" class="form-control @error('genre') is-invalid @enderror">
                    <option value="">Selecionar género...</option>
                    <option value="Ação" {{ old('genre') == 'Ação' ? 'selected' : '' }}>Ação</option>
                    <option value="Aventura" {{ old('genre') == 'Aventura' ? 'selected' : '' }}>Aventura</option>
                    <option value="RPG" {{ old('genre') == 'RPG' ? 'selected' : '' }}>RPG</option>
                    <option value="Desporto" {{ old('genre') == 'Desporto' ? 'selected' : '' }}>Desporto</option>
                    <option value="Corridas" {{ old('genre') == 'Corridas' ? 'selected' : '' }}>Corridas</option>
                    <option value="Luta" {{ old('genre') == 'Luta' ? 'selected' : '' }}>Luta</option>
                </select>
                @error('genre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Plataforma</label>
                <select name="platform" class="form-control @error('platform') is-invalid @enderror">
                    <option value="">Selecionar plataforma...</option>
                    <option value="PS3" {{ old('platform') == 'PS3' ? 'selected' : '' }}>PS3</option>
                    <option value="PS4" {{ old('platform') == 'PS4' ? 'selected' : '' }}>PS4</option>
                    <option value="PS5" {{ old('platform') == 'PS5' ? 'selected' : '' }}>PS5</option>
                </select>
                @error('platform')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Classificação PEGI</label>
                <select name="pegi" class="form-control @error('pegi') is-invalid @enderror">
                    <option value="">Selecionar PEGI...</option>
                    <option value="3" {{ old('pegi') == '3' ? 'selected' : '' }}>PEGI 3</option>
                    <option value="7" {{ old('pegi') == '7' ? 'selected' : '' }}>PEGI 7</option>
                    <option value="12" {{ old('pegi') == '12' ? 'selected' : '' }}>PEGI 12</option>
                    <option value="16" {{ old('pegi') == '16' ? 'selected' : '' }}>PEGI 16</option>
                    <option value="18" {{ old('pegi') == '18' ? 'selected' : '' }}>PEGI 18</option>
                </select>
                @error('pegi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Criar Jogo</button>
        </form>
    </div>

@endsection
