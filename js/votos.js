$('.btn-votar').on('click', function() {
    let idProducto = $(this).data('producto');
    let voto = $(this).closest('tr').find('.select-voto').val();
    let fila = $(this).closest('tr');
    
    $.ajax({
        url: 'votos.php',
        type: 'POST',
        data: {
            idProducto: idProducto,
            voto: voto
        },
        success: function(respuesta) {
            if (respuesta.error) {
                alert(respuesta.error);
            } else {
                // Actualizar la media en la tabla sin recargar
                $('#votos_' + idProducto).html(respuesta.estrellas);
                alert(respuesta.mensaje);
            }
        }
    });
});