<?php
//Comentario sin valor, prueba en git 1.
$url = $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
$exp1 = explode('?',$_SERVER["REQUEST_URI"]);
$aftelin = "";
$prevelin = $exp1[0];
if(count($exp1)>0) {
	for($x=1;$x<=(count($exp1)-1);$x++) {
		$aftelin = $aftelin.$exp1[$x];
	}
}
$carp = explode('/',$prevelin);
for($y=1;$y<(count($carp)-1);$y++) {
	$j=$y-1;
	$carpetas[$j] = $carp[$y];
}
$file = $carp[(count($carp)-1)];
$ext = explode('.',$file);
$file_name =$ext[0];
if(isset($ext[1])) {
	$extension = $ext[1];
}
$numcarp = count($carpetas)-1;
//echo $numcarp;
$ruta="";
for($x=0;$x<$numcarp;$x++) {
	$ruta.="../";
}
?>
