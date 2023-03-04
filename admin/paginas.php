<?php
include ("seguridad.php");
require ("funciones.php");
cabeceraAD();
?>
<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/ayudas.js"></script>
<div id="contenido_admin" style="clear:both;">
<div id="submenu">
<a href="paginas.php">Lista de paginas</a>
<a href="paginas.php?accion=anadir">Crear nueva pagina</a>
</div>
<?php
if (!isset($_GET['accion']) and !isset($_POST['accion'])){
echo "<p>Para editar o eliminar hacer click en el titulo de la pagina.</p>";
require('config.php');
$buscar="SELECT id_pagina,titulo,fecha FROM pagina";
$resultados = mysql_query($buscar);

if($resultados){
echo "<div style='text-align:center;padding-left:10px;'><table width=\"90%\">\n";
echo "<tr><td width=\"1%\">NRO</td>";
		echo "<td>&nbsp;TITULO DE LA PAGINA</td>";
		echo "<td>&nbsp;FECHA</td>";
		echo "<td>&nbsp;ELIMINAR PAGINA</td>";
		echo "</tr>\n";
	$x = 1;
	while (list($id,$titulo,$fecha) = mysql_fetch_array($resultados)) {
		echo "<tr><td width=\"1%\">".$x."-</td>";
		echo "<td>&nbsp;<a href=\"paginas.php?accion=editar&id=".$id."\">".$titulo."</a></td>";
		echo "<td>&nbsp;".$fecha."</td>";
		echo "<td>&nbsp;<a href='#' onclick='Confirmar2($id);'>Eliminar</a></td>";
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
<form action="paginas.php" method="post" ENCTYPE="multipart/form-data">
<input type="hidden" name="accion" value="guardar">
Titulo pagina:<br> 
<input name="titulo" type="text" size="50">
<br>
Escriba el articulo<br> 
<textarea name="articulo" cols="80" rows="20"></textarea><br>
Ruta de la imagen:<br/>
<input type="FILE" name="ruta" size="55"><br>
<input type="submit" value="Publicar"><br> 
</form> 
</div>
<?php
}
if ($_POST['accion']=="guardar"){
	require('config.php');
	$titulo=$_POST['titulo']; 
	$articulo=$_POST['articulo']; 
	$nombre_archivo=$_FILES['ruta']['name'];
	if ($nombre_archivo."" != ""){
		$ruta_imagen = strtolower('img/'.$nombre_archivo);
		move_uploaded_file($_FILES['ruta']['tmp_name'], '../'.$ruta_imagen);
		$sql="insert into pagina (titulo,fecha,texto,imagen)";
		$sql=$sql." values ('$titulo',NOW(),'$articulo','$ruta_imagen')";
    	$result = mysql_query($sql);
		echo " Fue guardado la <b>"."pagina"."</b>";
	}
	else{
		$sql="insert into pagina (titulo,fecha,texto,imagen)";
		$sql=$sql." values ('$titulo',NOW(),'$articulo','')";
    	$result = mysql_query($sql);
		echo " Fue guardado la <b>"."pagina"."</b>";
	}
	mysql_close ();
}

if ($_GET['accion']=="editar"){
	require('config.php');
	$id=$_GET["id"];
	$buscar="SELECT * FROM pagina WHERE id_pagina=$id";
	$resultados = mysql_query($buscar);

	if($resultados){
		$vector=mysql_fetch_array($resultados);
		$titulo=$vector['titulo'];
		$texto=$vector['texto'];
		$resumen=$vector['resumen'];
		$ruta=$vector['imagen'];
		$categoria=$vector['categoria'];
	}
	mysql_close ();
	$cat=explode(" ",$categoria);
?>
	<div style="padding-left:100px;">
	<form action="paginas.php" method="post" name="editar" ENCTYPE="multipart/form-data"> 
	<input type="hidden" name="accion" value="actualizar"><br> 
	<input type="hidden" name="id" value="<?php echo $id;?>"><br> 
	Titulo del art&iacute;culo:<br>
	<input name="titulo" type="text" value="<?php echo $titulo;?>" size="50" />
	<br>
   	  Escriba el texto del boletin<br> 
	<textarea name="texto" cols="80" rows="20"><?php echo $texto;?></textarea><br> 
    <img src="<?php echo $ruta;?>" / alt="<?php echo $titulo;?>"><br>
	Ruta de la imagen:<br> 
	<input type="file" name="ruta" size="55" value="<?php echo $ruta;?>"><br/>
	<br> 
    <input type="hidden" name="IMAGEN_D" value='<?php echo $ruta;?>'>
    <br> 
	<input type="submit" value="Actualizar"><br> 
	</form> 
	</div>
<?php
}
?>
<?php
if ($_POST['accion']=="actualizar"){
	require('config.php');
	$id=$_POST["id"];
	$titulo=$_POST["titulo"];
	$texto=$_POST["texto"];
	$nombre_archivo=$_FILES['ruta']['name'];
	$query = "UPDATE pagina SET titulo='$titulo' WHERE id_pagina=$id";
    $result = mysql_query($query);
	$query = "UPDATE pagina SET texto='$texto' WHERE id_pagina=$id";
    $result = mysql_query($query);
		
	if($nombre_archivo."" != "")
	{
		$ruta_destino_g = strtolower('../img/'.$nombre_archivo);
		$ruta_destino_bd = strtolower('img/'.$nombre_archivo);
		move_uploaded_file($_FILES['ruta']['tmp_name'], $ruta_destino_g);
		if($_POST['IMAGEN_D'].""!=""){
			unlink("../".$_POST['IMAGEN_D']);
		}
		$query = "UPDATE pagina SET imagen='$ruta_destino_bd' WHERE id_pagina=$id";
		$result = mysql_query($query);
	}
	
	mysql_close ();
	echo "<br/>La pagina fue actualizada";
}
?>
<?php
if ($_GET['accion']=="eliminar"){
	$id=$_GET['id'];
	require('config.php');
	$buscar="SELECT imagen FROM pagina WHERE id_pagina=$id";
	$resultados = mysql_query($buscar);
	$vector = mysql_fetch_array($resultados);
	if($vector[0].""!="")
		unlink('../'.$vector[0]);
	$query="DELETE FROM pagina WHERE id_pagina= $id";
	$result = mysql_query($query);
	echo "<br><br> La pagina fue eliminada";
	mysql_close ();
}
?>

</div>

</body>
</html>