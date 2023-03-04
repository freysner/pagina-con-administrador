<h3>Actividades</h3>
 <table id="contenido">
  <tr>
  <td id="texto">
   <?php
 include('config.php');
 $buscar="SELECT * FROM actividad ORDER BY id_actividad DESC";
 $resultados = mysql_query($buscar);
while (list($id,$nombre,$descripcion) = mysql_fetch_array($resultados)) {
	$sql="SELECT ruta_imagen FROM imagen WHERE $id=id_actividad";
 	$rows = mysql_query($sql);
	echo "<div class=\"actividad\">";
	echo "<h3 style=\"clear:left;\">$nombre</h3><br>";
	while (list($ruta) = mysql_fetch_array($rows)) {
	?>
		<img src="<?php echo $ruta;?>" alt="<?php echo $nombre;?>" />
     <?php
	}
	echo "<p>$descripcion</p>";
	echo "</div><br /><br /><br /><br /><br /><br /> ";
}
?>
</td>
  </tr>
  </table>

