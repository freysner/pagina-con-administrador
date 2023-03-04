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
            <li class="Estilo2"><img src="img/bnd/lapaz.png" alt="la paz"/></li>
            <li class="Estilo2">LA PAZ</li>
            <li class="Estilo3">Miguel Macuchapi</li>
            <li class="Estilo3">Boquerón 1234</li>
            <li class="Estilo2"><img src="img/bnd/stacruz.png" alt="santa cruz"/></li>
            <li class="Estilo2">SANTA CRUZ</li>
            <li class="Estilo3">Edilberto Egüez M.</li>
            <li class="Estilo3">Ballivián 28</li>
            <li class="Estilo2"><img src="img/bnd/cbba.png" alt="santa cruz"/></li>
            <li class="Estilo2">COCHABAMBA</li>
            <li class="Estilo3">Julián Rocha Gonzalés</li>
            <li class="Estilo3">Jordán 690</li>
            <li class="Estilo2"><img src="img/bnd/chuquisaca.png" alt="santa cruz"/></li>
            <li class="Estilo2">CHUQUISACA</li>
            <li class="Estilo3">Raúl Gonzales</li>
            <li class="Estilo3">(Sucre) Olañeta 201</li>
            <li class="Estilo2"><img src="img/bnd/oruro.png" alt="santa cruz"/></li>
            <li class="Estilo2">ORURO</li>
            <li class="Estilo3">Eugenio Cayo</li>
            <li class="Estilo3">Potosí 6339</li>
            <li class="Estilo2"><img src="img/bnd/tarija.png" alt="santa cruz"/></li>
            <li class="Estilo2">TARIJA</li>
            <li class="Estilo3">Carlos Salvatierra</li>
            <li class="Estilo3">A. D'Orbigny 268</li>
            <li class="Estilo2"><img src="img/bnd/potosi.png" alt="santa cruz"/></li>
            <li class="Estilo2">POTOSI</li>
            <li class="Estilo3">Por designar</li>
            <li class="Estilo3">Junín 41</li>
            <li class="Estilo2"><img src="img/bnd/beni.png" alt="santa cruz"/></li>
            <li class="Estilo2">BENI</li>
            <li class="Estilo3">Hernán Chavéz Aguilera</li>
            <li class="Estilo3">(Trinidad) C. Sicuana 28</li>
          </ul>
          </marquee>
          </td>
          </tr>
          <tr>
          <td colspan="2" id="celda2" style="display:none;" height="215">
          <marquee direction="up" onmouseout="this.start()" onmouseover="this.stop()" width="190px" scrollamount="1" height="215px">
           <?php
		 include('config.php');
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
