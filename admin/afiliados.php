<?php
include ("seguridad.php");
require ("funciones.php");
cabeceraAD();
?>
<script type="text/javascript" src="js/ayudas.js"></script>
<div id="contenido_admin" style="clear:both;">
<div id="submenu">
<a href="afiliados.php">Lista de  afiliados</a>
<a href="afiliados.php?accion=anadir">Definir nuevo afiliado</a>
</div>
<?php
if (!isset($_GET['accion']) && !isset($_POST['accion'])){
echo "<p>Para editar o eliminar hacer click en la etiqueta de la descarga.</p>";
require('config.php');
$buscar="SELECT * FROM afiliados ORDER BY id";
$resultados = mysql_query($buscar);
if($resultados){
	echo "<div id='listado_principal'><table width=\"90%\">\n";
	echo "<tr><td width=\"1%\">NRO</td>";
	echo "<td>&nbsp;BANDERA DE AFILIADO</td>";
	echo "<td>&nbsp;LUGAR DE AFILIADO</td>";
	echo "<td>&nbsp;EJECUTIVO DE AFILIADO</td>";
	echo "<td>&nbsp;DIRECCION DE AFILIADO</td>";
        echo "<td>&nbsp;ELIMINAR AFILIADO</td>";
	echo "</tr>\n";
	$x = 1;
	while (list($id,$lugar,$ejecutivo,$direccion,$bandera) = mysql_fetch_array($resultados)) {
		echo "<tr><td width=\"1%\">".$x."-</td>";
		echo "<td>&nbsp;";
		if($bandera.""!="")
			echo "<img src='../".$bandera."' width='100' heigth='100'>";
		echo "</td>";
		echo "<td>&nbsp;<a href=\"afiliados.php?accion=editar&id=".$id."\">".$lugar."</a></td>";
		echo "<td>&nbsp;".$ejecutivo."</td>";
		echo "<td>&nbsp;".$direccion."</td>";
		echo "<td>&nbsp;<a href='#' onclick='Confirmar6($id);'>Eliminar</a></td>";
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
<form action="afiliados.php" method="post" enctype="multipart/form-data" name="anadir" onsubmit="javascript:return validar_cont(this);"> 
<input type="hidden" name="accion" value="guardar"><br> 
Lugar del afiliado:<br> 
<input name="lugar" type="text" size="50" maxlength="100">
<br>
Ejecutivo del afiliado:<br>
<input name="ejecutivo" type="text" size="50" maxlength="50" />
<br>
Direccion:<br>
<input name="direccion" type="text" size="50" maxlength="50" />
<br>
Ruta de la imagen:<br/>
<input type="FILE" name="bandera" size="55"><br>
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
	$lugar=$_POST["lugar"];
	$ejecutivo=$_POST["ejecutivo"];
	$direccion=$_POST["direccion"];
	$lugar_archivo=$_FILES['bandera']['name'];
	if ($lugar_archivo."" != ""){
		$bandera_imagen = strtolower('img/bnd/'.$lugar_archivo);
		move_uploaded_file($_FILES['bandera']['tmp_name'], '../'.$bandera_imagen);
		$query = "INSERT INTO afiliados (lugar,ejecutivo,direccion,bandera)";
		$query = $query." VALUES ('$lugar','$ejecutivo', '$direccion','$bandera_imagen')";
		$result = mysql_query($query);
		echo " Fue guardado el afiliado <b>".$lugar."</b>";
	}
	mysql_close ();
	exit;
}

if ($_GET['accion']=="editar"){
	require('config.php');
	$id=$_GET["id"];
	$buscar="SELECT * FROM afiliados WHERE id=$id";
	$resultados = mysql_query($buscar);
        if($resultados){
		$vector=mysql_fetch_array($resultados);
		$lugar=$vector['lugar'];
		$ejecutivo=$vector['ejecutivo'];
		$direccion=$vector['direccion'];
		$bandera=$vector['bandera'];
	}
	mysql_close ();
?>
	<div style="padding-left:100px;">
	<form action="afiliados.php" method="post" enctype="multipart/form-data" name="editar" onsubmit="javascript:return validar_cont(this);"> 
	<input type="hidden" name="accion" value="actualizar"><br> 
	<input type="hidden" name="id" value="<?php echo $id;?>"><br> 
	Lugar del afiliado:<br> 
	<input name="lugar" type="text" value="<?php echo $lugar;?>" size="50" maxlength="100">
	<br> 
	Ejecutivo del afiliado:<br>
	<input name="ejecutivo" type="text" value="<?php echo $ejecutivo;?>" size="50" maxlength="50" />
	<br>
        Direccion:<br>
        <input name="direccion" type="text" value="<?php echo $direccion;?>" size="50" maxlength="50" />
        <br>
        <img src="<?php echo $bandera;?>" alt="<?php echo $lugar;?>"><br>
        Ruta de la bandera:<br/>
        <input type="FILE" name="bandera" size="55"><br>
        <input type="hidden" name="IMAGEN_D" value='<?php echo $bandera;?>'>
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
	$lugar=$_POST["lugar"];
        $ejecutivo=$_POST["ejecutivo"];
	$direccion=$_POST["direccion"];
	$lugar_archivo=$_FILES['bandera']['name'];
	$query = "UPDATE afiliados SET lugar='$lugar' WHERE id=$id";
        $result = mysql_query($query);
        $query = "UPDATE afiliados SET ejecutivo='$ejecutivo' WHERE id=$id";
        $result = mysql_query($query);
	$query = "UPDATE afiliados SET direccion='$direccion' WHERE id=$id";
        $result = mysql_query($query);
	if($lugar_archivo."" != "")
	{
		$bandera_destino_g = strtolower('../img/bnd/'.$lugar_archivo);
		$bandera_destino_bd = strtolower('img/bnd/'.$lugar_archivo);
		move_uploaded_file($_FILES['bandera']['tmp_name'], $bandera_destino_g);
		if($_POST['IMAGEN_D'].""!=""){
			unlink("../".$_POST['IMAGEN_D']);
		}
		$query = "UPDATE afiliados SET bandera='$bandera_destino_bd' WHERE id=$id";
		$result = mysql_query($query);
	}
	echo "<br>Los datos de su afiliado fueron actualizados";
	 mysql_close ();
	exit;
}
?>
<?php
if ($_GET['accion']=="eliminar"){
	$id=$_GET['id'];
	require('config.php');
	$buscar="SELECT bandera FROM afiliados WHERE id=$id";
	$resultados = mysql_query($buscar);
	$vector = mysql_fetch_array($resultados);
	if($vector[0].""!="")
		unlink('../'.$vector[0]);
	$query="DELETE FROM afiliados WHERE id= $id";
	$result = mysql_query($query);
	echo "<br><br>El afiliado fue eliminado";
	mysql_close ();
	exit;
}
?>
</div>
</body>
</html>