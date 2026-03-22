<?php
namespace App\Http\Controllers;
use App\Models\Studio;
use App\Models\Game;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
    {
        $query = request('search');
        $studios = Studio::withCount('games')
            ->when($query, fn($q) => $q->where('name', 'like', "%$query%"))
            ->paginate(3);

        $totalStudios = Studio::count();
        $totalGames = Game::count();

        return view('studios.view', compact('studios', 'totalStudios', 'totalGames'));
    }

   public function show($id)
{
    $studio = Studio::findOrFail($id);
    $search = request('search');
    $platform = request('platform');
    $genre = request('genre');

    $games = $studio->games()
        ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
        ->when($platform, fn($q) => $q->where('platform', $platform))
        ->when($genre, fn($q) => $q->where('genre', $genre))
        ->paginate(6);

    return view('games.view', compact('studio', 'games'));
}
}
