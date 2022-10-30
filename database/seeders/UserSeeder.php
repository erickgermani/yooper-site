<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            "name" => "Root",
            "email" => "root@root.com",
            "password" => Hash::make('root')
        ]);

        User::factory()->count(3)->create();
    }
}
