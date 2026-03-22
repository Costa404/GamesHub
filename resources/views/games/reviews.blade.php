@extends('layouts.app')

@section('title', 'Reviews — ' . $game->name)

@section('content')

    <div class="page-header">
        <div>
            <h1 class="page-title">
                <i class="bi bi-star me-2"></i>{{ $game->name }}
            </h1>
            <p class="text-muted mt-1">{{ $game->studio->name }}</p>
        </div>
        <a href="{{ route('studios.games', $game->studio_id) }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Voltar
        </a>
    </div>

    {{-- MÉDIA --}}
    <div class="card p-4 mb-4">
        <div class="d-flex align-items-center gap-3">
            <div style="font-size:48px;font-weight:700;color:var(--accent);">
                {{ $average ? number_format($average, 1) : '—' }}
            </div>
            <div>
                <div style="font-size:24px;color:#f5c542;">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= round($average))
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </div>
                <div class="text-muted" style="font-size:13px;">{{ $reviews->total() }} reviews</div>
            </div>
        </div>
    </div>

    {{-- FORMULÁRIO --}}
    @auth
        @if(!$userReview)
            <div class="card p-4 mb-4">
                <h5 style="color:var(--text-primary);font-size:16px;margin-bottom:1rem;">
                    <i class="bi bi-pencil me-2"></i>Escrever Review
                </h5>
                <form method="POST" action="{{ route('reviews.store', $game->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Classificação *</label>
                        <div class="d-flex gap-2">
                            @for($i = 1; $i <= 5; $i++)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rating"
                                           id="star{{ $i }}" value="{{ $i }}"
                                           {{ old('rating') == $i ? 'checked' : '' }}>
                                    <label class="form-check-label" for="star{{ $i }}"
                                           style="color:#f5c542;font-size:20px;">★</label>
                                </div>
                            @endfor
                        </div>
                        @error('rating')
                            <div style="color:var(--danger);font-size:12px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Comentário</label>
                        <textarea name="comment" class="form-control" rows="3"
                                  placeholder="Escreve a tua opinião...">{{ old('comment') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send me-1"></i>Publicar Review
                    </button>
                </form>
            </div>
        @else
            <div class="alert alert-success mb-4">
                <i class="bi bi-check-circle me-2"></i>Já fizeste uma review a este jogo!
            </div>
        @endif
    @else
        <div class="card p-4 mb-4 text-center">
            <p class="text-muted mb-2">Faz login para deixares a tua review!</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-box-arrow-in-right me-1"></i>Login
            </a>
        </div>
    @endauth

    {{-- LISTA DE REVIEWS --}}
    @if($reviews->isEmpty())
        <div class="card p-5 text-center">
            <i class="bi bi-star" style="font-size:48px;color:var(--text-muted);"></i>
            <p class="text-muted mt-3">Ainda não há reviews para este jogo.</p>
        </div>
    @else
        <div class="section-title">Reviews</div>
        <div class="d-flex flex-column gap-3">
            @foreach($reviews as $review)
                <div class="card p-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div style="font-size:16px;color:#f5c542;">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </div>
                            <div style="font-size:13px;font-weight:500;color:var(--text-primary);">
                                {{ $review->user->name }}
                            </div>
                            <div style="font-size:11px;color:var(--text-muted);">
                                {{ $review->created_at->format('d/m/Y') }}
                            </div>
                        </div>
                        @if(auth()->check() && ($review->user_id === auth()->id() || auth()->user()->is_admin))
                            <form method="POST" action="{{ route('reviews.destroy', $review->id) }}"
                                  onsubmit="return confirm('Apagar review?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger-soft btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        @endif
                    </div>
                    @if($review->comment)
                        <p style="margin-top:8px;font-size:14px;color:var(--text-secondary);">
                            {{ $review->comment }}
                        </p>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $reviews->links() }}
        </div>
    @endif

@endsection
