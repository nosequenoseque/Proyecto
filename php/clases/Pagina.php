<?php
//include_once '../funciones.php';


class Pagina {

    private $pagina ='';
    private $css ='';
    private $titulo ='';
    private $mailUsuario ='';
    private $nombreUsuario ='';
    private $menu ='';
    private $contenido ='';
    private $js ='';

    function __construct() {
        $this->pagina = buscarHtml('./html/', 'masterPage.html');
    }

    // // <editor-fold desc="Getters y Setters">  

    function getCss() {
        return $this->css;
    }

    function getJs() {
        return $this->js;
    }

    function getMenu() {
        return $this->menu;
    }

    function getContenido() {
        return $this->contenido;
    }

    function getPagina() {
        return $this->pagina;
    }

    function setCss($css) {
        $this->css = $css;
    }

    function setJs($js) {
        $this->js = $js;
    }

    function setMenu($menu) {
        $this->menu = $menu;
    }

    function setContenido($contenido) {
        $this->contenido = $contenido;
    }

    function setPagina($nombrePagina) {
        $this->pagina = buscarHtml('./html/', $nombrePagina.'.html');
    }

    // </editor-fold>
    
    public function agregarJS($js) {
        $newJS = '<script src="'. $js .'" type="text/javascript"></script>';
        $this->js .= $newJS;
    }
    public function agregarCSS($css) {
        $newCSS = '<link rel="stylesheet" href="' .$css. '">';
        $this->css .= $newCSS;
    }
    public function agregarContenido($nombreArchivoContenido) {
        $this->contenido = buscarHtml('./html/', $nombreArchivoContenido.'.html');
    }
    public function agregarTitulo($titulo) {
        $this->titulo .= $titulo;
    }
    public function agregarMailUsuario($mailUsuario) {
        $this->mailUsuario .= $mailUsuario;
    }
    public function agregarNombreUsuario($nombreUsuario) {
        $this->nombreUsuario .= $nombreUsuario;
    }
    /**
     * 
     * @param Usuario $usuario
     */
    public function armarMenu($usuario) {
        $this->mailUsuario .= $mailUsuario;
    }
    
    public function armarPagina() {
        $this->pagina = remplazoTagParticular('<#menu>', $this->menu, $this->pagina);
        $this->pagina = remplazoTagParticular('<#titulo>', $this->titulo, $this->pagina);
        $this->pagina = remplazoTagParticular('<#css>', $this->css, $this->pagina);
        $this->pagina = remplazoTagParticular('<#scripts>', $this->js, $this->pagina);
        $this->pagina = remplazoTagParticular('<#contenido>', $this->contenido, $this->pagina);
    }
    public function retornarPagina() {
        die($this->pagina);
    }
    
    
    
    
}
