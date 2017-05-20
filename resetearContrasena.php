<?php

include_once 'php/phpmailer/class.phpmailer.php';
include_once 'php/phpmailer/class.smtp.php';

include_once 'php/funciones.php';
include_once 'php/conexionBD.php';


$action = '';

if (existeGET('action')) {
    $action = obtenerGET('action');
}

switch ($action) {
    case 'resetearContrasena':
        resetearContrasena('zegarr96@gmail.com');
        //registrarse();
        break;
    case 'verificarCuenta':
        verificarCuenta();
        break;
    default:
        paginaDefault();
        break;
}

function resetearContrasena($mailUsuario) {


    //link para que la cuenta que enviara los mails habilite los permisos para que otras aplicaciones accedan a ella
    // https://myaccount.google.com/lesssecureapps
    // mail creado para pruebas:
    //    mailPruebaYED@gmail.com
    //    name: mailPruebaYED
    //    lastname: pruebaYED
    //    pass: mailprueba12345

    $idUsuario = 122;
    $codigo = 'sjhdjakshdjk3jh4kj32dkhd923iodjkws';

    $mail = new PHPMailer();

//Luego tenemos que iniciar la validación por SMTP:
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com"; // SMTP a utilizar. Por ej. smtp.elserver.com

    $mail->Username = "mailPruebaYED@gmail.com"; // Correo completo a utilizar
    $mail->Password = "mailprueba12345"; //contrasena
    $mail->Port = 25; // Puerto a utilizar
//Con estas pocas líneas iniciamos una conexión con el SMTP. Lo que ahora deberíamos hacer, es configurar el mensaje a enviar, el //From, etc.
    $mail->From = "mailPruebaYED@gmail.com"; // Desde donde enviamos (Para mostrar)
    $mail->FromName = "mailPrueba";

//Estas dos líneas, cumplirían la función de encabezado (En mail() usado de esta forma: “From: Nombre <correo@dominio.com>”) de //correo.
    $mail->AddAddress("$mailUsuario"); // Esta es la dirección a donde enviamos
    $mail->IsHTML(true); // El correo se envía como HTML
    $mail->Subject = "Verificacion de Cuenta YED"; // Este es el titulo del email.
    $body = 'Para activar tu cuenta en YED haz click en este <a href="registrarse.php?id=' . $idUsuario . '&code=' . $codigo . '">link !</a>';
    $mail->Body = $body; // Mensaje a enviar
    $exito = $mail->Send(); // Envía el correo.
//También podríamos agregar simples verificaciones para saber si se envió:
    if ($exito) {
        die ('El correo fue enviado correctamente.');
    } else {
        die ('Hubo un inconveniente. Contacta a un administrador.');
    }
}