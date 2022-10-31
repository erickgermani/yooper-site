@php
    use App\Models\ServicoContratado;
    use App\Models\Servico;
@endphp

@extends('layouts.app', [
    'classe' => 'cliente',
    'id' => 'buscar',
])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Clientes > Busca</div>
                    <div class="card-body">
                        <nav class="navbar">
                            <form class="form-inline" action="{{ route('cliente.buscar') }}" method="get">
                                <input class="form-control mr-sm-2" type="search" name="query" placeholder="Procurar"
                                    aria-label="Search"
                                    @if (isset($query)) value="{{ $query }}" @endif>
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Procurar</button>
                            </form>
                        </nav>

                        <hr>

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col" class="hidden-phone">Telefone</th>
                                    <th scope="col">Serviços Contratados</th>
                                    <th scope="col">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <td> <a href="{{ route('cliente.detalhes', ['id' => $cliente->id]) }}">{{ $cliente->nome }}
                                            </a> </td>
                                        <td class="hidden-phone"> {{ $cliente->telefone }} </td>
                                        <td>
                                            @php
                                                $servicos_contratados = ServicoContratado::where('cliente_id', 'like', $cliente->id)->get();
                                                
                                                $array_servicos_contratados = [];
                                                
                                                foreach ($servicos_contratados as $servico_contratado) {
                                                    $servico = Servico::find($servico_contratado->servico_id);
                                                
                                                    array_push($array_servicos_contratados, $servico->nome);
                                                }
                                                
                                                echo implode(' | ', $array_servicos_contratados);
                                            @endphp
                                        </td>
                                        <td class="acoes">
                                            <a href="{{ route('cliente.detalhes', ['id' => $cliente->id]) }}">
                                                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                                                    fill-rule="evenodd" clip-rule="evenodd">
                                                    <path
                                                        d="M15.853 16.56c-1.683 1.517-3.911 2.44-6.353 2.44-5.243 0-9.5-4.257-9.5-9.5s4.257-9.5 9.5-9.5 9.5 4.257 9.5 9.5c0 2.442-.923 4.67-2.44 6.353l7.44 7.44-.707.707-7.44-7.44zm-6.353-15.56c4.691 0 8.5 3.809 8.5 8.5s-3.809 8.5-8.5 8.5-8.5-3.809-8.5-8.5 3.809-8.5 8.5-8.5z" />
                                                </svg>
                                            </a>

                                            <a class="hidden-phone"
                                                href="{{ route('cliente.atualizar', ['id' => $cliente->id]) }}">
                                                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                                                    fill-rule="evenodd" clip-rule="evenodd">
                                                    <path
                                                        d="M8.071 21.586l-7.071 1.414 1.414-7.071 14.929-14.929 5.657 5.657-14.929 14.929zm-.493-.921l-4.243-4.243-1.06 5.303 5.303-1.06zm9.765-18.251l-13.3 13.301 4.242 4.242 13.301-13.3-4.243-4.243z" />
                                                </svg>
                                            </a>

                                            <a class="hidden-phone"
                                                href="{{ route('cliente.deletar', ['id' => $cliente->id]) }}"
                                                data-need-confirmation="true"
                                                data-message="Deseja realmente excluir o cliente {{ $cliente->nome }}?">
                                                <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg"
                                                    fill-rule="evenodd" clip-rule="evenodd">
                                                    <path
                                                        d="M9 3h6v-1.75c0-.066-.026-.13-.073-.177-.047-.047-.111-.073-.177-.073h-5.5c-.066 0-.13.026-.177.073-.047.047-.073.111-.073.177v1.75zm11 1h-16v18c0 .552.448 1 1 1h14c.552 0 1-.448 1-1v-18zm-10 3.5c0-.276-.224-.5-.5-.5s-.5.224-.5.5v12c0 .276.224.5.5.5s.5-.224.5-.5v-12zm5 0c0-.276-.224-.5-.5-.5s-.5.224-.5.5v12c0 .276.224.5.5.5s.5-.224.5-.5v-12zm8-4.5v1h-2v18c0 1.105-.895 2-2 2h-14c-1.105 0-2-.895-2-2v-18h-2v-1h7v-2c0-.552.448-1 1-1h6c.552 0 1 .448 1 1v2h7z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $clientes->links('pagination::bootstrap-5') }}

                        <hr>

                        <div class="acoes">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-principal">Voltar</a>
                            <div>
                                <a href="{{ route('cliente.cadastrar') }}"
                                    class="btn btn-outline-primary btn-principal">Cadastrar cliente</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
