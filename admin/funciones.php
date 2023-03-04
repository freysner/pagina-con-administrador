<?php
function cabeceraAD(){
$nivel=$_SESSION["nivelAcceso"];
echo <<< HTML
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Aplicacin segura</title>
<link href="presentacion.css" type="text/css" rel="stylesheet">
<meta name="robots" content="no index, no follow" />
<script type="text/javascript" src="nicEdit.js"></script>
<script type="text/javascript">
	bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
<SCRIPT type="text/javascript" src="js/validar.js"></SCRIPT>
</head>
<body>
<div style="background-color:#2166a7;">
<div style="text-align:center;"><img src="img/bg-cabecera.jpg" style="border:0px;"></div>
<hr size=1 style="color:white;">
<div id="menu">
HTML;
?>
<?php
if($nivel==3)
 echo "<a href='usuario.php'><img src='img/usuario.gif' border='0'> Usuarios</a>";
?>
<?php
echo <<< HTML
<a href="afiliados.php"><img src="img/descarga.gif" border="0">Afiliados</a>
<a href="paginas.php"><img src="img/descarga.gif" border="0">Paginas</a>
<a href="actividades.php"><img src="img/descarga.gif" border="0">Actividades</a>
<a href="documentos.php"><img src="img/descarga.gif" border="0"> Documentos</a>
<a href="contactos.php"><img src="img/descarga.gif" border="0"> Contactos</a>
<a href="index.php?salir=ok"><img src="img/salir.gif" border="0"> Salir</a>
</div>
<HR size=1 style="clear:both;color:white;">
</div>

HTML;
}
?>