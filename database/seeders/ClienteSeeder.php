<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Database\Factories\ClienteFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::factory(ClienteFactory::class, 50)->create();
    }
}
