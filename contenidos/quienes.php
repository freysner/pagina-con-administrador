 <?php
 include('config.php');
 $buscar="SELECT * FROM pagina WHERE id_pagina=7";
 $resultados = mysql_query($buscar);
 $vector = mysql_fetch_array($resultados);
//	echo $vector[3];
 ?>
 <table id="contenido">
  <tr>
  <td id="texto">
    <h3><img src="img/icono_titulo.jpg" alt="icono titulo" width="28" height="28" class="icono_titulo" /><?php echo $vector[1];?></h3>
<?php
	echo $vector[3];
?>
</td>
  </tr>
  </table>
