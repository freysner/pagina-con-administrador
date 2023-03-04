<?php
include ("seguridad.php");
require ("funciones.php");
cabeceraAD();
?>
<script type="text/javascript" src="js/ayudas.js"></script>
<div id="contenido_admin" style="clear:both;">
<div id="submenu">
<a href="actividades.php">Lista de actividades</a>
<a href="actividades.php?accion=anadir">Definir nueva actividad</a>
</div>


<?php
if (!isset($_GET['accion']) && !isset($_POST['accion'])){
echo "<p>Para editar o eliminar hacer click en el nombre de la actividad.</p>";
require('config.php');
$buscar="SELECT * FROM actividad ORDER BY id_actividad DESC";
$resultados = mysql_query($buscar);

if($resultados){
	echo "<div id='listado_principal'><table width=\"90%\">\n";
	echo "<tr><td width=\"1%\">NRO</td>";
	echo "<td>&nbsp;NOMBRE DE ACTIVIDAD</td>";
	echo "<td>&nbsp;VER</td>";
	echo "<td>&nbsp;ELIMINAR ACTIVIDAD</td>";
	echo "</tr>\n";
	$x = 1;
	while (list($id,$nombre) = mysql_fetch_array($resultados)) {
		echo "<tr><td width=\"1%\">".$x."-</td>";
		echo "<td>&nbsp;<a href=\"actividades.php?accion=editar&id=".$id."\">".$nombre."</a></td>";
		echo "<td>&nbsp;<a href=\"imagenes.php?id=".$id."\">imagenes de actividad</a></td>";
		echo "<td>&nbsp;<a href='#' onclick='Confirmar4($id);'>Eliminar</a></td>";
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
<form action="actividades.php" method="post" name="anadir"> 
<input type="hidden" name="accion" value="guardar"><br> 
Nombre de la actividad:<br>
<input name="nombre2" type="text" size="80" maxlength="150" />
<br> 
Escriba la descripción de la actividad<br> 
<textarea name="descripcion" cols="50" rows="10"></textarea><br> 
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
	$descripcion=$_POST["descripcion"];
	$query = "INSERT INTO actividad (nombre,descripcion) VALUES ('$nombre','$descripcion')";
   	$result = mysql_query($query);
	echo " Fue guardado los datos de la actividad <br/> <b>".$nombre."</b>";
	mysql_close ();
	exit;
}

if ($_GET['accion']=="editar"){
	require('config.php');
	$id=$_GET["id"];
	$buscar="SELECT * FROM actividad WHERE id_actividad=$id";
	$resultados = mysql_query($buscar);
	if($resultados){
		$vector=mysql_fetch_array($resultados);
		$nombre=$vector['nombre'];
		$descripcion=$vector['descripcion'];
	}
	mysql_close ();
?>
	<div style="padding-left:100px;">
	<form action="actividades.php" method="post" name="editar"> 
	<input type="hidden" name="accion" value="actualizar"><br> 
	<input type="hidden" name="id" value="<?php echo $id;?>"><br> 
	Nombre de la actividad:<br> 
	<input name="nombre" type="text" value="<?php echo $nombre;?>" size="80" maxlength="150">
	<br> 
	Escriba la descripción de la actividad<br> 
	<textarea name="descripcion" cols="50" rows="10"><?php echo $descripcion;?></textarea><br> 
   
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
	$descripcion=$_POST["descripcion"];
	$query = "UPDATE actividad SET nombre='$nombre' WHERE id_actividad=$id";
    $result = mysql_query($query);
	$query = "UPDATE actividad SET descripcion='$descripcion' WHERE id_actividad=$id";
    $result = mysql_query($query);
	 mysql_close ();
	 echo " Fue actualizado los datos de la actividad <br/> <b>".$nombre."</b>";
	exit;
}
?>
<?php
if ($_GET['accion']=="eliminar"){
	$id=$_GET['id'];
	require('config.php');
	$buscar="SELECT ruta_imagen FROM portafolio WHERE id_producto=$id";
	$resultados = mysql_query($buscar);
	$vector = mysql_fetch_array($resultados);
	if($vector[0].""!="")
		unlink('../'.$vector[0]);
	$query="DELETE FROM portafolio WHERE id_producto= $id";
	$result = mysql_query($query);
	echo "<br><br>La actividad fue eliminada";
	mysql_close ();
	exit;
}
?>
</div>


</body>
</html>