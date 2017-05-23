<?php

include_once 'php/archivosPhp.php';

$action = '';

if (existeGET('action')) {
    $action = obtenerGET('action');
}
        
switch ($action) {
    case 'login':
        registrarse();
        break;
    default:
        paginaDefault();
        break;
}

function paginaDefault() {
    
    $pagina = new Pagina();
    $pagina->setPagina('login');
    $pagina->agregarJS('js/login.js');
    $pagina->armarPagina();
    $pagina->retornarPagina();
    
}

function login(){
    
}

function noseque(){
    //ncodigo de prueba a ver si la gente puede subir codigo sin permiso
}
