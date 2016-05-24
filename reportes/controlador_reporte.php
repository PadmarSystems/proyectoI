<?php
session_start();
require('../clases/incidencia.class.php');
$objincidencia = new incidencia;

if(isset($_POST['a'])){
	#print_r($_POST);
	$accion=$_POST['a'];
	switch ($accion){
		case 'filtrar':
			
			//$sql = "SELECT incidencias.*,nombreEmpresa,nombreUsuario,nombreEmp,nombreResponsable,nombrePuesto,nombreUbicacion,tipoIncidencia FROM `incidencias` INNER JOIN usuarios ON incidencias.idUsuario=usuarios.idUsuario INNER JOIN empresas ON incidencias.idEmpresa=empresas.idEmpresa";
			$sql = "";
			if($_POST['empresa'] != ''){
				if($sql==''){
					$sql .= "WHERE";
				}else{
					$sql .= " AND ";
				}
				$sql .= " incidencias.idEmpresa=".$_POST['empresa']." ";
			}
			
			if($_POST['empleado'] != ''){
				if($sql==''){
					$sql .= "WHERE";
				}else{
					$sql .= " AND ";
				}
				echo $sql;
				$sql .= " incidencias.idEmpleado=".$_POST['empleado']." ";
			}
			//$sql .= " INNER JOIN empleados ON incidencias.idEmpleado=empleados.idEmpleado";
			//$sql .= " INNER JOIN tipo_incidencia ON incidencias.idTipoIncidencia=tipo_incidencia.idTipo";

			if($_POST['tipoIn'] != ''){
				if($sql==''){
					$sql .= "WHERE";
				}else{
					$sql .= " AND ";
				}
				$sql .= " incidencias.idTipoIncidencia=".$_POST['tipoIn']." ";
			}

			//$sql .= " LEFT JOIN puestos ON incidencias.idPuesto=puestos.idPuesto";

			if($_POST['puesto'] != ''){
				if($sql==''){
					$sql .= "WHERE";
				}else{
					$sql .= " AND ";
				}
				$sql .= " incidencias.idPuesto=".$_POST['puesto']." ";
			}

			//$sql .= " LEFT JOIN ubicaciones ON incidencias.idUbicacion=ubicaciones.idUbicacion";

			if($_POST['ubicacion'] != ''){
				if($sql==''){
					$sql .= "WHERE";
				}else{
					$sql .= " AND ";
				}
				$sql .= " incidencias.idUbicacion=".$_POST['ubicacion']." ";
			}

			//$sql .= " LEFT JOIN responsables ON incidencias.idResponsable=responsables.idResponsable";

			if($_POST['responsable'] != ''){
				if($sql==''){
					$sql .= "WHERE";
				}else{
					$sql .= " AND ";
				}
				$sql .= " incidencias.idResponsable=".$_POST['responsable']." ";
			}
			
			if($_POST['fechai'] != '' && $_POST['fechaf'] != ''){
				if($sql==''){
					$sql .= "WHERE";
				}else{
					$sql .= " AND ";
				}
				$sql .= " fechaInicio BETWEEN '".$_POST['fechai']." 00:00:00' AND  '".$_POST['fechaif']." 23:59:59'";
			}
			

			//$incidencias = $objincidencia->mostrar_incidenciasfiltro($sql);
			$incidencias = $objincidencia->mostrar_incidencias("incidencias.*",$sql);

			if (count($incidencias) > 0){
				foreach ($incidencias as $row) {
					$emp = explode("--", $row['nombreEmp']);

	                if(!isset($emp[0])){
	                    $emp[0] = '';
	                }

	                if(!isset($emp[1])){
	                    $emp[1] = '';
	                }

	                if(!isset($emp[2])){
	                    $emp[2] = '';
	                }
					?>
					<tr id="<?php echo $row['idIncidencia']; ?>">
			    		<td><?php echo $row['folio']; ?></td>
			    		<!---<td><?php echo $row['nombreEmpresa']; ?></td>--->
			    		<td><?php echo str_replace('--',' ',$row['nombreResponsable']); ?></td>
			    		<td><?php echo $row['nombreUbicacion']; ?></td>
			    		<td><?php echo $emp[0]; ?></td>
			    		<td><?php echo $emp[1]; ?></td>
			    		<td><?php echo $emp[2]; ?></td>
			    		<td><?php echo $row['nombrePuesto']; ?></td>
			    		<td><?php echo $row['tipoIncidencia']; ?></td>
			    		<td><?php echo $row['fechaInicio']; ?></td>
			    		<!--<td><?php echo $row['fechaFin']; ?></td>-->
			    		<?php
                        $checked = "";
                        if($row['estatus'] == 1){
                            $checked = "checked";
                        }
                        ?>
			    		<td>
                            <label class="switch">
                                <input class="switch-input" type="checkbox" id="chck-<?php echo $row['idIncidencia']; ?>" <?php echo $checked; ?> value="<?php echo $row['estatus']; ?>" onchange="cambiar_estadoincidencia(this.id,this.value);"/>
                                <span class="switch-label" data-on="On" data-off="Off"></span> <span class="switch-handle"></span>
                            </label>
                        </td>
                        <td><a aria-hidden="true" title="Ver" onclick="goto('ver&id=<?php echo $row["idIncidencia"]; ?>','reportes')"><i class="fa fa-eye"></i></a></td>
			    	</tr>			
					<?php
				}
			}

		break;
		case 'cambiar_estatus':
			$actualizar= $objincidencia->actualizarincidencia(array('estatus'=>$_POST['estatus']),$_POST['idIncidencia']);
		break;
		default:
			header('');
		break;
	}
}else{
	header('Location: ../view.php?mod=notfound');
}
?>