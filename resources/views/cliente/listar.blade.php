@php
    use App\Models\ServicoContratado;
    use App\Models\Servico;
@endphp

@extends('layouts.app', [
    'classe' => 'cliente',
    'id' => 'listar',
])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Clientes cadastrados</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Telefone</th>
                                    <th scope="col">Serviços Contratados</th>
                                    <th scope="col">&nbsp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clientes as $cliente)
                                    <tr data-cliente-id="{{ $cliente->id }} ">
                                        <td> {{ $cliente->nome }} </td>
                                        <td> {{ $cliente->telefone }} </td>
                                        <td>
                                            @php
                                                $servicos_contratados = ServicoContratado::where('cliente_id', 'like', $cliente->id)->get();

                                                $array_servicos_contratados = [];

                                                foreach($servicos_contratados as $servico_contratado) {
                                                    $servico = Servico::where('id', 'like', $servico_contratado->servico_id)->get();

                                                    array_push($array_servicos_contratados, $servico->first()->nome);
                                                }

                                                echo implode(' | ', $array_servicos_contratados);                                                
                                            @endphp
                                        </td>
                                        <td> 
                                            <a href=""> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M21.41 14.515c.237-.893 1.314-.889 2.59-1.208v-2.612c-.907-.227-2.352-.313-2.592-1.217l-.001-.006c-.239-.89.639-1.373 1.639-2.34l-1.306-2.263c-.911.26-2.195.903-2.863.237-.646-.643-.114-1.552.255-2.845l-2.263-1.306c-.649.671-1.446 1.878-2.348 1.637l-.006-.001c-.892-.238-.889-1.313-1.209-2.591h-2.612c-.228.911-.313 2.351-1.217 2.592l-.006.002c-.891.238-1.373-.64-2.34-1.64l-2.262 1.307c.26.911.903 2.195.237 2.863-.644.646-1.553.114-2.845-.255l-1.306 2.262c.67.649 1.878 1.446 1.637 2.348l-.001.006c-.238.893-1.317.89-2.59 1.208v2.612c.907.227 2.352.313 2.592 1.217l.002.006c.238.891-.64 1.373-1.64 2.34l1.306 2.263c.911-.26 2.195-.903 2.863-.237.646.643.114 1.552-.255 2.845l2.263 1.306c.649-.671 1.446-1.878 2.348-1.637l.006.001c.893.238.889 1.313 1.208 2.59h2.612c.228-.911.313-2.351 1.217-2.592l.006-.002c.891-.238 1.373.64 2.34 1.64l2.263-1.306c-.26-.909-.904-2.193-.237-2.863.643-.646 1.552-.114 2.845.255l1.306-2.263c-.671-.649-1.878-1.446-1.637-2.348l.001-.005zm-9.41 1.485c-2.209 0-4-1.791-4-4s1.791-4 4-4 4 1.791 4 4-1.791 4-4 4z"/></svg> 
                                            </a>
                                            <a href=""> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M23.111 20.058l-4.977-4.977c.965-1.52 1.523-3.322 1.523-5.251 0-5.42-4.409-9.83-9.829-9.83-5.42 0-9.828 4.41-9.828 9.83s4.408 9.83 9.829 9.83c1.834 0 3.552-.505 5.022-1.383l5.021 5.021c2.144 2.141 5.384-1.096 3.239-3.24zm-20.064-10.228c0-3.739 3.043-6.782 6.782-6.782s6.782 3.042 6.782 6.782-3.043 6.782-6.782 6.782-6.782-3.043-6.782-6.782zm2.01-1.764c1.984-4.599 8.664-4.066 9.922.749-2.534-2.974-6.993-3.294-9.922-.749z"/></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <hr>

                        <div class="acoes">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-principal">Voltar</a>
                            <a href="{{ route('cliente.cadastrar') }}" class="btn btn-outline-primary btn-principal">Cadastrar cliente</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
