<?php
require('../clases/empleado.class.php');
$empleado = new empleado;
require('../clases/incidencia.class.php');
$incidencia = new incidencia;
$empleados = $empleado->mostrar_empleados();
$tiposincidencias = $incidencia->mostrar_tipo_incidencias();
$yr = date('Y');
	$yr = 2015;
$bandera = $_POST['bandera'];
$id=$_POST['empleado'];
$empresa=$_POST['empresa'];
switch ($bandera){
	case 1:
		$listaIncid=$incidencia->mostrar_incidenciasfiltro("SELECT idEmpleado,idTipoIncidencia,fechaInicio FROM incidencias WHERE idTipoIncidencia=".$_POST['incidencia']." ORDER BY fechaInicio");
		$listaIncid=array(
			array('idEmpleado' => 5,'idTipoIncidencia' => 4,'fechaInicio' => '2015-01-20 17:30:00'),
			array('idEmpleado' => 2,'idTipoIncidencia' => 4,'fechaInicio' => '2015-02-15 17:30:00'),
			array('idEmpleado' => 3,'idTipoIncidencia' => 4,'fechaInicio' => '2015-02-15 17:30:00'),
			array('idEmpleado' => 1,'idTipoIncidencia' => 4,'fechaInicio' => '2015-02-15 17:30:00'),
			array('idEmpleado' => 1,'idTipoIncidencia' => 4,'fechaInicio' => '2015-03-12 17:30:00'),
			array('idEmpleado' => 4,'idTipoIncidencia' => 4,'fechaInicio' => '2015-04-19 17:30:00'),
			array('idEmpleado' => 4,'idTipoIncidencia' => 4,'fechaInicio' => '2015-05-01 17:30:00'),
			array('idEmpleado' => 2,'idTipoIncidencia' => 4,'fechaInicio' => '2015-05-15 17:30:00'),
			array('idEmpleado' => 1,'idTipoIncidencia' => 4,'fechaInicio' => '2015-06-12 17:30:00'),
			array('idEmpleado' => 3,'idTipoIncidencia' => 4,'fechaInicio' => '2015-06-12 17:30:00'),
			array('idEmpleado' => 4,'idTipoIncidencia' => 4,'fechaInicio' => '2015-07-25 17:30:00'),
			array('idEmpleado' => 4,'idTipoIncidencia' => 4,'fechaInicio' => '2015-08-04 17:30:00'),
			array('idEmpleado' => 2,'idTipoIncidencia' => 4,'fechaInicio' => '2015-08-25 17:30:00'),
			array('idEmpleado' => 2,'idTipoIncidencia' => 4,'fechaInicio' => '2015-08-25 17:30:00'),
			array('idEmpleado' => 5,'idTipoIncidencia' => 4,'fechaInicio' => '2015-09-12 17:30:00'),
			array('idEmpleado' => 1,'idTipoIncidencia' => 4,'fechaInicio' => '2016-02-25 17:30:00'),
		);
		$fiBck = 0; $res=0;
		if (!empty($listaIncid)){
			foreach ($listaIncid as $ts){
				$tst = $incidencia->mostrar_incidenciasfiltro("SELECT nombreEmp FROM empleados WHERE idEmpleado=".$ts['idEmpleado']);
				$nmE = str_replace('--',' ',$tst[0]['nombreEmp']);
				$idE = $ts['idEmpleado'];
				$data1 = [];
				$fecha=explode(' ',$ts['fechaInicio']);
				if ($fiBck == $fecha[0]){
					$res++;
				} else {
					$res = 1;
					$fiBck = $fecha[0];
				}
				$data1[] = array($fecha[0],$res);
				$aux=[];
				foreach ($data1 as $key => $row) {
					$aux[$key] = $row[0];
				}
				$cuenta = count($data1);	
				array_multisort($aux,SORT_ASC,$data1);
				$arregloDatos[] = array('name'=>$nmE,'data'=>$data1,'NUM'=>$cuenta);	
			}
		} else {
			$listaIncid=0;
		}
		echo json_encode($arregloDatos);
	
		/*$emp = $incidencia->mostrar_incidenciasfiltro("SELECT DISTINCT idEmpleado FROM incidencias WHERE idTipoIncidencia=".$_POST['incidencia'].' AND idEmpresa='.$empresa.' ORDER BY idIncidencia');
		if (!empty($emp)){
			foreach($emp as $val){
				$lista=$incidencia->mostrar_incidenciasfiltro("SELECT idEmpleado,nombreEmp FROM empleados WHERE idEmpleado=".$val['idEmpleado']." AND idEmpresa=".$empresa);
				if (!empty($lista)){
					foreach ($lista as $val){
						$nombre = str_replace('--',' ',$val['nombreEmp']);
						$tst[] = array('nombre'=>$nombre,'id'=>$val['idEmpleado']);
					}
				} else {
					$tst=0;
				}
			}
		} else {
			$tst = 0;
		}
		if ($tst != 0){
			foreach ($tst as $ts){
				$nmE = $ts['nombre'];
				$idE = $ts['id'];	
				$data1=array(); 
				$listaIncid=$incidencia->mostrar_incidenciasfiltro("SELECT idEmpleado,idTipoIncidencia,fechaInicio FROM incidencias WHERE idTipoIncidencia = ".$_POST['incidencia']." AND idEmpleado=".$idE." ORDER BY fechaInicio");
				$res=0;
				foreach ($listaIncid as $val){
					$fecha=explode(' ',$val['fechaInicio']);
					$res++;
					$data1[] = array($fecha[0],$res);
				}
				$aux=[];
				foreach ($data1 as $key => $row) {
					$aux[$key] = $row[0];
				}
				$cuenta = count($data1);	
				array_multisort($aux,SORT_ASC,$data1);
				$arregloDatos[] = array('name'=>$nmE,'data'=>$data1,'NUM'=>$cuenta);
			}
		} else {
			$arregloDatos = 0;
		}
		echo json_encode($arregloDatos);*/
	break;
	case 2:
		$mes=$_POST['fecha'];
		if($mes<10){
			$mes = "0".$mes;
		}
		$listaIncid = $incidencia->mostrar_tipo_incidencias();
		$arreglo = array();
		foreach ($listaIncid as $inc) {
			$noIncid= $incidencia->verIncidenciasEmpTipo($id,$inc['idTipo'],$yr,$mes);
			if ($noIncid == 0){
				continue;
			}
			$arreglo[] = array('name'=>$inc['tipoIncidencia'],'data'=>$noIncid);
		}
		echo json_encode($arreglo);
	break;
	case 3:
		$tipo = $_POST['incidencia'];
		$mes = $_POST['fecha'];
		switch ($mes){
			case 1:
				$date = 'Enero';
				$yr = $yr-1;
				$yr=2015;
			break;
			case 2: $date = 'Febrero'; break;
			case 3: $date = 'Marzo'; break;
			case 4: $date = 'Abril'; break;
			case 5: $date = 'Mayo'; break;
			case 6: $date = 'Junio'; break;
			case 7: $date = 'Julio'; break;
			case 8: $date = 'Agosto'; break;
			case 9: $date = 'Septiembre'; break;
			case 10: $date = 'Octubre'; break;
			case 11: $date = 'Noviembre'; break;
			case 12: $date = 'Diciembre'; break;
		}
		$date = $date.' '.$yr;
		if($mes<10){
			$mes = "0".$mes;
		}
		$listaEmp = $incidencia->mostrar_incidenciasfiltro('SELECT idEmpleado,nombreEmp FROM empleados WHERE idEmpresa='.$empresa);
		foreach ($listaEmp as $emp){
			$listaIncid = $incidencia->verIncidenciasEmpTipo($emp['idEmpleado'],$tipo,$yr,$mes);
			$nm = str_replace('--',' ',$emp['nombreEmp']);
			if (!empty($listaIncid)){
				$datos[] = array('name'=>$nm,'num'=>$listaIncid,'date'=>$date);
			} else {
				$datos[] = array('name'=>$nm,'num'=>0,'date'=>$date);
			}
		}
		echo json_encode($datos);
	break;
	case 4:
		$tipo = $_POST['incidencia'];
		$listaIncid = $incidencia->mostrar_incidenciasfiltro('SELECT * FROM incidencias WHERE idTipoIncidencia='.$tipo.' AND idEmpleado='.$id.' AND fechaInicio like "'.$yr.'-%"');
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
	case 5:
		$idResp = $_POST['respOubic'];
		$mes=$_POST['fecha'];
		if($mes<10){
			$mes = "0".$mes;
		}
		$listaEmp=$incidencia->mostrar_incidenciasfiltro("SELECT idEmpleado,nombreEmp FROM empleados WHERE idResponsable=".$idResp." AND idEmpresa=".$empresa);
		$idIncid = $incidencia -> mostrar_tipo_incidencias();
		if (!empty($listaEmp)){
			foreach ($listaEmp as $emp){
				$datos11 = array();
				$nm = str_replace('--',' ',$emp['nombreEmp']);
				$datos[]=array('name'=>$nm);
				foreach ($idIncid as $incid){
					$listaIncid = $incidencia->verIncidenciasEmpTipo($emp['idEmpleado'],$incid['idTipo'],$yr,$mes);
					$datos11[]=array('incidencia'=>$incid['tipoIncidencia'],'num'=>$listaIncid);
				}
				$datos[]=array($datos11);
			}
		} else {
			$datos=0;
		}
	echo json_encode($datos);
	break;
	case 6:
		$idUbic = $_POST['respOubic'];
		$mes=$_POST['fecha'];
		if($mes<10){
			$mes = "0".$mes;
		}
		$listaEmp=$incidencia->mostrar_incidenciasfiltro("SELECT idEmpleado,nombreEmp FROM empleados WHERE idUbicacion=".$idUbic." AND idEmpresa=".$empresa);
		$idIncid = $incidencia -> mostrar_tipo_incidencias();
		if (!empty($listaEmp)){
			foreach ($listaEmp as $emp){
				$datos11 = array();
				$nm = str_replace('--',' ',$emp['nombreEmp']);
				$datos[]=array('name'=>$nm);
				foreach ($idIncid as $incid){
					$listaIncid = $incidencia->verIncidenciasEmpTipo($emp['idEmpleado'],$incid['idTipo'],$yr,$mes);
					$datos11[]=array('incidencia'=>$incid['tipoIncidencia'],'num'=>$listaIncid);
				}
				$datos[]=array($datos11);
			}
		} else {
			$datos=0;
		}
		echo json_encode($datos);
	break;
	}
?>