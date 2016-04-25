<?php
error_reporting(-1);
session_start();
require('../clases/incidencia.class.php');
$objincidencia = new incidencia;

if(isset($_POST['a'])){
	$accion=$_POST['a'];
	switch ($accion){
		case 'autocomplete_empleados':
			require('../clases/empleado.class.php');
			$empleado = new empleado;
			$clave = $_POST['term'];

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
			
			$row = $empleado->mostrar_empleado($_POST['empleado']);
			
			if (empty($row)) {
				echo 'nf_empleado';
				return;
			}

			$array = array('folio'=>$_POST['folio'],'idUsuario' => $_SESSION['idUsuario'],'idEmpresa'=>$row['idEmpresa'],'idUbicacion'=>$row['idUbicacion'],'idEmpleado'=>$row['idEmpleado'],'idPuesto'=>$row['idPuesto'],'idResponsable'=>$row['idResponsable'],'idTipoIncidencia'=>$_POST['tipoIncidencia'],'fechaInicio'=>$_POST['fi_inc'] . ' ' . $_POST['hi_inc'],'fechaFin'=>$_POST['ff_inc'] . ' ' . $_POST['hf_inc'],'motivo'=>$_POST['motivo']);
			$inserta = $objincidencia->insertarincidencia($array);
			if ($inserta) {
				echo "success";
			}else{
				echo "error";
			}
			break;
		case 'Detalle':
				
				$row = $objincidencia->mostrar_ultimaincidencia($_POST['idEmpleado']);
				
				if (count($row) == 0) {
					echo "No hay incidencias relacionadas al empleado";
					return;
				}

				?>
				<p>
					<label>Ultima incidencia:  <?php echo date("d/m/Y",strtotime($row['fechaInicio'])); ?> ( <?php echo $row['tipoIncidencia']; ?> )</label> <a onclick="goto('lista_incidencias&idEmpleado=<?php echo $_POST['idEmpleado']; ?>&a=1','reportes')"> Ver detalles</a>
				</p>
				<?php
				$num = $objincidencia->mostrar_numincidencias($_POST['idEmpleado'],date("m"));
				?>
				<p>
					<label>N° de incidencias del mes :  <?php echo $num; ?></label> <a onclick="goto('lista_incidencias&idEmpleado=<?php echo $_POST['idEmpleado']; ?>&a=2','reportes')"> Ver </a>
				</p>
				<?php
				$numTotal = $objincidencia->mostrar_numincidenciastotal($_POST['idEmpleado']);
				?>
				<p>
					<label>Incidencias desde su alta :  <?php echo $numTotal; ?></label> <a onclick="goto('lista_incidencias&idEmpleado=<?php echo $_POST['idEmpleado']; ?>&a=3','reportes')"> Reportes </a>
				</p>
				<?php
			break;
		case 'Kardex':
				require('../clases/empleado.class.php');
				$objemp = new empleado;
				$html = "";
				$row = $objemp->mostrar_empleadodetalle($_POST['idEmpleado']);
				?>
				<p>
					<div><img src="<?php echo $row['fotoEmp']; ?>"/></div>
					<h2><?php echo str_replace('--',' ',$row['nombreEmp']); ?></h2>
				</p>
				<p>
					<label><?php echo $_SESSION['empresa']; ?></label><br>
					<label><?php echo $row['nombrePuesto']; ?></label><br>
					<label><?php echo $row['nombreUbicacion']; ?></label><br>
					<label><?php echo $row['nombreResponsable']; ?></label><br>
					<label><?php echo $row['telEmp']; ?></label><br>
					<label><?php echo $row['emailEmp']; ?></label>
				</p>
				<?php
			break;
		default:
			header('');
			break;
	}
}else{
	header('Location: ../view.php?mod=notfound');
}
?>