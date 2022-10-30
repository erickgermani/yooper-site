import React from 'react';
import ReactDOM from 'react-dom';
import MascaraDeEntrada from './mascara-telefone';
import ServicosContratados from './servicos-contratados';

interface IResponse {
    status: 'sucesso' | 'erro'
    mensagem?: string
    
}

interface IModule {
    nome: string
    resposta: IResponse
}

class Cliente {

    private static logs: IModule[] = [];

    public static iniciar = (): void => {
        this.logs.push(
            { 'nome': 'RENDERIZAR_SERVICOS_CONTRATADOS', 'resposta': this.renderizarServicosContratados() }
        );

        this.logs.push(
            { 'nome': 'ADICIONAR_MASCARA_NO_TELEFONE', 'resposta': this.adicionarMascaraDeEntrada() }
        );
    }

    public static debug = (): void => {
        if(this.logs.length) {
            for(const index in this.logs) {
                const { nome, resposta } = this.logs[index];

                if(resposta.status == 'erro') {
                    console.error(`${nome} falhou - ${resposta.mensagem}`);
                }
            }
        }
    }

    private static renderizarServicosContratados = (): IResponse => {
        try {
            const target = document.getElementById('servicos-contratados-root');

            if(target){
                ReactDOM.render(<ServicosContratados />, target);

                return { status: 'sucesso' };
            } else {
                return { status: 'erro', mensagem: 'Componente Serviços Contratados não encontrado' };
            }
        } catch (error) {
            return { status: 'erro', mensagem: error.message };
        }        
    }

    private static adicionarMascaraDeEntrada = (): IResponse => {
        try {
            MascaraDeEntrada.adicionarMascaraDeEntradaNoCampoTelefone();

            return { status: 'sucesso' };
        } catch(error) {
            return { status: 'erro', mensagem: error.message };
        }
    }

}

export default Cliente;