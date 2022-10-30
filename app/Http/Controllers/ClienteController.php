<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Models\Servico;
use App\Models\ServicoContratado;
use Exception;

class ClienteController extends Controller
{

    public function __construct(Cliente $cliente) {
        $this->cliente = $cliente;
    }

    public function listar()
    {
        $clientes = $this->cliente->paginate(10);

        return view('cliente.listar', [ 
            "clientes" => $clientes 
        ]);
    }

    public function cadastrar()
    {
        $servicos = Servico::get();

        return view('cliente.cadastrar', [ 
            "servicos" => $servicos 
        ]);
    }

    public function store(StoreClienteRequest $request)
    {
        try {
            $params = [
                "nome" => $request->get('nome'),
                "email" => $request->get('email'),
                "telefone" => $request->get('telefone'),
                "nome_da_empresa" => $request->get('nome-da-empresa')
            ];
    
            $cliente = $this->cliente->create($params);
    
            $servicos_contratados = json_decode($request->get('servicos-contratados'));
    
            foreach($servicos_contratados as $servico_contratado) {
                ServicoContratado::create([
                    "cliente_id" => $cliente->id,
                    "servico_id" => $servico_contratado
                ]);
            }
    
            return view('cliente.feedback', [ 
                "titulo" => "Sucesso", 
                "mensagem" => "Cliente cadastrado com sucesso!"
            ]);
        } catch (Exception $ex) {
            return view('cliente.feedback', [ 
                "titulo" => "Falha", 
                "mensagem" => "Um erro ocorreu e não foi possível cadastrar o cliente. Tente novamente mais tarde." 
            ]);
        }
    }

    public function detalhes($id)
    {
        $cliente = Cliente::where('id', 'like', $id)->take(1)->get()->first();

        if(!empty($cliente)) {
            $servicos = Servico::get();

            return view('cliente.detalhes', [ 
                "cliente" => $cliente,
                "servicos" => $servicos 
            ]);
        } else {
            return view('cliente.feedback', [ 
                "titulo" => "Falha", 
                "mensagem" => "Não foi possível encontrar o cliente em nossa base de dados." 
            ]);
        }
    }
}
