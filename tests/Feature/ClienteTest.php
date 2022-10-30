<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Servico;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ClienteTest extends TestCase
{

    // use RefreshDatabase;

    // public function test_criar_servicos()
    // {        
    //     $servico = new Servico();

    //     $servico->create([ 'nome' => 'Social Media' ]);
    //     $servico->create([ 'nome' => 'CRM' ]);
    //     $servico->create([ 'nome' => 'Mídia' ]);
    //     $servico->create([ 'nome' => 'SEO' ]);
    // }

    // public function test_ver_todos_os_clientes()
    // {        
    //     $response = $this->get('/app/cliente');

    //     $response->assertStatus(200);
    // }

    public function test_criar_cliente_com_dados_preenchidos()
    {        
        $servico = new Servico();

        $servico->create([ 'nome' => 'Social Media' ]);
        $servico->create([ 'nome' => 'CRM' ]);
        $servico->create([ 'nome' => 'Mídia' ]);
        $servico->create([ 'nome' => 'SEO' ]);

        $id = $servico->get()->first()->id;

        $cliente = [
            "nome" => fake()->name(),
            "email" => fake()->safeEmail(),
            "telefone" => fake()->phoneNumber(),
            "nome-da-empresa" => fake()->name(),
            "servicos-contratados" => "[$id]"
        ];

        $response = $this->post('/app/cliente', $cliente);

        $response->assertStatus(201);
    }
}
