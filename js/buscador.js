window.addEventListener('load', iniciar);

function iniciar() {
    document.getElementById('buscador').addEventListener('keyup', function () {

        let termino = document.getElementById('buscador').value;
   

        if (termino.length < 2) {
            document.getElementById('resultadoBusqueda').innerHTML = '';
            return;
        }

        let xhr = new XMLHttpRequest();
        let url = "https://dummyjson.com/products/search?q=" + termino;

        xhr.open("GET", url, true);
        xhr.addEventListener('readystatechange', function () {
            if (this.readyState === 4 && this.status === 200) {
                let datos = JSON.parse(this.responseText);
                let productos = datos.products;
                
                let categoriasTech = ['smartphones', 'laptops', 'tablets', 'mobile-accessories', 'computer-accessories'];

let productosFiltrados = productos.filter(function(p) {
    return categoriasTech.includes(p.category);
});
                let html = "<div class='row row-cols-1 row-cols-md-3 g-3'>";
                for (let i = 0; i < productosFiltrados.length; i++) {
                    let p = productosFiltrados[i];
                    html += "<div class='col'>";
                    html += "<div class='card h-100 shadow-sm'>";
                    html += "<img src='" + p.thumbnail + "' class='card-img-top' style='height:150px;object-fit:cover'>";
                    html += "<div class='card-body'>";
                    html += "<h6 class='card-title'>" + p.title + "</h6>";
                    html += "<p class='text-success fw-bold'>" + p.price + " €</p>";
                    html += "</div></div></div>";
                }
                html += "</div>";
                document.getElementById('resultadoBusqueda').innerHTML = html;
            }
        });
        xhr.send();
    });
}
