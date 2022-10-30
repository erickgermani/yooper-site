@extends('layouts.app', [
    'id' => 'home',
])

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        {{ __('Seja bem-vindo ao dashboard.') }}

                        <hr>

                        <div class="acoes">
                            <a href="{{ route('cliente.listar') }}" class="btn btn-outline-primary btn-principal">Ver todos os clientes</a>
                            <a href="{{ route('cliente.cadastrar') }}" class="btn btn-outline-primary btn-principal">Cadastrar cliente</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
