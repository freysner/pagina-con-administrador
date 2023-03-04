<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>C.S.C.T.B. - TRABAJADORES EN CONSTRUCCION DE BOLIVIA </title>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jqmodal.js"></script>
<script type="text/javascript" src="js/interfaces.js"></script>
<link rel="stylesheet" type="text/css" href="estilos.css" />
</head>

<body>
<center>
<div id="todos">
<div id="todo">
	<?php
    include("areas/cabezera.php");
    include("areas/menus.php");
    ?>
<table id="tabla_cuerpo">
  <tr>
    <td width="202px">
	<?php
	include('areas/casilla_interactiva.php');
	?>
    </td>
    <td style="padding-left:12px;">
	<?php
	include('contenidos/mision.php');
	?>
    </td>
  </tr>
</table>
<?php
include('areas/hatemel.php');
?>
</div>
</div>
</center>
</body>
</html>
