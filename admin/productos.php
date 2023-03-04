<?php
include ("seguridad.php");
include ("funciones.php");
cabeceraAD();
?>
<?php
include ("calendario/calendario.php");
?>
<script type="text/javascript" src="js/ajax.js"></script>
<script language="JavaScript" src="calendario/javascripts.js"></script>
	<link rel="STYLESHEET" type="text/css" href="calendario/estilo.css">

<div id="contenido_admin" style="clear:both;">
<div id="submenu">
<a href="productos.php">Lista de productos</a>
<a href="productos.php?accion=anadir">A&ntilde;adir producto</a>
<a href="productos.php?accion=ingreso">Registrar ingreso</a>
<a href="productos.php?accion=venta">Registrar venta</a>
<a href="productos.php?accion=reportes">Reportes</a>
</div>
<?php
if (!isset($_GET['accion']) && !isset($_POST['accion'])){
require('config.php');
$buscar="SELECT id_producto,parte,nombre,precio,publicar,stock FROM producto";
$buscar=$buscar." ORDER BY parte";
//echo $buscar;
$resultados = mysql_query($buscar);
echo "<p>Para editar haga click en el producto</p>";
if($resultados){
		echo "<div style='text-align:center;'><table width=\"90%\">\n";
		echo "<tr><td width=\"1%\">NRO</td>";
		echo "<td>&nbsp;PARTE</td>";
		echo "<td>&nbsp;NOMBRE</td>";
		echo "<td>&nbsp;PRECIO VENTA</td>";
		echo "<td>&nbsp;Ult. PRECIO COMPRA</td>";
		echo "<td>&nbsp;STOCK</td>";
		echo "<td>&nbsp;PUBLICAR</td>";
		echo "</tr>\n";
		$x = 1;
		while (list($id,$parte,$nombre,$precio,$publicar,$stock) = mysql_fetch_array($resultados)) {
			echo "<tr><td width=\"1%\">".$x."-</td>";
			echo "<td>&nbsp;".$parte."</td>";
			echo "<td>&nbsp;<a href='?accion=editar&id=$id'>".$nombre."</a></td>";
			echo "<td>&nbsp;".$precio."</td>";
			echo "<td>&nbsp;";
			echo precio_compra($id);
			echo "</td>";
			echo "<td>&nbsp;".$stock."</td>";
			if($publicar==0)
				$mensaje="Activar";
			else
				$mensaje="Desactivar";
			echo "<td>&nbsp;<a href='?accion=publicar&id=$id&m=$mensaje'>".$mensaje."</a></td>";
			echo "</tr>\n";
			$x++;
		}
		echo "</table></div>\n";
	 }
mysql_close ();
}
?>
<?php
if ($_GET['accion']=="publicar"){
	$id=$_GET['id'];
	$mensaje=$_GET['m'];
	require('config.php');
	if($mensaje=="Activar")
		$e=1;
	if($mensaje=="Desactivar")
		$e=0;
	$query = "UPDATE producto SET publicar=$e WHERE id_producto=$id";
	//echo $query;
   	$result = mysql_query($query);
	echo "<p>Se realizo la accion $mensaje al producto.</p>";
	mysql_close ();
	exit;
}
?>

<?php
if ($_GET['accion']=="anadir"){
?>
<br><br>
<div style="padding-left:100px;">
<form action="productos.php" method="post">
<input type="hidden" name="accion" value="guardar">
Parte o accesorio:<br>
<select name="parte">
  <option value="Procesador">Procesador</option>
  <option value="Tarjeta Madre">Tarjeta Madre</option>
  <option value="Memoria RAM">Memoria RAM</option>
  <option value="Tarjeta de Sonido">Tarjeta de Sonido</option>
  <option value="Tarjeta de Video">Tarjeta de Video</option>
  <option value="Tarjeta de Red">Tarjeta de Red</option>
  <option value="Disco Duro">Disco Duro</option>
  <option value="Unidad Lectora">Unidad Lectora</option>
  <option value="CASE">CASE</option>
  <option value="Teclado">Teclado</option>
  <option value="Mouse">Mouse</option>
  <option value="Monitor">Monitor</option>
  <option value="Parlantes">Parlantes</option>
  <option value="Puertos USB">Puertos USB</option>
  <option value="Impresora">Impresora</option>
  <option value="Scanner">Scanner</option>
  <option value="Parlante">Parlante</option>
  <option value="Otros Accesorios">Otros Accesorios</option>
</select>
<br> 
Nombre:<br> 
<input name="nombre" type="text" size="50"><br> 
Precio:<br> 
<input type="text" name="precio"><br>
<br> 
<input type="submit" value="Registrar"><br> 
</form> 
</div>
<?php
exit;
}
if ($_POST['accion']=="guardar"){
	//establecemos conexion a la bd
	require('config.php');
	//recibimos las variables enviadas por el formulario 
	$parte=$_POST['parte']; 
	$nombre=$_POST['nombre']; 
	$precio=$_POST['precio']; 
	$sql="insert into producto(parte,nombre,precio) values 	('$parte','$nombre',$precio)";
	//echo $sql;
	$result = mysql_query($sql);
	mysql_close ();
	echo "El producto fue registrado";
	exit;
}

if ($_GET['accion']=="editar"){
	require('config.php');
	$id=$_GET["id"];
	$buscar="SELECT * FROM producto WHERE id_producto=$id";
	$resultados = mysql_query($buscar);
	if($resultados){
		$vector=mysql_fetch_array($resultados);
		$id=$vector['id_producto'];
		$parte=$vector['parte'];
		$nombre=$vector['nombre'];
		$precio=$vector['precio'];	
	}
	//echo "hii ".$tipo;
	mysql_close ();
?>
	<div style="padding-left:100px;">
	<form action="productos.php" method="get" name="editar"> 
	<input type="hidden" name="accion" value="actualizar"><br> 
	<input type="hidden" name="id" value="<?php echo $id;?>"><br> 
	Parte o accesorio:<br>
	<select name="parte">
	  <option value="Procesador" <?php if($parte=='Procesador') echo selected;?>>Procesador</option>
	  <option value="Tarjeta Madre" <?php if($parte=='Tarjeta Madre') echo selected;?>>Tarjeta Madre</option>
	  <option value="Memoria RAM" <?php if($parte=='Memoria RAM') echo selected;?>>Memoria RAM</option>
	  <option value="Tarjeta de Sonido" <?php if($parte=='Tarjeta de Sonido') echo selected;?>>Tarjeta de Sonido</option>
	  <option value="Tarjeta de Video" <?php if($parte=='Tarjeta de Video') echo selected;?>>Tarjeta de Video</option>
	  <option value="Tarjeta de Red" <?php if($parte=='Tarjeta de Red') echo selected;?>>Tarjeta de Red</option>
	  <option value="Disco Duro" <?php if($parte=='Disco Duro') echo selected;?>>Disco Duro</option>
	  <option value="Unidad Lectora" <?php if($parte=='Unidad Lectora') echo selected;?>>Unidad Lectora</option>
	  <option value="CASE" <?php if($parte=='CASE') echo selected;?>>CASE</option>
	  <option value="Teclado" <?php if($parte=='Teclado') echo selected;?>>Teclado</option>
	  <option value="Mouse" <?php if($parte=='Mouse') echo selected;?>>Mouse</option>
	  <option value="Monitor" <?php if($parte=='Monitor') echo selected;?>>Monitor</option>
	  <option value="Parlantes" <?php if($parte=='Parlantes') echo selected;?>>Parlantes</option>
	  <option value="Puertos USB" <?php if($parte=='Puertos USB') echo selected;?>>Puertos USB</option>
	  <option value="Impresora" <?php if($parte=='Impresora') echo selected;?>>Impresora</option>
	  <option value="Scanner" <?php if($parte=='Scanner') echo selected;?>>Scanner</option>
	  <option value="Parlante" <?php if($parte=='Parlante') echo selected;?>>Parlante</option>
	  <option value="Otros Accesorios" <?php if($parte=='Otros Accesorios') echo selected;?>>Otros Accesorios</option>
	  </select>
	<br>
	Nombre:<br>
    <input name="nombre" type="text" size="50" value="<?php echo $nombre;?>"/>
    <br>
    Precio:<br>
	<input type="text" name="precio"  value="<?php echo $precio;?>"/>
	<br>  
	<input type="submit" value="Actualizar"><br> 
	</form> 
	</div>
<?php
	exit;
}
?>
<?php
if ($_GET['accion']=="actualizar"){
	require('config.php');
	$id=$_GET["id"];
	$parte=$_GET["parte"];
	$nombre=$_GET["nombre"];
	$precio=$_GET["precio"];
	$query = "UPDATE producto SET parte='$parte' WHERE id_producto=$id";
    $result = mysql_query($query);
	$query = "UPDATE producto SET nombre='$nombre' WHERE id_producto=$id";
    $result = mysql_query($query);
	$query = "UPDATE producto SET precio='$precio' WHERE id_producto=$id";
    $result = mysql_query($query);
	mysql_close ();
	echo "El producto fue actualizado";
	exit;
}
?>
<?php
if ($_GET['accion']=="ingreso"){
	require('config.php');
?>
<br><br>
<div style="padding-left:100px;">
<form action="productos.php" method="post" name="ingreso_producto">
<input type="hidden" name="accion" value="guardar_ingreso">
<input type="hidden" id="proceso" value="ingreso">
Parte o accesorio:<br>
<select name="parte" id="parte" onChange="HTMLData();">
<?php
	$buscar="SELECT parte FROM producto GROUP BY parte";
	$resultados = mysql_query($buscar);
	echo "<option value=''>-Seleccione-</option>";
	if($resultados){
		while (list($parte) = mysql_fetch_array($resultados)) {
			echo "<option value='$parte'>$parte</option>";
		}
	}
  
?>
</select>
<br> 
Nombre:<br>
<div id="txtResult"> 
<select name="nombre" id="nombre">
<option></option>
</select></div>
Cantidad:<br>
<input type="text" name="cantidad2" size="3"/> &nbsp;&nbsp;
<input type="text" id="cantidad_stock" size="3" disabled="disabled"/><br/>
Precio:<br>
<input type="text" name="precio" size="3"/> &nbsp;&nbsp;
<input type="hidden" id="precio_stock"/>
<br> 
Fecha:<br> 
<?php
escribe_formulario_fecha_vacio("fecha1","ingreso_producto");
?>
</div>
<div style="padding-left:100px;">
Encargado:<br> 
<select name="encargado" id="encargado">
<?php
	$buscar="SELECT id_usuario,correo FROM usuario WHERE tipo_usuario=2";
	$resultados = mysql_query($buscar);
	echo "<option value=''>-Seleccione-</option>";
	if($resultados){
		while (list($id,$parte) = mysql_fetch_array($resultados)) {
			echo "<option value='$id'>$parte</option>";
		}
	}
  
?>
</select><br/>
<input type="submit" value="Registrar"><br> 
</form> 
</div>
<?php
mysql_close ();
exit;
}
if ($_POST['accion']=="guardar_ingreso"){
	//establecemos conexion a la bd
	require('config.php');
	$n=$_POST['nombre']; 
	$f=$_POST['fecha1']; 
	$c=$_POST['cantidad2']; 
	$p=$_POST['precio'];
	$e=$_POST['encargado']; 
	$sql="insert into ingreso_pro(id_producto,fecha,cantidad,precio,id_usuario) values($n,'$f',$c,$p,$e)";
	$result = mysql_query($sql);
	//*********************************aqui prod modificar*********************************
	$query = "UPDATE producto SET stock=stock+$c WHERE id_producto=$n";
	//echo $query;
    $result = mysql_query($query);
	mysql_close ();
	echo "El producto fue ingresado";
	exit;
}
?>
<?php
if ($_GET['accion']=="venta"){
	require('config.php');
?>
<br><br>
<div style="padding-left:100px;">
<form action="productos.php" method="post" name="ingreso_producto">
<input type="hidden" name="accion" value="guardar_venta">
<input type="hidden" id="proceso" value="venta">
Parte o accesorio:<br>
<select name="parte" id="parte" onChange="HTMLData();">
<?php
	$buscar="SELECT parte FROM producto WHERE stock>0 GROUP BY parte";
	$resultados = mysql_query($buscar);
	echo "<option value=''>-Seleccione-</option>";
	if($resultados){
		while (list($parte) = mysql_fetch_array($resultados)) {
			echo "<option value='$parte'>$parte</option>";
		}
	}
  
?>
</select>
<br> 
Nombre:<br>
<div id="txtResult"> 
<select name="nombre">
<option></option>
</select></div>
Fecha:<br> 
<?php
escribe_formulario_fecha_vacio("fecha1","ingreso_producto");
?>
</div>
<div style="padding-left:100px;">
Cantidad:<br>
<input type="text" name="cantidad" size="3"/> &nbsp;&nbsp;
<input type="text" id="cantidad_stock" size="3" disabled="disabled"/>
<br/> 
Precio:<br>
<input type="text" name="precio_stock" id="precio_stock" size="3"/>
<br> 
Encargado:<br> 
<select name="encargado" id="encargado">
<?php
	$buscar="SELECT id_usuario,correo FROM usuario WHERE tipo_usuario=2";
	$resultados = mysql_query($buscar);
	echo "<option value=''>-Seleccione-</option>";
	if($resultados){
		while (list($id,$parte) = mysql_fetch_array($resultados)) {
			echo "<option value='$id'>$parte</option>";
		}
	}
  
?>
</select><br/>
Observacion:<br/>
<input type="text" name="observacion" size="80" maxlength="254"><br/>
<input type="submit" value="Registrar"><br> 
</form> 
</div>
<?php
mysql_close ();
exit;
}
if ($_POST['accion']=="guardar_venta"){
	//establecemos conexion a la bd
	require('config.php');
	//recibimos las variables enviadas por el formulario 
	$n=$_POST['nombre']; 
	$f=$_POST['fecha1']; 
	$c=$_POST['cantidad']; 
	$p=$_POST['precio_stock'];
	$e=$_POST['encargado']; 
	$ob=$_POST['observacion'];
	$ut=$c*($p-precio_compra($n));
	//echo "-----asfdf.--------- ".$ob;
	$sql="insert into venta_pro (id_producto,fecha,cantidad,precio,utilidad,id_usuario,observacion) values ($n,'$f',$c,$p,$ut,$e,'$ob')";
	$result = mysql_query($sql);
	//*********************************aqui prod modificar*********************************
	$query = "UPDATE producto SET stock=stock-$c WHERE id_producto=$n";
    $result = mysql_query($query);
	mysql_close ();
	echo "La venta del producto fue registrado";
	exit;
}
?>
<?php
if ($_GET['accion']=="reportes"){
	require('config.php');
?>
<br><br>
<div style="padding-left:100px;">
<form method="post" name="reporte_producto">
<table width="982" border="1">
  <tr>
    <td width="208">Tipo reporte:
      <select name="reporte" id="reporte">
        <option value='1'>Ingresos</option>
        <option value='2'>Ventas</option>
      </select></td>
    <td width="185">Fecha inicio:
      <?php
escribe_formulario_fecha_vacio("fecha1","reporte_producto");
?></td>
    <td width="185">Fecha fin:
      <?php
escribe_formulario_fecha_vacio("fecha2","reporte_producto");
?></td>
    <td width="185">
    Usuario:
    <select name="us" id="us">
<?php
	$buscar="SELECT id_usuario,correo FROM usuario WHERE tipo_usuario=2";
	$resultados = mysql_query($buscar);
	echo "<option value=0>-Seleccione-</option>";
	if($resultados){
		while (list($id,$nombre) = mysql_fetch_array($resultados)) {
			echo "<option value=$id>$nombre</option>";
		}
	}
  
?>
</select>
</td>
    <td width="185"><input type="button" onclick="Extraer();" value="Extraer"></td>
  </tr>
</table>
</form> 
<div id="respuesta">
</div>
</div>
<?php
mysql_close ();
exit;
}
?>
</div>
</body>
</html>