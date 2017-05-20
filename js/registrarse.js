$(document).ready(function () {
    $('#btnRegistrarse').on('click', registrarse);
});

function registrarse() {
    var usuario = $('#usuario');
    var mail = $('#mail');
    var pass = $('#password');
    var nombre = $('#nombre');
    var apellido = $('#apellido');

    var parametros = {
        'usuario' : usuario,
        'mail' : mail,
        'pass' : pass,
        'nombre' : nombre,
        'apellido' : apellido
    }

    $.ajax(
            {
                url: 'registrarse.php?action=registrarse',
                type: 'POST',
                data: parametros,
                datatype: 'text',
                success: function (data) {
                    $('#divAlertas').html(mostrarMensajeOk(text));
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#divAlertas').html(mostrarMensajeError(textStatus));
                }
            });
}

function mostrarMensajeOk(mensaje){
    return 'Ok ' + mensaje;
}
function mostrarMensajeError(mensaje){
    return 'error ' + mensaje;
}