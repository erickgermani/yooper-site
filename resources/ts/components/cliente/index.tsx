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

        this.logs.push(
            { 'nome': 'ABRIR_MODAL', 'resposta': this.exigirConfirmacao() }
        );
    }

    public static debug = (): void => {
        if(this.logs.length) {
            for(const index in this.logs) {
                const { nome, resposta } = this.logs[index];

                if(resposta.status == 'erro') {
                    console.error(`${nome} falhou - ${resposta.mensagem}`);
                } else {
                    console.debug(`${nome} carregado com sucesso`);
                }
            }
        }
    }

    private static exigirConfirmacao = (): IResponse => {
        try {
            $('a[data-need-confirmation="true"]').on('click', (event) => {
                const $target = $(event.target),    
                    href = $target?.attr('href'),
                    message = $target?.data('message') ?? 'Você realmente deseja prosseguir com esta ação?';
    
                if(!href) return;
    
                if(!confirm(message + ' Esta ação não poderá ser desfeita.')) 
                    event.preventDefault();
            });
    
            $('form[data-need-confirmation="true"]').on('submit', (event) => {
                event.preventDefault();
    
                const $target = $(event.target),
                    message = $target?.data('message') ?? 'Você realmente deseja prosseguir com esta ação?';
    
                if(confirm(message + ' Esta ação não poderá ser desfeita.')) 
                    (event.currentTarget as HTMLFormElement).submit();
            });
    
            return { status: 'sucesso' };
        } catch(error) {
            return { status: 'erro', mensagem: error.message };
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