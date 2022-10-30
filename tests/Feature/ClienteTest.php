<?php

namespace Tests\Feature;

use App\Models\Cliente;
use App\Models\Servico;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Database\Seeders\ClienteSeeder;
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

    // public function test_atualizar_cliente_com_dados_corretos()
    // {
    //     $clientes = new Cliente();

    //     $cliente = $clientes->get()->last();

    //     $response = $this->post(route('cliente.atualizar', [ "id" => $cliente->id ]), [
    //         "nome" => $cliente->nome,
    //         "email" => $cliente->email,
    //         "telefone" => $cliente->telefone,
    //         "nome-da-empresa" => $cliente->nome_da_empresa,
    //         "atualizado-por" => $cliente->atualizado_por,
    //         "servicos-contratados" => "[7,6]",
    //     ]);

    //     $response->assertStatus(200);
    // }

    // public function test_criar_cliente_com_dados_preenchidos()
    // {        
    //     $servico = new Servico();

        // $servico->create([ 'nome' => 'Social Media' ]);
        // $servico->create([ 'nome' => 'CRM' ]);
        // $servico->create([ 'nome' => 'Mídia' ]);
        // $servico->create([ 'nome' => 'SEO' ]);

    //     $id = $servico->get()->first()->id;

    //     $cliente = [
    //         "nome" => fake()->name(),
    //         "email" => fake()->safeEmail(),
    //         "telefone" => '(11) 11111-1111',
    //         "nome-da-empresa" => fake()->name(),
    //         "servicos-contratados" => "[$id]"
    //     ];

    //     $response = $this->post('/app/cliente/cadastrar', $cliente);

    //     $response->assertStatus(200);
    // }

    public function test_criar_clientes_com_seeder(){
        Cliente::factory()->count(50)->create();
    }
}
