<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Studio;

class StudioSeeder extends Seeder
{
    public function run(): void
    {
        $studios = [
            ['name' => 'Naughty Dog', 'location' => 'Santa Monica, CA'],
            ['name' => 'Santa Monica Studio', 'location' => 'Los Angeles, CA'],
            ['name' => 'Guerrilla Games', 'location' => 'Amesterdão, NL'],
            ['name' => 'Insomniac Games', 'location' => 'Burbank, CA'],
        ];

        foreach ($studios as $studio) {
            Studio::create($studio);
        }
    }
}
