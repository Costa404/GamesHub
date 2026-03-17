<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Game;

class GameSeeder extends Seeder
{
    public function run(): void
    {
        $games = [
            ['studio_id' => 1, 'name' => 'The Last of Us', 'release_date' => '2013-06-14', 'genre' => 'Ação', 'platform' => 'PS3'],
            ['studio_id' => 1, 'name' => 'The Last of Us Part II', 'release_date' => '2020-06-19', 'genre' => 'Ação', 'platform' => 'PS4'],
            ['studio_id' => 1, 'name' => 'Uncharted 4', 'release_date' => '2016-05-10', 'genre' => 'Aventura', 'platform' => 'PS4'],
            ['studio_id' => 2, 'name' => 'God of War', 'release_date' => '2018-04-20', 'genre' => 'Ação', 'platform' => 'PS4'],
            ['studio_id' => 2, 'name' => 'God of War Ragnarök', 'release_date' => '2022-11-09', 'genre' => 'Ação', 'platform' => 'PS5'],
            ['studio_id' => 3, 'name' => 'Horizon Zero Dawn', 'release_date' => '2017-02-28', 'genre' => 'RPG', 'platform' => 'PS4'],
            ['studio_id' => 3, 'name' => 'Horizon Forbidden West', 'release_date' => '2022-02-18', 'genre' => 'RPG', 'platform' => 'PS5'],
            ['studio_id' => 4, 'name' => 'Spider-Man', 'release_date' => '2018-09-07', 'genre' => 'Ação', 'platform' => 'PS4'],
            ['studio_id' => 4, 'name' => 'Spider-Man 2', 'release_date' => '2023-10-20', 'genre' => 'Ação', 'platform' => 'PS5'],
        ];

        foreach ($games as $game) {
            Game::create($game);
        }
    }
}
