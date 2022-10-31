<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Http\Requests\StoreClienteRequest;
use App\Http\Requests\UpdateClienteRequest;
use App\Models\Servico;
use App\Models\ServicoContratado;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{

    public function __construct(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function index()
    {
        $clientes = $this->cliente->paginate(10);

        return view('cliente.listar', [
            "clientes" => $clientes
        ]);
    }

    public function create()
    {
        try {
            $servicos = Servico::get();

            if (!empty($servicos)) {
                return view('cliente.cadastrar', [
                    "servicos" => $servicos
                ]);
            } else {
                return redirect(route('feedback', [
                    "titulo" => "Falha",
                    "mensagem" => "Um erro ocorreu e não foi possível carregar as informações necessárias. Tente novamente mais tarde."
                ]));
            }
        } catch (Exception $ex) {
            Log::error($ex);

            return redirect(route('feedback', [
                "titulo" => "Falha",
                "mensagem" => "Um erro ocorreu e não foi possível carregar as informações necessárias. Tente novamente mais tarde."
            ]));
        }
    }

    public function store(StoreClienteRequest $request)
    {
        try {
            $params = [
                "nome" => $request->get('nome'),
                "email" => $request->get('email'),
                "telefone" => $request->get('telefone'),
                "nome_da_empresa" => $request->get('nome-da-empresa'),
                "cadastrado_por" => Auth::user()->id,
                "atualizado_por" => Auth::user()->id
            ];

            $cliente = $this->cliente->create($params);

            $servicos_contratados = json_decode($request->get('servicos-contratados'));

            foreach ($servicos_contratados as $servico_contratado) {
                ServicoContratado::create([
                    "cliente_id" => $cliente->id,
                    "servico_id" => $servico_contratado
                ]);
            }

            return redirect(route('feedback', [
                "titulo" => "Sucesso",
                "mensagem" => "Cliente cadastrado com sucesso."
            ]));
        } catch (Exception $ex) {
            Log::error($ex);

            return redirect(route('feedback', [
                "titulo" => "Falha",
                "mensagem" => "Não foi possível cadastrar o cliente. Tente novamente mais tarde."
            ]));
        }
    }

    public function show($id)
    {
        try {
            $cliente = $this->cliente->find($id);

            if (!empty($cliente)) {
                $servicos = Servico::get();

                return view('cliente.detalhes', [
                    "cliente" => $cliente,
                    "servicos" => $servicos
                ]);
            } else {
                return redirect(route('feedback', [
                    "titulo" => "Falha",
                    "mensagem" => "Cliente não encontrado."
                ]));
            }
        } catch (Exception $ex) {
            Log::error($ex);

            return redirect(route('feedback'), [
                "titulo" => "Falha",
                "mensagem" => "Não foi possível encontrar o cliente. Tente novamente mais tarde."
            ]);
        }
    }

    public function edit($id)
    {
        try {
            $cliente = $this->cliente->find($id);

            if (!empty($cliente)) {
                $servicos = Servico::get();

                return view('cliente.atualizar', [
                    "cliente" => $cliente,
                    "servicos" => $servicos
                ]);
            } else {
                return redirect(route('feedback', [
                    "titulo" => "Falha",
                    "mensagem" => "Cliente não encontrado."
                ]));
            }
        } catch (Exception $ex) {
            Log::error($ex);

            return redirect(route('feedback', [
                "titulo" => "Falha",
                "mensagem" => "Não foi possível encontrar o cliente. Tente novamente mais tarde."
            ]));
        }
    }

    public function update(UpdateClienteRequest $request, $id)
    {
        try {
            $cliente = $this->cliente->find($id);

            if ($cliente !== null) {
                $r_servicos_contratados = $request->get('servicos-contratados');
                $r_old_servicos_contratados = $request->get('old-servicos-contratados');

                if ($r_servicos_contratados !== $r_old_servicos_contratados) {
                    $r_servicos_contratados = json_decode($r_servicos_contratados);
                    $r_old_servicos_contratados = json_decode($r_old_servicos_contratados);

                    foreach ($r_old_servicos_contratados as $old_servico_id) {
                        if (!in_array($old_servico_id, $r_servicos_contratados)) {
                            $servicos_contratados = ServicoContratado::where('cliente_id', '=', $id)->where('servico_id', '=', $old_servico_id)->take(1)->get()->first();

                            if ($servicos_contratados !== null) {
                                $servicos_contratados->delete();
                            }
                        }
                    }

                    foreach ($r_servicos_contratados as $servico_id) {
                        if (!in_array($servico_id, $r_old_servicos_contratados)) {
                            $servicos_contratados = ServicoContratado::create([
                                "cliente_id" => $id,
                                "servico_id" => $servico_id,
                            ]);
                        }
                    }
                }

                $params = [
                    "nome" => $request->get('nome'),
                    "email" => $request->get('email'),
                    "telefone" => $request->get('telefone'),
                    "nome_da_empresa" => $request->get('nome-da-empresa'),
                    "atualizado_por" => Auth::user()->id
                ];

                $cliente->update($params);

                return redirect(route('feedback', [
                    "titulo" => "Sucesso",
                    "mensagem" => "O cliente foi atualizado com sucesso!"
                ]));
            } else {
                return redirect(route('feedback', [
                    "titulo" => "Falha",
                    "mensagem" => "Cliente não encontrado.",
                ]));
            }
        } catch (Exception $ex) {
            Log::error($ex);

            return redirect(route('feedback', [
                "titulo" => "Falha",
                "mensagem" => "Não foi possível atualizar o cliente. Tente novamente mais tarde."
            ]));
        }
    }

    public function destroy($id)
    {
        try {
            $cliente = $this->cliente->find($id);

            if($cliente !== null) {
                $servicos_contratados = ServicoContratado::where('cliente_id', '=', $id)->get();
    
                if($servicos_contratados !== null) {
                    foreach($servicos_contratados as $servico_contratado) {
                        $servico_contratado->delete();
                    }
                }

                $cliente->delete();
                
                return redirect(route('feedback', [
                    "titulo" => "Sucesso",
                    "mensagem" => "O cliente foi deletado com sucesso."
                ]));
            } else {
                return redirect(route('feedback', [
                    "titulo" => "Falha",
                    "mensagem" => "Cliente não encontrado."
                ]));
            }            
        } catch (Exception $ex) {
            Log::error($ex);

            return redirect(route('feedback', [
                "titulo" => "Falha",
                "mensagem" => "Não foi possível excluir o cliente. Tente novamente mais tarde."
            ]));
        }
    }

    public function search(Request $request) 
    {
        $query = $request->input('query');

        if($query == null) 
            return redirect(route('cliente.listar'));
        
        $clientes = Cliente::where('nome', 'like', '%'.$query.'%')->paginate(10)->withQueryString();;

        return view('cliente.buscar', [
            "clientes" => $clientes,
            "query" => $query
        ]);
    }
}
