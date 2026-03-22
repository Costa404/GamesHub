<?php

namespace App\Http\Controllers;

use App\Models\Studio;
use App\Models\Game;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudios = Studio::count();
        $totalGames = Game::count();

        return view('dashboard', compact('totalStudios', 'totalGames'));
    }
}
