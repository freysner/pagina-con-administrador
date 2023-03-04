<?php
include ("seguridad.php");
require ("funciones.php");
cabeceraAD();
?>
<script type="text/javascript" src="js/ayudas.js"></script>
<div id="contenido_admin" style="clear:both;">
<div id="submenu">
<a href="contactos.php">Lista de  contactos</a>
<a href="contactos.php?accion=anadir">Definir nuevo contacto</a>
</div>


<?php
if (!isset($_GET['accion']) && !isset($_POST['accion'])){
echo "<p>Para editar o eliminar hacer click en la etiqueta de la descarga.</p>";
require('config.php');
$buscar="SELECT * FROM contactos ORDER BY categoria_contacto";
$resultados = mysql_query($buscar);

if($resultados){
	echo "<div id='listado_principal'><table width=\"90%\">\n";
	echo "<tr><td width=\"1%\">NRO</td>";
	echo "<td>&nbsp;LOGO DE CONTACTO</td>";
	echo "<td>&nbsp;NOMBRE DE CONTACTO</td>";
	echo "<td>&nbsp;WEB DE CONTACTO</td>";
	echo "<td>&nbsp;DIRECCION DE CONTACTO</td>";
	echo "<td>&nbsp;TELEFONO DE CONTACTO</td>";
	echo "<td>&nbsp;ELIMINAR CONTACTO</td>";
	echo "</tr>\n";
	$x = 1;
	while (list($id,$nombre,$categoria,$web,$logo,$rep,$direccion,$telefono) = mysql_fetch_array($resultados)) {
		echo "<tr><td width=\"1%\">".$x."-</td>";
		echo "<td>&nbsp;";
		if($logo.""!="")
			echo "<img src='../".$logo."' width='100' heigth='100'>";
		echo "</td>";
		echo "<td>&nbsp;<a href=\"contactos.php?accion=editar&id=".$id."\">".$nombre."</a></td>";
		echo "<td>&nbsp;".$web."</td>";
		echo "<td>&nbsp;".$direccion."</td>";
		echo "<td>&nbsp;".$telefono."</td>";
		echo "<td>&nbsp;<a href='#' onclick='Confirmar3($id);'>Eliminar</a></td>";
		echo "</tr>\n";
		$x++;
	}
	echo "</table></div>\n";
 }
mysql_close ();
} //cuando no hay parametro accion
?>
<?php
if ($_GET['accion']=="anadir"){
?>
<div style="padding-left:100px;">
<form action="contactos.php" method="post" enctype="multipart/form-data" name="anadir" onsubmit="javascript:return validar_cont(this);"> 
<input type="hidden" name="accion" value="guardar"><br> 
Nombre del contacto:<br> 
<input name="nombre" type="text" size="50" maxlength="100">
<br>

Web del contacto:<br>
<input name="web" type="text" size="50" maxlength="50" />
<br>
Representante:<br>
<input name="representante" type="text" size="50" maxlength="50" />
<br>
Direccion:<br>
<input name="direccion" type="text" size="50" maxlength="50" />
<br>
Telefono:<br>
<input name="telefono" type="text" size="15" maxlength="20" />
<br>
Ruta de la imagen:<br/>
<input type="FILE" name="ruta" size="55"><br>
<br> 
<br> 
<input type="submit" value="Guardar"><br> 
</form> 
</div>
<?php
exit;
}
if ($_POST['accion']=="guardar"){
	require('config.php');
	$nombre=$_POST["nombre"];
	$web=$_POST["web"];
	$representante=$_POST["representante"];
	$direccion=$_POST["direccion"];
	$telefono=$_POST["telefono"];
	$nombre_archivo=$_FILES['ruta']['name'];
	if ($nombre_archivo."" != ""){
		$ruta_imagen = strtolower('img/logos/'.$nombre_archivo);
		move_uploaded_file($_FILES['ruta']['tmp_name'], '../'.$ruta_imagen);
		$query = "INSERT INTO contactos (nombre_contacto,categoria_contacto,web_contacto,logo_contacto,representante_contacto,direccion_contacto,telefono_contacto)";
		$query = $query." VALUES ('$nombre','','$web','$ruta_imagen','$representante', '$direccion','$telefono')";
		$result = mysql_query($query);
		echo " Fue guardado el contacto <b>".$nombre."</b>";
	}
	mysql_close ();
	exit;
}

if ($_GET['accion']=="editar"){
	require('config.php');
	$id=$_GET["id"];
	$buscar="SELECT * FROM contactos WHERE id_contacto=$id";
	$resultados = mysql_query($buscar);

	if($resultados){
		$vector=mysql_fetch_array($resultados);
		$nombre=$vector['nombre_contacto'];
		$web=$vector['web_contacto'];
		$logo=$vector['logo_contacto'];
		$representante=$vector['representante_contacto'];
		$direccion=$vector['direccion_contacto'];
		$telefono=$vector['telefono_contacto'];
	}
	mysql_close ();
?>
	<div style="padding-left:100px;">
	<form action="contactos.php" method="post" enctype="multipart/form-data" name="editar" onsubmit="javascript:return validar_cont(this);"> 
	<input type="hidden" name="accion" value="actualizar"><br> 
	<input type="hidden" name="id" value="<?php echo $id;?>"><br> 
	Nombre del contacto:<br> 
	<input name="nombre" type="text" value="<?php echo $nombre;?>" size="50" maxlength="100">
	<br> 
	Web del contacto:<br>
	<input name="web" type="text" value="<?php echo $web;?>" size="50" maxlength="50" />
	<br>
    Representante:<br>
    <input name="representante" type="text" value="<?php echo $representante;?>" size="50" maxlength="50" />
    <br>
    Direccion:<br>
    <input name="direccion" type="text" value="<?php echo $direccion;?>" size="50" maxlength="50" />
    <br>
    Telefono:<br>
    <input name="telefono" type="text" value="<?php echo $telefono;?>" size="15" maxlength="20" />
    <br>
    <img src="<?php echo $logo;?>" / alt="<?php echo $nombre;?>"><br>
    Ruta de la imagen:<br/>
    <input type="FILE" name="ruta" size="55"><br>
    <input type="hidden" name="IMAGEN_D" value='<?php echo $logo;?>'>
    <br> 
	<br> 
	<input type="submit" value="Actualizar"><br> 
	</form> 
  </div>
<?php
	exit;
}
?>
<?php
if ($_POST['accion']=="actualizar"){
	require('config.php');
	$id=$_POST["id"];
	$nombre=$_POST["nombre"];
	$web=$_POST['web'];
	$representante=$_POST["representante"];
	$direccion=$_POST["direccion"];
	$telefono=$_POST["telefono"];
	$nombre_archivo=$_FILES['ruta']['name'];
	$query = "UPDATE contactos SET nombre_contacto='$nombre' WHERE id_contacto=$id";
    $result = mysql_query($query);
	$query = "UPDATE contactos SET web_contacto='$web' WHERE id_contacto=$id";
    $result = mysql_query($query);
	$query = "UPDATE contactos SET representante_contacto='$representante' WHERE id_contacto=$id";
    $result = mysql_query($query);
	$query = "UPDATE contactos SET direccion_contacto='$direccion' WHERE id_contacto=$id";
    $result = mysql_query($query);
	$query = "UPDATE contactos SET telefono_contacto='$telefono' WHERE id_contacto=$id";
    $result = mysql_query($query);
	if($nombre_archivo."" != "")
	{
		$ruta_destino_g = strtolower('../img/logos/'.$nombre_archivo);
		$ruta_destino_bd = strtolower('img/logos/'.$nombre_archivo);
		move_uploaded_file($_FILES['ruta']['tmp_name'], $ruta_destino_g);
		if($_POST['IMAGEN_D'].""!=""){
			unlink("../".$_POST['IMAGEN_D']);
		}
		$query = "UPDATE contactos SET logo_contacto='$ruta_destino_bd' WHERE id_contacto=$id";
		$result = mysql_query($query);
	}
	echo "<br>Los datos de su contacto fueron actualizados";
	 mysql_close ();
	exit;
}
?>
<?php
if ($_GET['accion']=="eliminar"){
	$id=$_GET['id'];
	require('config.php');
	$buscar="SELECT logo_contacto FROM contactos WHERE id_contacto=$id";
	$resultados = mysql_query($buscar);
	$vector = mysql_fetch_array($resultados);
	if($vector[0].""!="")
		unlink('../'.$vector[0]);
	$query="DELETE FROM contactos WHERE id_contacto= $id";
	$result = mysql_query($query);
	echo "<br><br>El contacto fue eliminado";
	mysql_close ();
	exit;
}
?>
</div>


</body>
</html>