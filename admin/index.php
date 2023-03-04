<?php
	session_name("loginUsuario");
	session_start();
	session_destroy();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
  <title>Administrador de sitio web - HATEMEL</title>
<link href="presentacion.css" type="text/css" rel="stylesheet">
<meta name="robots" content="no index, no follow" />
</head>
<body>

<div style="background-color:#2166a7;">
<div style="text-align:center;"><img src="img/bg-cabecera.jpg" style="border:0px;" alt="cabezera"></div>
<hr size=1 style="color:white;">
</div>

<div style="width: 70%; height:145px;float: left; background-color:#eef1f9;">
<h3>Estadisticas</h3>
<ul>
<li>Nro. visitantes total:
<?php
include('estadisticas.php');
?></li>
<li>Promedio diario:</li>
</ul>
</div>

<div style="width: 30%;BACKGROUND-COLOR:#a7c0dc; float:right;">
<form action="control.php" method="post">
  <table align="center" border="0" cellpadding="2" cellspacing="2">

    <tbody>

      <tr>

		<td colspan="2" align="center"
		<?php
        if ($_GET["errorusuario"]=="si"){?>
		bgcolor=red><span style="color:ffffff"><b>Datos incorrectos</b></span>
		<?php
        }else{?>
		bgcolor=#cef044>Introduce tu clave de acceso
		<?php
        }?></td>
      </tr>

      <tr>

        <td align="right">USER:</td>

        <td><input name="usuario" size="18" maxlength="50" type="text"></td>
      </tr>

      <tr>

        <td align="right">PASSWD:</td>

        <td><input name="contrasena" size="18" maxlength="50" type="password"></td>
      </tr>

      <tr>

        <td colspan="2" align="center"><input value="ENTRAR" type="submit"></td>
      </tr>
    </tbody>
  </table>

</form>
</div>
<div style='text-align:center;'>
<?php
if($_GET["salir"]=="ok"){
?>
<div style="color:green;">
Terminaste tu sesion correctamente<br>
Gracias por tu acceso
</div>
<?php
}
?>
<a href="/index.php" style="font-size:13pt;color:red;">Pagina principal del sitio</a>
</div>
</body>
</html>
