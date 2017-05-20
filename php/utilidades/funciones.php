<?php

function existeGET($atributo) {
    $retorno = false;
    if (isset($_GET[$atributo]) && !empty($_GET[$atributo])) {
        $retorno = true;
    }
    return $retorno;
}

function existePOST($atributo) {
    $retorno = false;
    if (isset($_POST[$atributo]) && !empty($_POST[$atributo])) {
        $retorno = true;
    }
    return $retorno;
}

function obtenerPOST($variable) {
    return trim($_POST[$variable]);
}

function obtenerGET($variable) {
    return trim($_GET[$variable]);
}

function remplazoTagParticular($tag, $texto, $paginaAux) {
    return str_ireplace($tag, $texto, $paginaAux);
}

function buscarHtml($raizHtml, $archivo) {
    return file_get_contents($raizHtml . $archivo);
}


// sessiones
//
//function obtenerUsuario() {
//        $retorno = false;
//        if (verificarSiEstaLogeado()) {
//            $aux = obtenerUsuarioLogeado();
//            if (!empty($aux)) {
//                $this->_usuario = $aux;
//                $retorno = true;
//            }
//        }
//        return $retorno;
//    }
//
//function obtenerUsuarioLogeado() {
//    $retorno = null;
//    if (!empty($_SESSION['usuario_c'])) {
//        $retorno = unserialize($_SESSION['usuario_c']);
//    } else {
//        $_usuario = new Usuario();
//        $id = $_COOKIE['cennave_u'];
//        $codigo = $_COOKIE['cennave_c'];
//        $_usuario->setId($id);
//        if ($_usuario->verificarCargarUsuario($codigo)) {
//            $retorno = $_usuario;
//            $_SESSION['usuario_c'] = serialize($_usuario);
//        }
//    }
//    return $retorno;
//}
//
//function verificarSiEstaLogeado() {
//    if (!isset($_COOKIE['yed_u'])) {
//        return false;
//    } else {
//        return true;
//    }
//}