import $ from 'jquery';
import './bootstrap';
import '@popperjs/core';
import Cliente from './components/cliente';

// @ts-ignore
window.$ = $;

const debug = true;

const { classList } = document.body;

if(classList.contains('cliente')) 
    Cliente.iniciar();

if(debug) 
    Cliente.debug();