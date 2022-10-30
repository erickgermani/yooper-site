import './bootstrap';
import Cliente from './components/cliente';

const debug = true;

const { classList } = document.body;

if(classList.contains('cliente')) {
    Cliente.iniciar();
}

if(debug) {
    Cliente.debug();
}