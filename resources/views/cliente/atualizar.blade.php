@extends('layouts.app', [
    'classe' => 'cliente',
    'id' => 'atualizar',
])

@php
    use App\Models\ServicoContratado;
    use App\Models\Servico;
@endphp

@section('scripts')
    @php
        $array_servicos = [];
        
        foreach ($servicos as $servico) {
            array_push($array_servicos, ['value' => $servico->id, 'label' => $servico->nome]);
        }
    @endphp

    <script>
        window.SERVICOS = @php echo json_encode($array_servicos); @endphp;

        @php
            $servicos_contratados = ServicoContratado::where('cliente_id', 'like', $cliente->id)->get();
            
            $array_servicos_contratados = [];
            
            foreach ($servicos_contratados as $servico_contratado) {
                $servico = Servico::where('id', 'like', $servico_contratado->servico_id)
                    ->take(1)
                    ->get()
                    ->first();
            
                array_push($array_servicos_contratados, $servico->id);
            }
        @endphp

        window.SERVICOS_SELECIONADOS = JSON.parse('@php echo json_encode($array_servicos_contratados); @endphp');
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header">Atualizar cliente</div>
                    <div class="card-body">
                        <form method="post" action="{{ route('cliente.atualizar', ['id' => $cliente->id]) }}"
                            data-need-confirmation="true"
                            data-message="Deseja realmente atualizar o usuário {{ $cliente->nome }}?">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nome</label>
                                <input type="text" class="form-control" name="nome" value="{{ $cliente->nome }}">
                                @error('nome')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ $cliente->email }}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Telefone</label>
                                <input type="text" class="form-control" name="telefone" value="{{ $cliente->telefone }}"
                                    maxlength="15">
                                @error('telefone')
                                    <span class="invalid-feedback" role="alert" style="display: block;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nome da empresa</label>
                                <input type="text" class="form-control" name="nome-da-empresa"
                                    value="{{ $cliente->nome_da_empresa }}">
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
                            </div>

                            <hr>

                            <div class="acoes">
                                <button type="button" onclick="history.back();" class="btn btn-outline-primary btn-principal">Voltar</button>
                                <div>
                                    <a href="{{ route('cliente.deletar', ['id' => $cliente->id]) }}"
                                        class="btn btn-outline-danger" data-need-confirmation="true"
                                        data-message="Deseja realmente excluir o cliente {{ $cliente->nome }}?">
                                        Deletar
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-principal">Salvar alterações</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
