<?php
include ("seguridad.php");
require ("funciones.php");
cabeceraAD();
?>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/ayudas.js"></script>

<div id="contenido_admin" style="clear:both;">
<div id="submenu">
<a href="documentos.php">Lista de  documentos</a>
<a href="documentos.php?accion=anadir">Definir nuevo documento</a>
</div>


<?php
if (!isset($_GET['accion']) && !isset($_POST['accion'])){
echo "<p>Para editar hacer click en el TITULO del documento.</p>";
require('config.php');
$buscar="SELECT * FROM documentos ORDER BY categoria_enlace";
$resultados = mysql_query($buscar);

if($resultados){
	echo "<div id='listado_principal'><table width=\"90%\">\n";
	echo "<tr><td width=\"1%\">NRO</td>";
	echo "<td>&nbsp;CATEGORIA DE DOCUMENTO</td>";
	echo "<td>&nbsp;TITULO DE DOCUMENTO</td>";
	echo "<td>&nbsp;DIRECCION DE DOCUMENTO</td>";
	echo "<td>&nbsp;DESCRIPCION DE DOCUMENTO</td>";
	echo "<td>&nbsp;ELIMINAR DOCUMENTO</td>";
	echo "</tr>\n";
	$x = 1;
	while (list($id,$nombre,$direccion,$categoria,$descripcion,$ruta) = mysql_fetch_array($resultados)) {
		echo "<tr><td width=\"1%\">".$x."-</td>";
		echo "<td>&nbsp;".$categoria."</td>";
		echo "<td>&nbsp;<a href=\"documentos.php?accion=editar&id=".$id."\">".$nombre."</a></td>";
		echo "<td>&nbsp;".$direccion."</td>";
		echo "<td>&nbsp;".$descripcion."</td>";
		echo "<td>&nbsp;<a href='#' onclick='javascript:Confirmar($id);'>Eliminar</a></td>";
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
<form action="documentos.php" method="post" enctype="multipart/form-data" name="anadir" onsubmit="javascript:return validar_doc(this);"> 
<input type="hidden" name="accion" value="guardar"><br> 
T&iacute;tulo del documento:<br> 
<input name="enlace" type="text" size="70" maxlength="100">
<br>
Menu principal:<br>
<select name="categoria" id="categoria">
  <option value="">--SELECCIONE--</option>
  <option value="DOCUMENTOS">DOCUMENTOS</option>
  <option value="PUBLICACIONES">PUBLICACIONES</option>
</select>
<br>
 
Ingrese documento:<br>
<input name="direccion" type="file" size="70" maxlength="150" />
<br> 
Escriba la descripción del documento<br>
<textarea name="descripcion" cols="70" rows="10"></textarea>
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
	$enlace=$_POST["enlace"];
	$categoria=$_POST["categoria"];
	$direccion=strtolower($_FILES["direccion"]['name']);
	$descripcion=$_POST["descripcion"];
	if ($_FILES['direccion']['name']."" != ""){
		$ruta_destino = strtolower('../documentos/'.$direccion);
		move_uploaded_file($_FILES['direccion']['tmp_name'], $ruta_destino);
		$query = "INSERT INTO documentos (nombre_enlace,direccion_enlace,categoria_enlace,descripcion_enlace,imagen_enlace) VALUES ('$enlace','$direccion','$categoria','$descripcion','')";
    $result = mysql_query($query);
	echo "<br> Fue guardado el documento <b>".$enlace."</b>";
	}
	else{
		$query = "INSERT INTO documentos (nombre_enlace,direccion_enlace,categoria_enlace,descripcion_enlace,imagen_enlace) VALUES ('$enlace','','$categoria','$descripcion','')";
    $result = mysql_query($query);
	echo "<br> Fue guardado el documento <b>".$enlace."</b>";
	}
	
	mysql_close ();
	exit;
}

if ($_GET['accion']=="editar"){
	require('config.php');
	$id=$_GET["id"];
	$buscar="SELECT * FROM documentos WHERE id_enlace=$id";
	$resultados = mysql_query($buscar);

	if($resultados){
		$vector=mysql_fetch_array($resultados);
		$enlace=$vector['nombre_enlace'];
		$direccion=$vector['direccion_enlace'];
		$categoria=$vector['categoria_enlace'];
		$descripcion=$vector['descripcion_enlace'];
		$ruta=$vector['imagen_enlace'];
	}
	mysql_close ();
?>
	<div style="padding-left:100px;">
	<form action="documentos.php" method="post" enctype="multipart/form-data" name="editar" onsubmit="javascript:return validar_doc(this);"> 
	<input type="hidden" name="accion" value="actualizar"><br> 
	<input type="hidden" name="id" value="<?php echo $id;?>"><br> 
	T&iacute;tulo del documento:<br> 
	<input name="enlace" type="text" value="<?php echo $enlace;?>" size="70" maxlength="150">
	<br> 
Menu principal:<br>
<select name="categoria" id="categoria"">
  <option value="DOCUMENTOS" <?php if($categoria=='DOCUMENTOS') echo selected;?>>DOCUMENTOS</option>
  <option value="PUBLICACIONES" <?php if($categoria=='PUBLICACIONES') echo selected;?>>PUBLICACIONES</option>
</select>
<br>
 
	Documento:(<span class="Estilo1">*</span> deje en blanco para mantener el documento actual)<br> 
	<input name="direccion" type="file" size="70" maxlength="150" />
    <input type="hidden" name="direccion_h" value="<?php echo $direccion;?>"><br> 
	Escriba la descripción del documento<br>
	<textarea name="descripcion" cols="70" rows="10"><?php echo $descripcion;?></textarea>
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
	$enlace=$_POST["enlace"];
	$categoria=$_POST["categoria"];
	$direccion=strtolower($_FILES['direccion']['name']);
	$nombre_archivo=$_POST['direccion_h'];
	$descripcion=$_POST["descripcion"];
	$query = "UPDATE documentos SET nombre_enlace='$enlace' WHERE id_enlace=$id";
    $result = mysql_query($query);
	$query = "UPDATE documentos SET categoria_enlace='$categoria' WHERE id_enlace=$id";
    $result = mysql_query($query);
	if($direccion."" != "")
	{
		if($nombre_archivo.""!=""){
			unlink("../documentos/".$_POST['direccion_h']);
		}
		$ruta_destino_g = '../documentos/'.$direccion;
		move_uploaded_file($_FILES['direccion']['tmp_name'], $ruta_destino_g);
		
		$query = "UPDATE documentos SET direccion_enlace='$direccion' WHERE id_enlace='$id'";
		$result = mysql_query($query);
	}
	
	$query = "UPDATE documentos SET descripcion_enlace='$descripcion' WHERE id_enlace=$id";
    $result = mysql_query($query);
	echo "<br><br>Los datos del documento fueron actualizados";
	 mysql_close ();
	exit;
}
?>
<?php
if ($_GET['accion']=="eliminar"){
	$id=$_GET['id'];
	require('config.php');
	$buscar="SELECT direccion_enlace FROM documentos WHERE id_enlace=$id";
	$resultados = mysql_query($buscar);
	$vector = mysql_fetch_array($resultados);
	if($vector[0].""!="")
		unlink('../documentos/'.$vector[0]);
	$query="DELETE FROM documentos WHERE id_enlace= $id";
	$result = mysql_query($query);
	echo "<br><br> El documento fue eliminado";
	mysql_close ();
	exit;
}
?>
</div>


</body>
</html>