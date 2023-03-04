<?php
require ("seguridad.php");
require ("funciones.php");
cabeceraAD();
?>
<script type="text/javascript" src="js/ayudas.js"></script>

<?php 
 if ($_POST['accion']=="guardar"){ 
 require('config.php');
   	$nombre_archivo=$_FILES['ruta']['name'];
	$id=$_POST['id'];
	if ($nombre_archivo."" != ""){
		$ruta_imagen = strtolower('img/'.$nombre_archivo);
		move_uploaded_file($_FILES['ruta']['tmp_name'], '../'.$ruta_imagen);
		$query = "INSERT INTO imagen (id_actividad,ruta_imagen) VALUES ($id,'$ruta_imagen')";
    	$result = mysql_query($query);
	}
	mysql_close ();
	echo "La imagen $nombre_archivo fue guardado";
	/*$ruta_destino="../".$ruta_imagen;
	$ruta=$ruta_destino;
	$fuente = @imagecreatefromjpeg ($ruta) ; 
	$imgAncho = imagesx ( $fuente ) ; 
	$imgAlto =imagesy ( $fuente ) ; 
	$imagen_p = ImageCreate ( 160 , 150 ) ; 
	$ancho=160;
	$alto=150;
	ImageCopyResized ( $imagen_p ,$fuente , 0 , 0 , 0 , 0 , $ancho , $alto , $imgAncho , $imgAlto ) ; */
	//Header( "Content-type: image/jpeg");
	//imageJpeg($imagen_p,$ruta_destino); 
}
?>
<?php
if ($_GET['accion']=="eliminar"){
	$nom=$_GET['nom'];
	require('config.php');
	if($nom.""!="")
		unlink('../'.$nom);
	$query="DELETE FROM imagen WHERE ruta_imagen='$nom'";
	$result = mysql_query($query);
	mysql_close ();
	echo "La imagen $nom fue eliminado";
}
?>

<?php

require('config.php');
$id=$_GET['id'];
$buscar="SELECT ruta_imagen FROM imagen WHERE $id=id_actividad";
//echo $buscar;
$resultados = mysql_query($buscar);
if($resultados){
	echo "<div id='listado_principal'><table width=\"90%\">\n";
	echo "<tr><td width=\"1%\">NRO</td>";
	echo "<td>&nbsp;IMAGEN</td>";
	echo "<td>&nbsp;ELIMINAR ACTIVIDAD</td>";
	echo "</tr>\n";
	$x = 1;
	while (list($ruta) = mysql_fetch_array($resultados)) {
		echo "<tr><td width=\"1%\">".$x."-</td>";
		echo "<td>&nbsp;<img src=\"../$ruta\"  alt=\"$nombre\"><br></td>";
		echo "<td>&nbsp;<a href='#' onclick=\"Confirmar5('".$ruta."');\">Eliminar</a></td>";
		echo "</tr>\n";
		$x++;
	}
	echo "</table></div>\n";
?>
<form action="imagenes.php" method="post" name="anadir" ENCTYPE="multipart/form-data"> 
 <input type="hidden" name="accion" value="guardar"><br> 
 <input type="hidden" name="id" value="<?php echo $id; ?>"><br> 
Imagen de tamaño <em>160 x 150 pixeles</em><br> 
	<input type="file" name="ruta" size="55" value=""><br/>
<input type="submit" value="Guardar"><br> 
</form>
<?php
}

mysql_close();
?>

