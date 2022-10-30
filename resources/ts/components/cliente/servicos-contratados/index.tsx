import React, { Component } from 'react';
import Select from 'react-select';

interface IOption {
    value: number
    label: string
}

interface IProps {
}

interface IState {
    servicosContratados: string
}

class ServicosContratados extends Component<IProps, IState> {

    private options: IOption[];
    private DEFAULT_VALUES: number[];

    state: IState = {
        servicosContratados: ''
    };

    constructor(props: IProps) {
        super(props);

        // @ts-ignore
        this.options = window.SERVICOS;

        // @ts-ignore
        this.DEFAULT_VALUES = window?.SERVICOS_SELECIONADOS ?? [];
    }

    onChange = (values: IOption[]): void => {
        const servicosContratados = values.map(({ value }) => {
            return value;
        });

        this.setState({ servicosContratados: JSON.stringify(servicosContratados) });
    }

    render() {
        const { servicosContratados } = this.state;

        const opcoesSelecionadas: IOption[] = [];

        if(this.DEFAULT_VALUES.length) {
            this.DEFAULT_VALUES.forEach((value) => {
                this.options.forEach(option => {
                    if(option.value == value)
                        opcoesSelecionadas.push(option);
                });
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
                    isDisabled={true}
                />
                <input type="hidden" name="servicos-contratados" value={servicosContratados} />
            </>
        );
    }

}

export default ServicosContratados;