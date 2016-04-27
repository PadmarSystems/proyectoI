<?php


$array = array();

if (count($campos) > 0) {
	foreach ($array as $row) {
		if (array_key_exists($row['nombreCampo'], $ncampos)) {
			array_push($ncampos['nombreCampo'],  $row['valorCampo']);
		}else{
			arary_push($ncampos,)
		}
	}
}
/*function agregar_camposformulario($array){
	$ncampos = array();
	if ( count($array) > 0 ) {
		foreach ($array as $row) {
			if (array_key_exists($row['nombreCampo'], $ncampos)) {
    			array_push($ncampos['nombreCampo'],  $row['valorCampo']);
			}else{
				arary_push($ncampos,)
			}
		}
	}
}*/
?>