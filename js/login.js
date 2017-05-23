$(document).ready(function () {
    $('#btnIngresar').on('click', login);
});

function login() {
    var usuario = $('#usuario').val();
    var pass = $('#pass').val();

    var parametros = {
        'usuario': usuario,
        'pass': pass
    }

    $.ajax(
            {
                url: 'login.php?action=login',
                type: 'POST',
                data: parametros,
                datatype: 'text',
                beforeSend: function () {
                    $('#loading').show();
                    $('#divAlertas').hide();
                },
                success: function (text) {
                    $('#divAlertas').show();
                    $('#divAlertas').html(mostrarMensajeOk(text));
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('#divAlertas').show();
                    $('#divAlertas').html(mostrarMensajeError(textStatus));
                },
                complete: function (text) {
                    $('#loading').hide();
                    $('#divAlertas').show();
                }
            });
}

function mostrarMensajeOk(mensaje) {

    return '<div class="alert alert-success animated fadeIn" role="alert">\n\
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> \n\
    <span aria-hidden="true">×</span>  <span class="sr-only">Close</span> \n\
    </button> <strong>Bien!<br></strong>' + mensaje + '</div>';
}
function mostrarMensajeError(mensaje) {
    return '<div class="alert alert-danger" role="alert">\n\
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n\
    <span aria-hidden="true">×</span>  <span class="sr-only">Close</span> </button> \n\
    <strong>Error!<br></strong>' + mensaje + '</div>';
}