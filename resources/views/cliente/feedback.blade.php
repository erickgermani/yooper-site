@extends('layouts.app', [
    'id' => 'cliente',
])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">{{ $titulo }}</div>

                    <div class="card-body">
                        {{ $mensagem }}

                        <hr>

                        <div class="acoes">
                            <a href="{{ route('home') }}" class="btn btn-outline-primary btn-principal">Voltar</a>
                            <a href="{{ route('cliente.listar') }}" class="btn btn-outline-primary btn-principal">Ver todos os cadastros</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
