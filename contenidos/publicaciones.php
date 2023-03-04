<h3>Publicaciones</h3>
 <table id="contenido">
  <tr>
  <td>
 <?php
 require('config.php');
	$buscar="SELECT * FROM documentos WHERE categoria_enlace='PUBLICACIONES'";
	$resultados = mysql_query($buscar);
	if($resultados){
		while (list($id,$nombre,$direccion,$categoria,$descripcion,$ruta,$num) = mysql_fetch_array($resultados)) {
			echo "<table class='listado_pdf'>\n";
			echo "<tr><td ALIGN='LEFT'><b><span style='color:#af302a;'>TITULO: </span></b>";
			echo "$nombre<br/>";
			echo"<span style='color:#af302a;'><B>DESCRIPCION: </B></span> $descripcion</td>";
			echo "<td align='right'>";
			if($direccion.""!=""){
				echo "<a href='documentos/$direccion' alt='$nombre'>";
				echo "<img src='img/logo_pdf.jpg' style='border:0px'/></a>";
			}
			echo "</td>";
			echo "</tr>";
			echo "</table>";
			echo "<hr style='color:red;width:400px;'>";
		}
	 }
	mysql_close ();
?>
</td>
  </tr>
  </table>
