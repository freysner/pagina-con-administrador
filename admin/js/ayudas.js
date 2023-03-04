function Confirmar(num) {
	if(confirm("Se eliminara permanentemente el documento?")) {
		document.location.href= 'documentos.php?accion=eliminar&id='+num;
	} 
} 
function Confirmar2(num) {
	if(confirm("Se eliminara permanentemente?")) {
		document.location.href= 'noticias.php?accion=eliminar&id='+num;
	} 
} 
function Confirmar3(num) {
	if(confirm("Se eliminara permanentemente?")) {
		document.location.href= 'contactos.php?accion=eliminar&id='+num;
	} 
} 
function Confirmar4(num) {
	if(confirm("Se eliminara permanentemente la actividad?")) {
		document.location.href= 'actividades.php?accion=eliminar&id='+num;
	} 
} 
function Confirmar5(nom) {
	if(confirm("Se eliminara permanentemente la imagen? " + nom)) {
		document.location.href= 'imagenes.php?accion=eliminar&nom='+nom;
	} 
}
function Confirmar6(id) {
	if(confirm("Se eliminara permanentemente el afiliado? " + id)) {
		document.location.href= 'afiliados.php?accion=eliminar&id='+id;
	} 
}