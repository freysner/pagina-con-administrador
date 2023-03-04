<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$nombre_basedatos= "constructores";
$con_db = mysql_connect($servidor, $usuario, $clave)or die("<span style='color:#FF0000;font-weight:bold;'>Ocurrio un error al conectarse al servidor de base de datos, verifica los datos de configuracion en el archivo config.php </span>");
mysql_select_db($nombre_basedatos,$con_db) or die("<span style='color:#FF0000;font-weight:bold;'>Ocurrio un error al seleccionar la  base de datos</span>");
?>
