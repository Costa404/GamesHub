<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@gameshub.com',
            'password' => Hash::make('password'),
            'is_admin' => 1,
        ]);

        User::create([
            'name'     => 'Utilizador',
            'email'    => 'user@gameshub.com',
            'password' => Hash::make('password'),
            'is_admin' => 0,
        ]);
    }
}
