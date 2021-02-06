<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate([
           'email' => 'admin@wallpaper.ru'
        ],
        [
            'name' => 'admin@wallpaper.ru',
            'password' => 'password'
        ]);
    }
}
