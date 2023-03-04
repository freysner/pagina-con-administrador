<?php
//script made in ZONE WEB
$counterFile = "visitas.txt";

function displayCounter($counterFile) {
$fp = fopen($counterFile,"rw"); 
$num = fgets($fp,5); 
//$num += 1; 
print "$num"; 
exec( "rm -rf $counterFile");
exec( "echo $num > $counterFile");
} 
if (!file_exists($counterFile)) {
exec( "echo 1 > $counterFile"); 
} 
displayCounter($counterFile);

?> 