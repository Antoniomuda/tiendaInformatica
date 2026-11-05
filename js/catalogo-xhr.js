window.addEventListener('load', iniciar);

function iniciar (){
    
    let botonBuscar = document.getElementById('buscarProducto');
    botonBuscar.addEventListener('click', funcionAjax);
 
    
    
    let params = new URLSearchParams(window.location.search);
    let categoria = params.get('categoria');
    
    
    if (categoria){
        document.getElementById('categoria').value = categoria;
        funcionAjax();
    }
    /*let botonLimpiar = document.getElementById('limpiar');
    botonLimpiar.addEventListener('click', funcionLimpiar);*/
    
    console.log(categoria);
    
}
function funcionAjax(){
    
    let categoria = document.getElementById('categoria').value;
    let ordenar = document.getElementById('ordenar').value;
    let orden = document.getElementById('orden').value;
    let limite = document.getElementById('limite').value;

    
    if (limite && isNaN(limite)){
        document.getElementById('resultado').innerHTML =
                "<div class='alert alert-danger'> La cantidad deber se un número</div>";
        return;
    }
    /*if (limite<1 || limite>50){
          document.getElementById('resultado').innerHTML =
                "<div class='alert alert-danger'> La cantidad debe estar entre 1 . y 50</div>";
        return;
    }*/
    
    let xhr = new XMLHttpRequest();
    let url = "https://dummyjson.com/products";
    
    /*if (!categoria){
        document.getElementById('resultado').innerHTML = 
                "<div class='alert alert-warning'>Por favor selecciona una categoria</div>";
        return;
    }*/
   if (!categoria) {
    document.getElementById('resultado').innerHTML = 
        "<div class='alert alert-warning'>Por favor selecciona una categoría</div>";
    return;
}
    
    if (categoria) {
        url+="/category/" + categoria;
    }
    url+="?";
    
    if(ordenar){
        url+="sortBy=" + ordenar + "&order=" + orden+ "&";
    }
    if (limite){
        url+="limit="+ limite;
    }
   
     console.log(url);
    xhr.open("GET", url, true);
    xhr.addEventListener('readystatechange', mostrarDatos);
    xhr.send();
}

function mostrarDatos(){
    
    if (this.readyState === 4 && this.status === 200){
        let datos = this.responseText;
        let datosParseados = JSON.parse(datos);
        
        let productos = datosParseados.products;
        console.log(datosParseados.products);
        
        let html = "<div class='row row--cols-1 row-cols-md-3 g-4'>";
        


for (let i = 0; i < productos.length; i++) {
    let p = productos[i];
   html += "<div class='col'>";
    html += "<div class='card h-100 shadow-sm'>";
    html += "<img src='" + p.thumbnail + "' class='card-img-top' style='height:180px; object-fit:cover'>";
    html += "<div class='card-body'>";
    html += "<h6 class='card-title'>" + p.title + "</h6>";
    html += "<p class='text-success fw-bold'>" + p.price + " €</p>";
    html += "<p class='text-warning'>⭐ " + p.rating + " / 5</p>";
    html += "<p class='card-text text-muted small'>" + p.description + "</p>";
    html += "</div></div></div>";
}

  html+= "</div>";
  document.getElementById('resultado').innerHTML= html;

    }
}