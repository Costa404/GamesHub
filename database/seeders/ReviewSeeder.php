<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $reviews = [
            ['user_id' => 1, 'game_id' => 1, 'rating' => 5, 'comment' => 'Obra prima absoluta!'],
            ['user_id' => 1, 'game_id' => 2, 'rating' => 5, 'comment' => 'Melhor jogo que joguei!'],
            ['user_id' => 1, 'game_id' => 4, 'rating' => 4, 'comment' => 'Muito bom, história incrível.'],
            ['user_id' => 2, 'game_id' => 1, 'rating' => 4, 'comment' => 'Excelente jogo!'],
            ['user_id' => 1, 'game_id' => 3, 'rating' => 3, 'comment' => 'Bom mas esperava mais.'],
            ['user_id' => 2, 'game_id' => 5, 'rating' => 5, 'comment' => 'God of War Ragnarök é incrível!'],
            ['user_id' => 1, 'game_id' => 6, 'rating' => 4, 'comment' => 'God '],
            ['user_id' => 2, 'game_id' => 7, 'rating' => 4, 'comment' => 'God !'],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
