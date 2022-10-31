import $ from 'jquery';
import './bootstrap';
import '@popperjs/core';
import Cliente from './components/cliente';

// @ts-ignore
window.$ = $;

const debug = true;

const { classList } = document.body;

if(classList.contains('cliente')) {
    const bodyId = document.body.getAttribute('id') as 'listar' | 'cadastrar' | 'atualizar' | 'detalhes';
    Cliente.iniciar(bodyId);
}

if(debug) 
    Cliente.debug();