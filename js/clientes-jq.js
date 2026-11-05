

$(document).ready(function() {

    $('#buscarPorId').on('click', funcionAjax);
    $('#limpiar').on('click', funcionLimpiar);
});

function funcionAjax() {
    let nacionalidad = $('#nacionalidad').val();
    let cantidad = $('#cantidadResultados').val();
    let genero = $('#genero').val();
    
    let url = "https://randomuser.me/api/?format=xml";
    if (genero) url += "&gender=" + genero;
    if (nacionalidad) url += "&nat=" + nacionalidad;
    if (cantidad) url += "&results=" + cantidad;
    else url += "&results=5";
    
    $.ajax({
        url: url,
        type: "GET",
        dataType: "xml",
        success: function(datos) {
            mostrarDatos(datos);
        },
        error: function() {
            $('#resultado').html("<div class='alert alert-danger'>Error en la petición</div>");
        }
    });
}

function mostrarDatos(datos) {
    $('#resultado').empty();
    let usuarios = [];
    $(datos).find('results').each(function() {
        if ($(this).find('gender').length > 0) {
            usuarios.push(this);
        }
    });

    let $tabla = $('<table>').addClass('table table-striped table-bordered mt-3');
    let $cabecera = $('<thead>').addClass('table-dark');
    let $lineaCabecera = $('<tr>');
    let literales = ['NOMBRE', 'APELLIDOS', 'EMAIL', 'TELÉFONO', 'CIUDAD', 'GÉNERO'];
    literales.forEach(function(texto) {
        $lineaCabecera.append($('<th>').text(texto));
    });
    $cabecera.append($lineaCabecera);
    $tabla.append($cabecera);

    let $body = $('<tbody>');
    usuarios.forEach(function(usuario) {
        let $fila = $('<tr>');
        let valores = [
            $(usuario).find('first').text(),
            $(usuario).find('last').text(),
            $(usuario).find('email').text(),
            $(usuario).find('phone').text(),
            $(usuario).find('city').text(),
            $(usuario).find('gender').text()
        ];
        valores.forEach(function(valor) {
            $fila.append($('<td>').text(valor));
        });
        $body.append($fila);
    });

    $tabla.append($body);
    $('#resultado').append($tabla);
}

function funcionLimpiar() {
    $('#cantidadResultados').val('');
    $('#genero').val('');
    $('#resultado').empty();
}