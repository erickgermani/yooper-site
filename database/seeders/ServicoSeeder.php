<?php

namespace Database\Seeders;

use App\Models\Servico;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Servico::create([ 'nome' => 'Social Media' ]);
        Servico::create([ 'nome' => 'CRM' ]);
        Servico::create([ 'nome' => 'Mídia' ]);
        Servico::create([ 'nome' => 'SEO' ]);
    }
}
