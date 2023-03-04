<?
require('config.php');
$buscar="SELECT * FROM cliente WHERE estado=0 AND email!=''";
$resultados = mysql_query($buscar);
//echo $resultados." hola como esta";
$Email_admin="contactos@hatemel.com";
$asunto="Desarrollo de sitios web y sistemas informaticos";
$mensaje="<div style='font-family:verdana;font-size:10pt;'>";
$mensaje=$mensaje."<span style='font-size:15pt;'><b>HATEMEL</b></span><br>";
$mensaje=$mensaje."<span style='font-size:7pt;'>Impulsando una sociedad de conocimiento</span><br><br>";
$mensaje=$mensaje."Señores<br>";

$mensaje2="Presente.-<br><br>";
$mensaje2=$mensaje2."A quien corresponda<br>";
$mensaje2=$mensaje2."<p>Quiero  saludarle a usted muy cordialmente, de parte de la empresa HATEMEL. Nos enteramos de su actividad empresarial, queremos mostrarle todas las ventajas  que le  pueda aportar una solución informática a su empresa.</p>";
$mensaje2=$mensaje2."<p>Le hacemos llegar la oferta de nuestros servicios, le invitamos a visitar nuestro sitio <a href='http://hatemel.com'>www.hatemel.com</a></p>";
$mensaje2=$mensaje2."<p>Esperando que pueda dedicar 30 minutos a entrevistarse con nosotros, si tiene alguna pregunta le ruego se ponga en contacto conmigo en el número de <b>Cel. 77266811.</b></p>";
$mensaje2=$mensaje2."<p>Le agradezco que haya dedicado su tiempo a considerar mi solicitud, atentamente.</p>";
$mensaje2=$mensaje2."<b>Freysner Chambi</b><br>";
$mensaje2=$mensaje2."<b>GERENTE GENERAL</b><br>";
$mensaje2=$mensaje2."EL Alto -  Zona 16 de febrero, Calle Yacuma 2104 <br>";
$mensaje2=$mensaje2."Cel.: 70539934 - 77266811<br>";
$mensaje2=$mensaje2."<a href='http://hatemel.com'>www.hatemel.com</a>";
$mensaje2=$mensaje2."</div>";

while (list($nombre,$rubro,$telefono,$celular,$direccion,$estado,$email) = mysql_fetch_array($resultados)) {
	$cuerpo=$mensaje.$nombre."<br>".$mensaje2;
	//echo $cuerpo."<br>";
	$cabecera = "From: $Email_admin\r\n" . "Reply-To: $Email_admin\r\n" . "Return-path: $Email_admin\r\n" . "MIME-Version: 1.0\n" . "Content-type: text/plain; charset=iso-8859-1"; 
	if (mail($email,$asunto,$mensaje,$cabecera))
		echo $email." Enviado<br>";
	else
		echo $email." Fallo<br>";
}

?>

