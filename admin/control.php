<?php
require('config.php');
//vemos si el usuario y contrase�a es v�ildo
$usuario=$_POST["usuario"];
$contrasena=& $_POST["contrasena"];
$ssql = "SELECT tipo_usuario FROM usuario WHERE correo='$usuario' and clave='$contrasena' and tipo_usuario>1";
//Ejecuto la sentencia
$rs = mysql_query($ssql);
//vemos si el usuario y contrase�a es v�ildo
//si la ejecuci�n de la sentencia SQL nos da alg�n resultado
//es que si que existe esa conbinaci�n usuario/contrase�a
//echo"<br>fig ".$rs;
if (mysql_num_rows($rs)==1){
	//usuario y contrase�a v�lidos
	session_name("loginUsuario");
	//asigno un nombre a la sesi�n para poder guardar diferentes datos
	session_start();
	// inicio la sesi�n
	$_SESSION["autentificado"]= "SI";
	//defino la sesi�n que demuestra que el usuario est� autorizado
	$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
	//defino la fecha y hora de inicio de sesi�n en formato aaaa-mm-dd hh:mm:ss
	$vector=mysql_fetch_array($rs);
	$tipo=$vector[0];
	$_SESSION["nivelAcceso"]=$tipo;
	if($tipo==3)
		header ("Location: usuario.php");
	if($tipo==2)
		header ("Location: documentos.php");
}else {
//si no existe le mando otra vez a la portada
header("Location: index.php?errorusuario=si");
}
mysql_free_result($rs);
mysql_close($conn);
?>

