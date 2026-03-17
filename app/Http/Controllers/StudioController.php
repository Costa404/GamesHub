<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\Game;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
    {
        $studios = Studio::withCount('games')->paginate(9);
        $totalStudios = Studio::count();
        $totalGames = Game::count();

        return view('studios.index', compact('studios', 'totalStudios', 'totalGames'));
    }

    public function show($id)
    {
        $studio = Studio::with('games')->findOrFail($id);
        return view('studios.show', compact('studio'));
    }
}
