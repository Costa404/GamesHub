@extends('layouts.app')

@section('title', 'Gerir Estúdios')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 style="color:#fff;font-size:22px;font-weight:500;">Gerir Estúdios</h2>
        <a href="{{ route('admin.studios.create') }}" class="btn btn-primary btn-sm">+ Novo Estúdio</a>
    </div>

    <div class="card">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Logo</th>
                    <th>Nome</th>
                    <th>Localização</th>
                    <th>Jogos</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($studios as $studio)
                    <tr>
                        <td>
                            <img src="{{ $studio->image ? asset('storage/' . $studio->image) : 'https://placehold.co/50x50/18181f/7f77dd?text=G' }}"
                                width="50" height="50" style="object-fit:cover;border-radius:6px;">
                        </td>
                        <td style="vertical-align:middle;">{{ $studio->name }}</td>
                        <td style="vertical-align:middle;color:#7070a0;">{{ $studio->location ?? '—' }}</td>
                        <td style="vertical-align:middle;">
                            <span class="badge-games">{{ $studio->games_count }} jogos</span>
                        </td>
                        <td style="vertical-align:middle;">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.studios.edit', $studio->id) }}"
                                    class="btn btn-outline-secondary btn-sm">Editar</a>
                                <form method="POST" action="{{ route('admin.studios.destroy', $studio->id) }}"
                                    onsubmit="return confirm('Tens a certeza?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm"
                                        style="background:#3b1a1a;color:#e24b4a;">Apagar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Nenhum estúdio encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $studios->links() }}
    </div>

@endsection
