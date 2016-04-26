<?php
require('../clases/empleado.class.php');
$empleado = new empleado;
require('../clases/incidencia.class.php');
$incidencia = new incidencia;
$empleados = $empleado->mostrar_empleados();
$tiposincidencias = $incidencia->mostrar_tipo_incidencias();

$id=$_POST['empleado'];
$empresa=$_POST['empresa'];
$bandera = $_POST['bandera'];
switch ($bandera){
	case 1:
		$date=$_POST['fecha'];
		if($date<10){
			$date = "0".$date;
		}
		$listaIncid = $incidencia->mostrar_incidenciasfiltro('SELECT * FROM tipo_incidencia');
		$arreglo = array();
		foreach ($listaIncid as $inc) {
			$noIncid= $incidencia->verIncidenciasTipoFecha($id,$inc['idTipo'],$date);
			$noIncid = count($noIncid);
			if ($noIncid == 0){
				continue;
			}
			$arreglo[] = array('name'=>$inc['tipoIncidencia'],'data'=>$noIncid);
		}
		echo json_encode($arreglo);
	break;
	case 2:
		$tipo = $_POST['incidencia'];
		$listaIncid = $incidencia->mostrar_incidenciasfiltro('SELECT * FROM incidencias WHERE idTipoIncidencia='.$tipo.' AND idEmpleado='.$id);
		$Ene = 0;  $Feb = 0;  $Mar = 0;  $Abr = 0;
		$May = 0;  $Jun = 0;  $Jul = 0;  $Ago = 0;
		$Sep = 0;  $Oct = 0;  $Nov = 0;  $Dic = 0;
		foreach ($listaIncid as $fechas){
			$date = explode(' ',$fechas['fechaInicio']);
			$date = explode('-',$date[0]);
			switch($date[1]){
				case '01': $Ene++; break;
				case '02': $Feb++; break;
				case '03': $Mar++; break;
				case '04': $Abr++; break;
				case '05': $May++; break;
				case '06': $Jun++; break;
				case '07': $Jul++; break;
				case '08': $Ago++; break;
				case '09': $Sep++; break;
				case '10': $Oct++; break;
				case '11': $Nov++; break;
				case '12': $Dic++; break;
			}
		}
		$arreglo = array($Ene,$Feb,$Mar,$Abr,$May,$Jun,$Jul,$Ago,$Sep,$Oct,$Nov,$Dic);
		echo json_encode($arreglo);
	break;
}
?>
