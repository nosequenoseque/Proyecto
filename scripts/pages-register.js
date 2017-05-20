/**
 * @author Batch Themes Ltd.
 */
(function() {
    'use strict';
    $(function() {
        var config = $.localStorage.get('config');
        $('body').attr('data-layout', 'fullsize-background-image');
        $('body').attr('data-palette', config.theme);
        $('body').attr('data-direction', config.direction);
        var username = $('.create-account-page #username');
        username.floatingLabels({
            errorBlock: 'Ingrese su nombre de usuario.'
        });
        var email = $('.create-account-page #email');
        email.floatingLabels({
            errorBlock: 'Ingrese su email.',
            isEmailValid: 'Email invalido'
        });
        
        var minLength=10;
        
        var password = $('.create-account-page #password');
        password.floatingLabels({
            errorBlock: 'La contraseña debe tener mas de '+ minLength +' caracteres.',
            minLength: minLength
        });
        var confirmPassword = $('.create-account-page #confirm-password');
        confirmPassword.floatingLabels({
            errorBlock: 'Las contraseñas no coinciden.',
            minLength: minLength,
            isFieldEqualTo: $('#password')
        });
    });
})();
