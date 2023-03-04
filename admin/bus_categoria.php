<?php
require('config.php');
$categoria=$_GET['ct'];
if($categoria=='SINDICALES'){
	echo "<select name=sub_categoria id=sub_categoria>";
	echo "<option value='MESAS'>MESAS DE TRABAJO</option>";
	echo "<option value='AMPLIADOS'>AMPLIADOS NACIONALES</option>";
	echo "<option value='DEPARTAMENTALES'>AMPLIADOS DEPARTAMENTALES</option>";
	echo "<option value='COMITE'>COMITE EJECUTIVO NACIONAL</option>";
	echo "<option value='CONFERENCIAS'>CONFERENCIAS ORGANICAS Y CONGRESOS</option>";
	echo "</select>";
}
if($categoria=='ACTIVIDADES'){
	echo "<select name=sub_categoria id=sub_categoria>";
	echo "<option value='SEMINARIOS'>SEMINARIOS</option>";
	echo "<option value='TALLERES'>TALLERES</option>";
	echo "<option value='FOROS'>FOROS</option>";
	echo "</select>";
}
if($categoria=='ESTADISTICOS'){
	echo "<select name=sub_categoria id=sub_categoria>";
	echo "<option value='CGTFB'>CGTFB</option>";
	echo "<option value='FEDERACIONES'>FEDERACIONES AFILIADAS</option>";
	echo "<option value='INDICADORES'>INDICADORES NACIONALES</option>";
	echo "<option value='OTROS'>OTROS</option>";
	echo "</select>";
}
if($categoria=='ESTUDIOS'){
	echo "<select name=sub_categoria id=sub_categoria>";
	echo "<option value='NACIONALES'>NACIONALES</option>";
	echo "<option value='REGIONALES'>REGIONALES O DEPARTAMENTALES</option>";
	echo "</select>";
}
if($categoria=='DOCUMENTOS'){
	echo "<select name=sub_categoria id=sub_categoria>";
	echo "<option value='COMUNICADOS'>COMUNICADOS</option>";
	echo "<option value='RESOLUCIONES'>RESOLUCIONES</option>";
	echo "<option value='BOLETINES'>BOLETINES</option>";
	echo "<option value='AFICHES'>AFICHES</option>";
	echo "<option value='TRIPTICOS'>TRIPTICOS Y BIPTICOS</option>";
	echo "<option value='CARTILLAS'>CARTILLAS</option>";
	echo "</select>";
}
if($categoria=='PROYECTOS'){
	echo "<select name=sub_categoria id=sub_categoria>";
	echo "<option value='FOS'>FOS - BELGICA</option>";
	echo "<option value='3F'>3F - DINAMARCA</option>";
	echo "</select>";
}
if($categoria=='QUIENES'){
	echo "<select name=sub_categoria id=sub_categoria>";
	echo "<option value='ESTATUTOS' selected='selected'>ESTATUTOS ORGANICOS Y REGLAMENTO INTERNO</option>";
	echo "</select>";
}

?>