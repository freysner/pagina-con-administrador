function handleHttpResponseN() { 
    if (http.readyState == 4) { 
       if (http.status == 200) { 
          if (http.responseText.indexOf('invalid') == -1) {
             // Armamos un array, usando la coma para separar elementos
             results = http.responseText.split(","); 
             document.getElementById("subn").innerHTML = results[0];
             enProceso = false;
          }
       }
    }
}
function HTMLNoticias() {
	//alert("hi");
    if (!enProceso && http) {
       var valor = escape(document.getElementById("categorian").value);
	 //alert(valor);
       var url = "bus_categoria.php?nt="+ valor;
       http.open("GET", url, true);
       http.onreadystatechange = handleHttpResponseN;
       enProceso = true;
       http.send(null);
    }
}

function handleHttpResponse() { 
    if (http.readyState == 4) { 
       if (http.status == 200) { 
          if (http.responseText.indexOf('invalid') == -1) {
             // Armamos un array, usando la coma para separar elementos
             results = http.responseText.split(","); 
             document.getElementById("subc").innerHTML = results[0];
             enProceso = false;
          }
       }
    }
}
function HTMLDocumentos() {
	//alert("hi");
    if (!enProceso && http) {
       var valor = escape(document.getElementById("categoria").value);
	 //alert(valor2);
       var url = "bus_categoria.php?ct="+ valor;
       http.open("GET", url, true);
       http.onreadystatechange = handleHttpResponse;
       enProceso = true;
       http.send(null);
    }
}

function getHTTPObject() {
    var xmlhttp;
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
       try {
          xmlhttp = new XMLHttpRequest();
       } catch (e) { xmlhttp = false; }
    }
    return xmlhttp;
}

var enProceso = false; // lo usamos para ver si hay un proceso activo
var http = getHTTPObject(); // Creamos el objeto XMLHttpRequest