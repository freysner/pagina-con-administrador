function validar_doc(form){
	//alert(form.enlace.value);
	if(form.enlace.value==""){
		form.enlace.style.border="1px red solid";
		return(false);
	}
	return (true);	
}// JavaScript Document
function validar_cont(form){
	//alert(form.enlace.value);
	if(form.nombre.value==""){
		form.nombre.style.border="1px red solid";
		return(false);
	}
	if(form.web.value==""){
		form.web.style.border="1px red solid";
		return(false);
	}
	return (true);	
}// JavaScript Document