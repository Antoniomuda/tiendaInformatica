$(document).ready(function () {
    $('#login').submit(function (e) {
        e.preventDefault();


        e.stopImmediatePropagation();

        let usuario = $('#usuario').val().trim();
        let pass = $('#pass').val().trim();
        let valido = true;

        // Limpiar errores previos
        $('#errorUsuario').addClass('d-none').text('');
        $('#errorPass').addClass('d-none').text('');
        $('#mensaje').addClass('d-none');

        // Validar campos
        if (usuario === '') {
            $('#errorUsuario').removeClass('d-none').text('El nombre de usuario es obligatorio.');
            valido = false;
        }
        if (pass === '') {
            $('#errorPass').removeClass('d-none').text('La contraseña es obligatoria.');
            valido = false;
        }

        if (!valido)
            return;

        $.ajax({
            type: 'POST',
            url: 'login.php',
            data: $(this).serialize() + '&aceptar=1',
            dataType: 'json',
            success: function (response) {
                if (response.login) {
                    window.location.href = 'productos.php';
                } else {
                    if (response.errores && response.errores.usuario) {
                        $('#errorUsuario').removeClass('d-none').text(response.errores.usuario);
                    }
                    if (response.errores && response.errores.pass) {
                        $('#errorPass').removeClass('d-none').text(response.errores.pass);
                    }
                    if (!response.errores || Object.keys(response.errores).length === 0) {
                        $('#mensaje').removeClass('d-none');
                    }
                }
            },
            error: function (xhr) {
                alert('Error: ' + xhr.status);
            }
        });
    });
});