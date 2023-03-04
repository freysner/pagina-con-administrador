<?php
include ("seguridad.php");
require ("funciones.php");
cabeceraAD();
?>
<div id="contenido_admin" style="clear:both;">
<div id="submenu">
<a href="usuario.php">Usuarios activos</a>
<a href="usuario.php?accion=anadir">Crear usuario</a>
</div>
<?php
if (!isset($_GET['accion']) && !isset($_POST['accion'])){
require('config.php');
$buscar="SELECT * FROM usuario WHERE estado_usuario=1";
$resultados = mysql_query($buscar);
echo "<p>Lista de usuarios nuevos</p>";
if($resultados){
echo "<div style='text-align:center;'><table width=\"90%\">\n";
echo "<tr><td width=\"1%\">NRO</td>";
		echo "<td>&nbsp;CORREO DE USUARIO</td>";
		echo "<td>&nbsp;FECHA DE ALTA</td>";
		echo "<td>&nbsp;ELIMINAR AL USUARIO</td>";
		echo "</tr>\n";
	$x = 1;
	while (list($id,$correo,$clave,$fecha,$tipo,$estado) = mysql_fetch_array($resultados)) {
		echo "<tr><td width=\"1%\">".$x."-</td>";
		echo "<td>&nbsp;".$correo."</td>";
		echo "<td>&nbsp;".$fecha."</td>";
		echo "<td>&nbsp;<a href=\"usuario.php?accion=eliminar&id=".$id."\">Dar de baja</a></td>";
		echo "</tr>\n";
		$x++;
	}
	echo "</table></div>\n";
 }
mysql_close ();
}
?>
<?php
if ($_GET['accion']=="eliminar"){
	$id=$_GET['id'];
	require('config.php');
	$query="DELETE FROM usuario WHERE id_usuario= $id";
	$result = mysql_query($query);
	echo "El dato fue eliminado";
	mysql_close ();
	exit;
}
?>
<?php
if ($_GET['accion']=="enviar"){
	$Email=$_GET['correo'];
	require('config.php');
	$buscar="SELECT * FROM boletin WHERE id_boletin=1";
	$resultados = mysql_query($buscar);
	$vector = mysql_fetch_array($resultados);
	//mando el correo... 
	$Email_admin="contactos@hatemel.com";
	$cabecera = "From: $Email_admin\r\n" . "Reply-To: $Email_admin\r\n" . "Return-path: $Email_admin\r\n" . "MIME-Version: 1.0\n" . "Content-type: text/plain; charset=iso-8859-1"; 
	mail($Email,$vector['asunto'],$vector['mensaje'],$cabecera); 
	echo "<p>Se ha enviado correctamente.</p>";
	$query = "UPDATE usuario SET tipo_usuario=1 WHERE correo='$Email'";
    $result = mysql_query($query);
	mysql_close ();
	exit;
}
?>
<?php
if ($_GET['accion']=="activar"){
	$Email=$_GET['correo'];
	require('config.php');
	$query = "UPDATE usuario SET estado_usuario=1 WHERE correo='$Email'";
    $result = mysql_query($query);
	echo "<p>Se ha activado al usuario correctamente.</p>";
	mysql_close ();
	exit;
}
?>

<?php
if ($_GET['accion']=="anadir"){
?>
<br><br>
<div style="padding-left:100px;">
<form action="usuario.php" method="post">
<input type="hidden" name="accion" value="guardar">
Correo de usuario
:<br> 
<input name="correo" type="text" size="50">
<br> 
Tipo de usuario:<br> 
<select name="tipo">
  <option value="1">Invitado</option>
  <option value="2">Operador</option>
</select><br> 
Contrase&ntilde;a:<br> 
<input type="password" name="clave"><br>
<br> 
<input type="submit" value="Publicar"><br> 
</form> 
</div>
<?php
exit;
}
if ($_POST['accion']=="guardar"){
	//establecemos conexion a la bd
	require('config.php');
	//recibimos las variables enviadas por el formulario 
	$correo=$_POST['correo']; 
	$clave=$_POST['clave']; 
	$tipo=$_POST['tipo']; 
	$sql="insert into usuario(correo,clave,fecha_alta,tipo_usuario,estado_usuario) values 	('$correo','$clave',NOW(),$tipo,1)";
	//echo $sql;
	$result = mysql_query($sql);
	mysql_close ();
	echo "El usuario fue registrado";
	exit;
}

if ($_GET['accion']=="editar"){
	require('config.php');
	$id=$_GET["id"];
	$buscar="SELECT * FROM usuario WHERE id_usuario=$id";
	$resultados = mysql_query($buscar);
	if($resultados){
		$vector=mysql_fetch_array($resultados);
		$id=$vector['id_usuario'];
		$correo=$vector['correo'];
		$clave=$vector['clave'];
		$tipo=$vector['tipo_usuario'];	
	}
	//echo "hii ".$tipo;
	mysql_close ();
?>
	<div style="padding-left:100px;">
	<form action="usuario.php" method="get" name="editar"> 
	<input type="hidden" name="accion" value="actualizar"><br> 
	<input type="hidden" name="id" value="<?php echo $id;?>"><br> 
	Correo del usuario:<br>
	<input name="correo" type="text" value="<?php echo $correo;?>" size="50" />
	<br>
    Tipo:<br> 
	<select name="tipo">
  <option value="1" <?php if($tipo==1) echo selected;?>>Invitado</option>
  <option value="2" <?php if($tipo==2) echo selected;?>>Operador</option>
  <option value="3" <?php if($tipo==3) echo selected;?>>Administrador</option>
	</select><br> 
	Contrase&ntilde;a:<br> 
	<input type="password" name="clave" value="<?php echo $clave;?>"><br>  
	<input type="submit" value="Actualizar"><br> 
	</form> 
	</div>
<?php
	exit;
}
?>
<?php
if ($_GET['accion']=="actualizar"){
	require('config.php');
	$id=$_GET["id"];
	$correo=$_GET["correo"];
	$clave=$_GET["clave"];
	$tipo=$_GET["tipo"];
	$query = "UPDATE usuario SET correo='$correo' WHERE id_usuario=$id";
    $result = mysql_query($query);
	$query = "UPDATE usuario SET clave='$clave' WHERE id_usuario=$id";
    $result = mysql_query($query);
	$query = "UPDATE usuario SET tipo_usuario='$tipo' WHERE id_usuario=$id";
    $result = mysql_query($query);
	mysql_close ();
	echo "El usuario fue actualizado";
	exit;
}
?>

</div>
</body>
</html>