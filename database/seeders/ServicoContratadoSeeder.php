<?php

namespace Database\Seeders;

use App\Models\ServicoContratado;
use Illuminate\Database\Seeder;

class ServicoContratadoSeeder extends Seeder
{
    public function run()
    {
        ServicoContratado::factory()->count(100)->create();
    }
}
