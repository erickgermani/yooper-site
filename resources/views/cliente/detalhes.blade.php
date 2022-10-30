@extends('layouts.app', [
    'classe' => 'cliente',
    'id' => 'detalhes',
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
                                <td>

                                </td>
                            </tbody>
                        </table>

                        <hr>

                        <div class="acoes">
                            <a href="{{ route('home') }}" class="btn btn-primary btn-principal">Voltar</a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
