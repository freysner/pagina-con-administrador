     <style type="text/css">
<!--
.Est1 {
	color: #FFFFFF;
	font-size: 20px;
	padding:5px 15px;
	background-color:#6E1310;
}
.Est2 {
	color: #FFFFFF; 
	background-color:#D40000;
	font-size: 14px;
	text-align:right;
	padding:9px;
}
.Estilo1 {
	color: #FF0000;
	font-size: 12px;
}
-->
  </style> 
  <?php
 $buscar="SELECT * FROM actividad ORDER BY id_actividad DESC";
 $resultados = mysql_query($buscar);
 list($id,$nombre,$descripcion) = mysql_fetch_array($resultados);
	$sql="SELECT ruta_imagen FROM imagen WHERE $id=id_actividad";
 	$rows = mysql_query($sql);
	list($ruta) = mysql_fetch_array($rows);
	?> 
    <div id="cabezera_actividades">
      <span class="Estilo4">ULTIMA ACTIVIDAD</span>
      <p></p><!--img src="genero4.jpg" width="120" height="109"/-->
      <?php
      $sql="SELECT ruta_imagen FROM imagen WHERE $id=id_actividad";
 	$rows = mysql_query($sql);
	list($ruta) = mysql_fetch_array($rows);
		echo "<img src='$ruta' alt='$nombre'  style='width:250px; margin-bottom:10px;'/>";
    ?>
        <p class="Estilo5"><?php echo $nombre; ?></p>
  </div>  
   <?php
   echo $descripcion;
   ?>

<table id="inicio">
  <tr>
    <td>
    <h2 class="Est1">OTRAS ACTIVIDADES</h2>
      <?php
// $buscar="SELECT * FROM actividad ORDER BY id_actividad DESC";
// $resultados = mysql_query($buscar);
 list($id,$nombre,$descripcion) = mysql_fetch_array($resultados);
	$sql="SELECT ruta_imagen FROM imagen WHERE $id=id_actividad";
 	$rows = mysql_query($sql);
	list($ruta) = mysql_fetch_array($rows);
	?> 
     <div class="actividades">
  
        <?php
      $sql="SELECT ruta_imagen FROM imagen WHERE $id=id_actividad";
 	$rows = mysql_query($sql);
	list($ruta) = mysql_fetch_array($rows);
	?>
		<img src="<?php echo $ruta;?>" alt="<?php echo $nombre;?>" />
  
  
     <?php echo $nombre;
	 ?>
     </div>
     <?php
		   echo $descripcion;
   		?>
             <?php
// $buscar="SELECT * FROM actividad ORDER BY id_actividad DESC";
// $resultados = mysql_query($buscar);
 list($id,$nombre,$descripcion) = mysql_fetch_array($resultados);
	$sql="SELECT ruta_imagen FROM imagen WHERE $id=id_actividad";
 	$rows = mysql_query($sql);
	list($ruta) = mysql_fetch_array($rows);
	?> 
    <br />
    <hr />
     <div class="actividades">
     
           <?php
      $sql="SELECT ruta_imagen FROM imagen WHERE $id=id_actividad";
 	$rows = mysql_query($sql);
	list($ruta) = mysql_fetch_array($rows);
	?>
		<img src="<?php echo $ruta;?>" alt="<?php echo $nombre;?>" />
     
     <?php echo $nombre;
	 ?>
     </div>
     <?php
		   echo $descripcion;
   		?>

      <hr />
        <span class="Estilo1">NUMERO DE AFILIADOS POR DEPARTAMENTOS</span>
            <img src="img/cuadro_img.png" style="text-align:left; clear:both; float:none;"/>  </td>
    <td style="width:200px; padding-left:13px;">
      <p class="Est2"> ESTATUTO ORGANICO</p>
      <ul>
        <li><a href="pdf/capitulo1.pdf">CAPITULO I</a>        </li>
        <li>De los principios y finalidades</li>
        <li><a href="pdf/capitulo2.pdf">CAPITULO II</a>        </li>
        <li>De los sindicalizados</li>
        <li><a href="pdf/capitulo3.pdf">CAPITULO III</a>        </li>
        <li>De las federaciones</li>
        <li><a href="pdf/capitulo4.pdf">CAPITULO IV</a>        </li>
        <li>Autoridades de la C.S.T.C.B.</li>
        <li><a href="pdf/capitulo5.pdf">CAPITULO V</a>        </li>
        <li>Del Comite Ejecutivo Nacional</li>
        <li><a href="pdf/capitulo6.pdf">CAPITULO VI</a>        </li>
        <li>Del departamento de cultura y prensa</li>
        <li><a href="pdf/capitulo7.pdf">CAPITULO VII</a>        </li>
        <li>De las cooperativas</li>
        <li><a href="pdf/capitulo8.pdf">CAPITULO VIII</a>        </li>
        <li>De los contratos colectivos y de la oficina tecnica</li>
        <li><a href="pdf/capitulo9.pdf">CAPITULO IX</a>        </li>
        <li>De las cajas y patrimonios sindicales</li>
        <li><a href="pdf/capitulo10.pdf">CAPITULO X</a>        </li>
        <li>De los comites de huelga</li>
        <li><a href="pdf/capitulo11.pdf">CAPITULO XI</a>        </li>
        <li>De las sanciones</li>
        <li><a href="pdf/capitulo12.pdf">CAPITULO XII</a>        </li>
        <li>De los delegados ante la C.O.B.</li>
        <li><a href="pdf/capitulo13.pdf">CAPITULO XIII</a>        </li>
        <li>Disposiciones generales</li>
        <li><a href="pdf/reglamentointerno.pdf">Reglamento Interno</a></li>
    </ul></td>
  </tr>
</table>

      
     