class MascaraDeEntrada {
    
    public static adicionarMascaraDeEntradaNoCampoTelefone = (): void => {
        const $telefone = $('[name="telefone"]');

        $telefone.on('keyup', (event) => {
            // @ts-ignore
            let { value } = event.target;

            value = value.replace(/\D/g,"");
            value = value.replace(/^(\d{2})(\d)/g,"($1) $2");
            value = value.replace(/(\d)(\d{4})$/,"$1-$2");

            // @ts-ignore
            event.target.value = value;
        });
    }

}

export default MascaraDeEntrada;