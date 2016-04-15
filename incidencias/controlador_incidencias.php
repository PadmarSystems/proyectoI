<?php
session_start();
require('../clases/incidencia.class.php');
$objincidencia = new incidencia;

if(isset($_GET['a'])){
	$accion=$_GET['a'];
	switch ($accion){
		case 'autocomplete_empleados':
			require('../clases/empleado.class.php');
			$empleado = new empleado;
			$clave = $_GET['term'];

			$consulta = $empleado->autocompletar_nombreEmpleados($clave);

			$listaObjetos= array();

			foreach ($consulta as $row) {
				$listaObjetos[] = str_replace('--',' ',$row['nombreEmp']);
			}

			echo '' . json_encode($listaObjetos) . '';

			break;
		case 'crear':
			require('../clases/empleado.class.php');
			$empleado = new empleado;
			
			$row = $empleado->mostrar_empleado($_GET['empleado']);
			
			if (empty($row)) {
				echo 'nf_empleado';
				return;
			}

			$array = array('folio'=>$_GET['folio'],'idUsuario' => $_SESSION['idUsuario'],'idEmpresa'=>$row['idEmpresa'],'idUbicacion'=>$row['idUbicacion'],'idEmpleado'=>$row['idEmpleado'],'idPuesto'=>$row['idPuesto'],'idResponsable'=>$row['idResponsable'],'idTipoIncidencia'=>$_GET['tipoIncidencia'],'fechaInicio'=>$_GET['fi_inc'] . ' ' . $_GET['hi_inc'],'fechaFin'=>$_GET['ff_inc'] . ' ' . $_GET['hf_inc'],'motivo'=>$_GET['motivo']);
			$inserta = $objincidencia->insertarincidencia($array);
			if ($inserta) {
				echo "success";
			}else{
				echo "error";
			}
			break;	
		default:
			header('');
			break;
	}
}else{
	header('Location: ../view.php?mod=notfound');
}
?>