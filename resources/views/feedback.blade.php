@extends('layouts.app', [
    'id' => 'cliente',
])

@php
    $titulo = request()->input('titulo') ? request()->input('titulo') : 'Falha';
    $mensagem = request()->input('mensagem') ? request()->input('mensagem') : 'Ops!! Algo deu errado!';
    $pagina_anterior = request()->input('pagina_anterior') ? request()->input('pagina_anterior') : route('home');
@endphp

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
                            <button type="button" onclick="@if($titulo == 'Falha') history.back(); @else {{ 'location.assign("'.route('home').'");' }} @endif" class="btn btn-outline-primary btn-principal">Voltar</button>
                            <div>
                                <a href="{{ route('cliente.listar') }}" class="btn btn-outline-primary btn-principal">Ver todos os cadastros</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
