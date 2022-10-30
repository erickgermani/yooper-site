<?php

namespace Database\Seeders;

use App\Models\Servico;
use Illuminate\Database\Seeder;

class ServicoSeeder extends Seeder
{
    public function run()
    {
        Servico::create([ 'nome' => 'Social Media' ]);
        Servico::create([ 'nome' => 'CRM' ]);
        Servico::create([ 'nome' => 'Mídia' ]);
        Servico::create([ 'nome' => 'SEO' ]);
    }
}
