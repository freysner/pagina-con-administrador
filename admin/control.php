<?php
require('config.php');
//vemos si el usuario y contraseña es váildo
$usuario=$_POST["usuario"];
$contrasena=& $_POST["contrasena"];
$ssql = "SELECT tipo_usuario FROM usuario WHERE correo='$usuario' and clave='$contrasena' and tipo_usuario>1";
//Ejecuto la sentencia
$rs = mysql_query($ssql);
//vemos si el usuario y contraseña es váildo
//si la ejecución de la sentencia SQL nos da algún resultado
//es que si que existe esa conbinación usuario/contraseña
//echo"<br>fig ".$rs;
if (mysql_num_rows($rs)==1){
	//usuario y contraseña válidos
	session_name("loginUsuario");
	//asigno un nombre a la sesión para poder guardar diferentes datos
	session_start();
	// inicio la sesión
	$_SESSION["autentificado"]= "SI";
	//defino la sesión que demuestra que el usuario está autorizado
	$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
	//defino la fecha y hora de inicio de sesión en formato aaaa-mm-dd hh:mm:ss
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

