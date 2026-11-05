window.addEventListener('load', iniciar);

function iniciar() {
    document.getElementById('buscarPorId').addEventListener('click', funcionAjax);
    document.getElementById('limpiar').addEventListener('click', funcionLimpiar);
    
}

function funcionAjax() {
    

    let cantidad = document.getElementById('cantidadResultados').value;
    let genero = document.getElementById('genero').value;
    let nacionalidad = document.getElementById(('nacionalidad')).value;
    
    
    // Validaciones
    if (!cantidad) {
        document.getElementById('resultado').innerHTML = 
            "<div class='alert alert-warning'>Por favor introduce una cantidad</div>";
        return;
    }
    
    if (cantidad < 1 || cantidad > 20) {
        document.getElementById('resultado').innerHTML = 
            "<div class='alert alert-danger'>La cantidad debe ser entre 1 y 20</div>";
        return;
    }
    let url = "https://randomuser.me/api/?format=xml&nat=es";
    if (genero) url += "&gender=" + genero;
    if (cantidad) url += "&results=" + cantidad;
    if (nacionalidad) url += "&nat=" + nacionalidad;
    else url += "&results=5";
    
    let xhr = new XMLHttpRequest();
    
    xhr.open("GET", url, true);
    xhr.addEventListener('readystatechange', mostrarDatos);
    xhr.send();
}

function mostrarDatos() {
    
    document.getElementById('resultado').innerHTML = '';
    
    if (this.readyState === 4 && this.status === 200){
    let datos = this.responseXML;
    
    
    // Cogemos todos los <results> y filtramos solo los que tienen <gender>
    
    let todosResults = datos.getElementsByTagName('results');
    let usuarios = [];
    for (let i = 0; i < todosResults.length; i++) {
        if (todosResults[i].getElementsByTagName('gender').length > 0) {
            usuarios.push(todosResults[i]);
        }
    }
    
    console.log("Usuarios válidos:", usuarios.length);

    let tabla = document.createElement('table');
    tabla.className = 'table table-striped table-bordered mt-3';

    let cabecera = document.createElement('thead');
    cabecera.className = 'table-dark';
    let lineaCabecera = document.createElement('tr');
    let literalesCabecera = ['NOMBRE', 'APELLIDOS', 'EMAIL', 'TELÉFONO', 'CIUDAD', 'GÉNERO'];
    for (let i = 0; i < literalesCabecera.length; i++) {
        let th = document.createElement('th');
        th.appendChild(document.createTextNode(literalesCabecera[i]));
        lineaCabecera.appendChild(th);
    }
    cabecera.appendChild(lineaCabecera);
    tabla.appendChild(cabecera);

    let body = document.createElement('tbody');
    for (let j = 0; j < usuarios.length; j++) {
        let usuario = usuarios[j];
        
        let nombre   = usuario.getElementsByTagName('first')[0].textContent;
        let apellidos = usuario.getElementsByTagName('last')[0].textContent;
        let email    = usuario.getElementsByTagName('email')[0].textContent;
        let telefono = usuario.getElementsByTagName('phone')[0].textContent;
        let ciudad   = usuario.getElementsByTagName('city')[0].textContent;
        let genero   = usuario.getElementsByTagName('gender')[0].textContent;

        let valores = [nombre, apellidos, email, telefono, ciudad, genero];
        let filaContenido = document.createElement('tr');
        for (let h = 0; h < valores.length; h++) {
            let td = document.createElement('td');
            td.appendChild(document.createTextNode(valores[h]));
            filaContenido.appendChild(td);
        }
        body.appendChild(filaContenido);
    }
    tabla.appendChild(body);
    document.getElementById('resultado').appendChild(tabla);
}
}

function funcionLimpiar() {
    document.getElementById('cantidadResultados').value = "";
    document.getElementById('genero').value = "";
    document.getElementById('resultado').innerHTML = "";
}