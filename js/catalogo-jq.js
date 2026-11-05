$(document).ready(function() {
    $('#buscarProducto').on('click', funcionAjax);
    
   
    let params = new URLSearchParams(window.location.search);
    let categoria = params.get('categoria');
    if (categoria) {
        $('#categoria').val(categoria);
        funcionAjax();
    }
});

function funcionAjax() {
    let categoria = $('#categoria').val();
    let ordenar = $('#ordenar').val();
    let orden = $('#orden').val();
    let limite = $('#limite').val();

    if (!categoria) {
        $('#resultado').html("<div class='alert alert-warning'>Por favor selecciona una categoría</div>");
        return;
    }

    if (limite && isNaN(limite)) {
        $('#resultado').html("<div class='alert alert-danger'>La cantidad debe ser un número</div>");
        return;
    }

    if (limite && (limite < 1 || limite > 50)) {
        $('#resultado').html("<div class='alert alert-danger'>La cantidad debe ser entre 1 y 50</div>");
        return;
    }

    let url = "https://dummyjson.com/products/category/" + categoria;
    url += "?";
    if (ordenar) url += "sortBy=" + ordenar + "&order=" + orden + "&";
    if (limite) url += "limit=" + limite;

    $.ajax({
        url: url,
        type: "GET",
        dataType: "json",
        success: function(datos) {
            mostrarDatos(datos.products);
        },
        error: function() {
            $('#resultado').html("<div class='alert alert-danger'>Error en la petición</div>");
        }
    });
}

function mostrarDatos(productos) {
    $('#resultado').empty();

    if (!productos || productos.length === 0) {
        $('#resultado').html("<div class='alert alert-warning'>No se encontraron productos</div>");
        return;
    }

    let html = "<div class='row row-cols-1 row-cols-md-3 g-4'>";
    productos.forEach(function(p) {
        html += "<div class='col'>";
        html += "<div class='card h-100 shadow-sm'>";
        html += "<img src='" + p.thumbnail + "' class='card-img-top' style='height:180px;object-fit:cover'>";
        html += "<div class='card-body'>";
        html += "<h6 class='card-title'>" + p.title + "</h6>";
        html += "<p class='text-success fw-bold'>" + p.price + " €</p>";
        html += "<p class='text-warning'>⭐ " + p.rating + " / 5</p>";
        html += "<p class='card-text text-muted small'>" + p.description + "</p>";
        html += "</div></div></div>";
    });
    html += "</div>";
    $('#resultado').html(html);
}