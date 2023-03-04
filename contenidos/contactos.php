 <h3>Contactos</h3>
 <table id="contenido">
  <tr>
  <td>
 <?php
include('config.php');
	$buscar="SELECT * FROM contactos";
	$resultados = mysql_query($buscar);
	if($resultados){
		while (list($id,$nombre,$categoria,$web,$logo,$representante,$direccion,$telefono) = mysql_fetch_array($resultados)) {
			?>
            <div class="contacto">
            <?php if($logo.""!="")
             		echo "<img src='$logo' alt='$nombre'/>";
					//echo "$logo";
			?> 
            <span class="nombre_contacto"><?php echo $nombre;?></span><BR />
            <?php echo $representante;?><BR />
            <?php echo $direccion;?><BR />
            <?php echo $telefono;?><BR />
            <a href="http://<?php echo $web;?>"><?php echo $web;?></a><br />
            </div>
            <?PHP
		}
	 }
	mysql_close ();
?>
</td>
  </tr>
  </table>
