<?php
//iniciamos la sesi?n
session_name("loginUsuario");
session_start();
//antes de hacer los c?lculos, compruebo que el usuario est? logueado
//utilizamos el mismo script que antes
if ($_SESSION["autentificado"] != "SI") {
//si no est? logueado lo env?o a la p?gina de autentificaci?n
header("Location: index.php");
} else {
//sino, calculamos el tiempo transcurrido
$fechaGuardada = $_SESSION["ultimoAcceso"];
$ahora = date("Y-n-j H:i:s");
$tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada));
//comparamos el tiempo transcurrido
if($tiempo_transcurrido >= 600) {
//si pasaron 10 minutos o m?s
session_destroy(); // destruyo la sesi?n
header("Location: index.php"); //env?o al usuario a la pag. de autenticaci?n
//sino, actualizo la fecha de la sesi?n
}else {
$_SESSION["ultimoAcceso"] = $ahora;
}
}
?>