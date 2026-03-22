<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $studios = Studio::all();
        return view('games.edit', compact('game', 'studios'));
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'release_date' => 'nullable|date',
            'genre'        => 'nullable|string',
            'platform'     => 'nullable|string',
            'pegi'         => 'nullable|string',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'release_date', 'genre', 'platform', 'pegi']);

        if ($request->hasFile('image')) {
            if ($game->image) {
                Storage::delete('public/' . $game->image);
            }
            $data['image'] = $request->file('image')->store('games', 'public');
        }

        $game->update($data);

        return redirect()->route('studios.games', $game->studio_id)
                         ->with('success', 'Jogo atualizado com sucesso!');
    }
}
