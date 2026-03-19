@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <h2 style="color:#fff;font-size:22px;font-weight:500;margin-bottom:1.5rem;">Login</h2>

                <form method="POST" action="/login">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>

                <p class="text-center mt-3" style="color:#7070a0;font-size:13px;">
                    Não tens conta? <a href="/register" style="color:#afa9ec;">Registar</a>
                </p>
            </div>
        </div>
    </div>

@endsection
