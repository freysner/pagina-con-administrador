    <div  id="casillas">
      <table>
        <tr>
          <td bgcolor="#D5D3D3" id="fondo_titulo1">
          <a href="javascript:mostrar(1);" style="color:#000000;" id="titulo1">FEDERACIONES AFILIADAS</a></td>
          <td bgcolor="#6E1310" id="fondo_titulo2">
          <a href="javascript:mostrar(2);" style="color:#FFFFFF;" id="titulo2">TODAS LAS ACTIVIDADES</a></td>
        </tr>
        <tr>
          <td colspan="2" id="celda1" height="215">
          <marquee direction="up" onmouseout="this.start()" onmouseover="this.stop()" scrollamount="1" width="190px" height="215px">
          <ul>
                <?php
                include('config.php');
                $buscar="SELECT * FROM afiliados";
                $resultados = mysql_query($buscar);
                while (list($id,$lugar,$ejecutivo,$direccion,$bandera) = mysql_fetch_array($resultados)) {
               ?>
                    <li class="Estilo2"><img src="<?php echo $bandera;?>" alt="<?php echo $lugar;?>"/></li>
                    <li class="Estilo2"><?php echo $lugar;?></li>
                    <li class="Estilo3"><?php echo $ejecutivo;?></li>
                    <li class="Estilo3"><?php echo $direccion;?></li>
               <?php     
               }
               ?>
          </ul>
          </marquee>
          </td>
          </tr>
          <tr>
          <td colspan="2" id="celda2" style="display:none;" height="215">
          <marquee direction="up" onmouseout="this.start()" onmouseover="this.stop()" width="190px" scrollamount="1" height="215px">
           <?php
		 //include('config.php');
		 $buscar="SELECT * FROM actividad ORDER BY id_actividad DESC";
		 $resultados = mysql_query($buscar);
		 while(list($id,$nombre,$descripcion) = mysql_fetch_array($resultados)){
			?>
	      <p class="Estilo2"><?php echo $nombre; ?></p><br /> 
		   <?php
           }
           ?>
           </marquee>
          </td>
          </tr>

      </table>
</div>
      <div id="logos">
      <br />
      ALIADOS ESTRATEGICOS
      <img src="img/logo_cstcb_mapa.png" alt="logo cstcb" />
      <img src="img/logo_bwi.png" alt="logo bwi" />
      <img src="img/logo_3f.png" alt="logo 3f" />      </div>
