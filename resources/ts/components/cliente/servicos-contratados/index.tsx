import React, { Component } from 'react';
import Select from 'react-select';

interface IOption {
    value: number
    label: string
}

interface IProps {
}

interface IState {
    refreshed: boolean
    servicosContratados: string
}

class ServicosContratados extends Component<IProps, IState> {

    private options: IOption[];
    private DEFAULT_VALUES: number[];
    private action: 'cadastrar'  | 'detalhes' | 'atualizar' | null;

    state: IState = {
        refreshed: false,
        servicosContratados: '[]'
    };

    constructor(props: IProps) {
        super(props);

        // @ts-ignore
        this.options = window.SERVICOS;

        // @ts-ignore
        this.DEFAULT_VALUES = window?.SERVICOS_SELECIONADOS ?? [];

        const action = $('body')?.attr('id') ?? null;

        if(action) {
            if(action == 'cadastrar' || action == 'detalhes' || action == 'atualizar')
                this.action = action;
            else
                this.action = null;
        }
    }

    onChange = (values: IOption[]): void => {
        const servicosContratados: number[] = values.map(({ value }) => {
            return value;
        });
            
        this.setState({ servicosContratados: JSON.stringify(servicosContratados), refreshed: true })
    }

    render(): JSX.Element {
        const { refreshed } = this.state;

        const opcoesSelecionadas: IOption[] = [],
            servicosContratados: number[] = [];

        if(this.action == 'atualizar') {
            if(!refreshed) {
                if(this.DEFAULT_VALUES.length) {
                    this.DEFAULT_VALUES.forEach((value) => {
                        this.options.forEach(option => {
                            if(option.value == value)
                                opcoesSelecionadas.push(option);
                        });
                    });
                }
            } else {
                const servicos: number[] = JSON.parse(this.state.servicosContratados);

                if(servicos.length) {
                    servicos.forEach((servicoId) => {
                        this.options.forEach(option => {
                            if(option.value == servicoId)
                                servicosContratados.push(option.value);
                        });
                    })
                }
            }
        } else if (this.action == 'cadastrar') {
            if(this.DEFAULT_VALUES.length) {
                this.DEFAULT_VALUES.forEach((value) => {
                    this.options.forEach(option => {
                        if(option.value == value)
                            opcoesSelecionadas.push(option);
                    });
                });
            }

            const servicos: number[] = JSON.parse(this.state.servicosContratados);

            if(servicos.length) {
                servicos.forEach((servicoId) => {
                    this.options.forEach(option => {
                        if(option.value == servicoId)
                            servicosContratados.push(option.value);
                    });
                })
            }
        } else {
            if(this.DEFAULT_VALUES.length) {
                this.DEFAULT_VALUES.forEach((value) => {
                    this.options.forEach(option => {
                        if(option.value == value)
                            opcoesSelecionadas.push(option);
                    });
                });
            }
            
            opcoesSelecionadas.forEach(opcaoSelecionada => {
                servicosContratados.push(opcaoSelecionada.value);
            });
        }

        return (
            <>
                <Select 
                    options={this.options}
                    defaultValue={opcoesSelecionadas}
                    placeholder='Selecione o serviço contratado'
                    isMulti
                    // @ts-ignore
                    onChange={this.onChange}
                    isDisabled={this.action == 'detalhes' ? true : false}
                />
                {
                    this.action == 'atualizar' ?
                    <>
                        <input type="hidden" name="servicos-contratados" value={JSON.stringify(refreshed ? servicosContratados : this.DEFAULT_VALUES)} />
                        <input type="hidden" name="old-servicos-contratados" value={JSON.stringify(this.DEFAULT_VALUES)} />
                    </>
                    : this.action == 'cadastrar' ?
                    <>
                        <input type="hidden" name="servicos-contratados" value={JSON.stringify(refreshed ? servicosContratados : this.DEFAULT_VALUES)} />
                    </> : <></> 
                }
            </>
        );
    }

}

export default ServicosContratados;