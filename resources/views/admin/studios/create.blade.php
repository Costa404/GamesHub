@extends('layouts.app')

@section('title', 'Criar Estúdio')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color:#fff;font-size:22px;font-weight:500;">Criar Estúdio</h2>
        <a href="{{ route('admin.studios.index') }}" class="btn btn-outline-secondary btn-sm">Voltar</a>
    </div>

    <div class="card p-4">
        <form method="POST" action="{{ route('admin.studios.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nome do Estúdio *</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" placeholder="Ex: Naughty Dog">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Localização</label>
                <input type="text" name="location" class="form-control @error('location') is-invalid @enderror"
                    value="{{ old('location') }}" placeholder="Ex: Santa Monica, CA">
                @error('location')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Logo / Imagem</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Criar Estúdio</button>
        </form>
    </div>

@endsection
