<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
    {
        $studios = Studio::withCount('games')->paginate(10);
        return view('admin.studios.index', compact('studios'));
    }

    public function create()
    {
        return view('admin.studios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'image'    => 'nullable|image|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('studios', 'public');
        }

        Studio::create($data);

        return redirect()->route('admin.studios.index')
                         ->with('success', 'Estúdio criado com sucesso!');
    }

    public function edit($id)
    {
        $studio = Studio::findOrFail($id);
        return view('admin.studios.edit', compact('studio'));
    }

    public function update(Request $request, $id)
    {
        $studio = Studio::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'image'    => 'nullable|image|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('studios', 'public');
        }

        $studio->update($data);

        return redirect()->route('admin.studios.index')
                         ->with('success', 'Estúdio atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $studio = Studio::findOrFail($id);
        $studio->delete();

        return redirect()->route('admin.studios.index')
                         ->with('success', 'Estúdio apagado com sucesso!');
    }
}
