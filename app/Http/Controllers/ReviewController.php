<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Game;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index($gameId)
    {
        $game = Game::with('studio')->findOrFail($gameId);
        $reviews = Review::with('user')
                         ->where('game_id', $gameId)
                         ->latest()
                         ->paginate(5);

        $average = Review::where('game_id', $gameId)->avg('rating');
        $userReview = auth()->check()
            ? Review::where('user_id', auth()->id())->where('game_id', $gameId)->first()
            : null;

        return view('games.reviews', compact('game', 'reviews', 'average', 'userReview'));
    }

    public function store(Request $request, $gameId)
    {
        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $existing = Review::where('user_id', auth()->id())
                          ->where('game_id', $gameId)
                          ->first();

        if ($existing) {
            return back()->with('error', 'Já fizeste uma review a este jogo!');
        }

        Review::create([
            'user_id' => auth()->id(),
            'game_id' => $gameId,
            'rating'  => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review adicionada com sucesso!');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if ($review->user_id !== auth()->id() && !auth()->user()->is_admin) {
            return back()->with('error', 'Não tens permissão para apagar esta review.');
        }

        $review->delete();

        return back()->with('success', 'Review apagada com sucesso!');
    }
}
