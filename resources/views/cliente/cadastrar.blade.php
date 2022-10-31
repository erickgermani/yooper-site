@extends('layouts.app', [
    "classe" => "cliente",
    "id" => "cadastrar"
])

@section('scripts')
    @php
        $array_servicos = [];

        foreach($servicos as $servico) 
            array_push($array_servicos, [ "value" => $servico->id, "label" => $servico->nome ]);
    @endphp

    <script>
        window.SERVICOS = @php echo json_encode($array_servicos); @endphp;

        @if(!empty(old('servicos-contratados')))
            window.SERVICOS_SELECIONADOS = @php echo old('servicos-contratados'); @endphp;
        @endif
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Cadastrar cliente</div>

                    <div class="card-body">
                        <form method="post" action="{{ route('cliente.cadastrar') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" value="{{ old('nome') }}">
                                @error('nome')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"  value="{{ old('email') }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Telefone</label>
                                <input type="text" class="form-control" name="telefone" value="{{ old('telefone') }}" maxlength="15">
                                @error('telefone')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nome da empresa</label>
                                <input type="text" class="form-control" name="nome-da-empresa" value="{{ old('nome-da-empresa') }}">
                                @error('nome-da-empresa')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Serviços contratados</label>
                                <div id="servicos-contratados-root">
                                </div>
                                @error('servicos-contratados')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <hr>

                            <div class="acoes">
                                <button type="button" onclick="history.back();" class="btn btn-outline-primary btn-principal">Voltar</button>
                                <div>
                                    <button type="submit" class="btn btn-primary btn-principal">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
