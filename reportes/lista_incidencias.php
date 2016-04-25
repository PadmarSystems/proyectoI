<?php
require('clases/incidencia.class.php');
$incidencia = new incidencia;


require('clases/empleado.class.php');
$empleado = new empleado;

$responsables = $empleado->mostrar_responsables();
$ubicaciones = $empleado->mostrar_ubicaciones();
$puestos = $empleado->mostrar_puestos();
$tiposincidencias = $incidencia->mostrar_tipo_incidencias();
$empresas = $incidencia->mostrar_empresas();

$where = "";

if(isset($_GET['a'])){
    if($_GET['a'] == 1){
        $where = " WHERE incidencias.idEmpleado=".$_GET['idEmpleado']." ORDER BY fechaInicio DESC LIMIT 1";
    }

    if($_GET['a'] == 2){
        $where = " WHERE incidencias.idEmpleado=".$_GET['idEmpleado']. " AND MONTH(fechaInicio)=".date("m")." ORDER BY fechaInicio DESC";
    }

    if($_GET['a'] == 3){
        $where = " WHERE incidencias.idEmpleado=".$_GET['idEmpleado']." ORDER BY fechaInicio DESC";
    }
}

$incidencias = $incidencia->mostrar_incidencias("incidencias.*",$where);
?>
<script type="text/javascript" src="<?php echo $ruta; ?>reportes/reporte.js"></script>
<style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
  }
</style>
<script>
  $(function() {  
    $( "#empresa, #tipoIn, #puesto, #responsable, #ubicacion" ).combobox();

    
  });
</script>
<h1>Reportes de incidencias</h1>
<div class="ui-widget">
    <label>Empresa: </label>
    <select id="empresa" name="empresa">
        <option value="">Select one...</option>
        <?php   foreach ($empresas as $empresa) {
        ?>
            <option value="<?php echo $empresa['idEmpresa']; ?>"><?php echo $empresa['aliasEmpresa']; ?></option>
        <?php   }   ?>
    </select>
</div>
<div class="ui-widget">
    <label>Ubicación: </label>
    <select id="ubicacion" name="ubicacion" >
        <option value="">Select one...</option>
        <?php   foreach ($ubicaciones as $ubicacion) {
        ?>
            <option value="<?php echo $ubicacion['idUbicacion']; ?>"><?php echo $ubicacion['nombreUbicacion']; ?></option>
        <?php   }   ?>
    </select>
</div>
<div class="ui-widget">
<label>Responsable: </label>
    <select id="responsable" name="responsable">
        <option value="">Select one...</option>
        <?php   foreach ($responsables as $responsable) {
        ?>
            <option value="<?php echo $responsable['idResponsable']; ?>"><?php echo str_replace('--',' ',$responsable['nombreResponsable']); ?></option>
        <?php   }   ?>
    </select>
</div>
<div class="ui-widget">
    <label>Puesto: </label>
    <select id="puesto" name="puesto">
        <option value="">Select one...</option>
        <?php   foreach ($puestos as $puesto) {
        ?>
            <option value="<?php echo $puesto['idPuesto']; ?>"><?php echo $puesto['nombrePuesto']; ?></option>
        <?php   }   ?>
    </select>
</div>
<div class="ui-widget">
    <label>Tipo de incidencias: </label>
    <select id="tipoIn" name="tipoIn">
        <option value="">Select one...</option>
        <?php   foreach ($tiposincidencias as $tipoin) {
        ?>
            <option value="<?php echo $tipoin['idTipo']; ?>"><?php echo $tipoin['tipoIncidencia']; ?></option>
        <?php   }   ?>
    </select>
</div>
<div class="ui-widget">
    <label>Fecha: </label>
    <input type="date" name="fechai" id="fechai"> - 
    <input type="date" name="fechaf" id="fechaf">
</div>
<input type="button" value="Filtrar" onclick="filtrar_incidencias(empresa.value,ubicacion.value,responsable.value,puesto.value,tipoIn.value,fechai.value,fechaf.value)" class="icon-check">
<br>
<table class='listado'>
	<thead>
		<tr class='head'>
			<th>Folio</th>
			<th>Empresa</th>
			<th>Responsable</th>
			<th>Ubicación</th>
			<th>Nombre Empleado</th>
			<th>A. Paterno Empleado</th>
			<th>A. Materno Empleado</th>
			<th>Puesto</th>
			<th>Tipo de incidencia</th>
			<th>Fecha de inicio</th>
			<th>Fecha final</th>
		</tr>
	</thead>
	<tbody id="tabla">
		<?php
       	if (count($incidencias) > 0) {
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
    		<td><?php echo $row['nombreEmpresa']; ?></td>
    		<td><?php echo $row['nombreResponsable']; ?></td>
    		<td><?php echo $row['nombreUbicacion']; ?></td>
    		<td><?php echo $emp[0]; ?></td>
    		<td><?php echo $emp[1]; ?></td>
    		<td><?php echo $emp[2]; ?></td>
    		<td><?php echo $row['nombrePuesto']; ?></td>
    		<td><?php echo $row['tipoIncidencia']; ?></td>
    		<td><?php echo $row['fechaInicio']; ?></td>
    		<td><?php echo $row['fechaFin']; ?></td>
    	</tr>
    	<?php }} ?>
	</tbody>
</table>