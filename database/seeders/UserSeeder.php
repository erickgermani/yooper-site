<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     "name" => "Root",
        //     "email" => "root@root.com",
        //     "password" => Crypt::encryptString('root')
        // ]);

        User::factory(UserFactory::class, 3)->create();
    }
}
