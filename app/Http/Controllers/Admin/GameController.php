<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Studio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function create()
    {
        $studios = Studio::all();
        return view('admin.games.create', compact('studios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'studio_id'    => 'required|exists:studios,id',
            'name'         => 'required|string|max:255',
            'release_date' => 'nullable|date',
            'genre'        => 'nullable|string',
            'platform'     => 'nullable|string',
            'pegi'         => 'nullable|string',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('games', 'public');
        }

        Game::create($data);

        return redirect()->route('admin.studios.index')
                         ->with('success', 'Jogo criado com sucesso!');
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $studios = Studio::all();
        return view('admin.games.edit', compact('game', 'studios'));
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $request->validate([
            'studio_id'    => 'required|exists:studios,id',
            'name'         => 'required|string|max:255',
            'release_date' => 'nullable|date',
            'genre'        => 'nullable|string',
            'platform'     => 'nullable|string',
            'pegi'         => 'nullable|string',
            'image'        => 'nullable|image|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($game->image) {
                Storage::delete('public/' . $game->image);
            }
            $data['image'] = $request->file('image')->store('games', 'public');
        }

        $game->update($data);

        return redirect()->route('admin.studios.index')
                         ->with('success', 'Jogo atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);

        if ($game->image) {
            Storage::delete('public/' . $game->image);
        }

        $game->delete();

        return back()->with('success', 'Jogo apagado com sucesso!');
    }
}
