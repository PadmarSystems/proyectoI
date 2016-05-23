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
<script type="text/javascript">
    $(function() {
        $( "#empresa, #tipoIn, #puesto, #responsable, #ubicacion" ).combobox();
        $('.custom-combobox-input').attr("placeholder", "Seleccione");

        $('#clicky').click(function() {
            $('.ui-autocomplete-input').focus().val('');
            $('.ui-autocomplete-input').autocomplete('close');
            filtrar_incidencias(<?php echo $_SESSION['idEmpresa']; ?>);
            return false;
        });
    });
</script>
<h1>Reportes de incidencias</h1>
<div class="group">
    <div class="row ui-widget">
		<label class="col-md-2">Empresa:</label>
        <div class="col-md-4">
            <select id="empresa" name="empresa">
                <option value="" >Select one...</option>
                <?php foreach ($empresas as $empresa) { ?>
                <option value="<?php echo $empresa['idEmpresa']; ?>"><?php echo $empresa['aliasEmpresa']; ?></option>
                <?php } ?>
            </select>
        </div>
        <label class="col-md-2">Ubicación:</label>
        <div class="col-md-4">
            <select id="ubicacion" name="ubicacion" >
                <option value="">Select one...</option>
                <?php foreach ($ubicaciones as $ubicacion) { ?>
                <option value="<?php echo $ubicacion['idUbicacion']; ?>"><?php echo $ubicacion['nombreUbicacion']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row ui-widget">
        <label class="col-md-2">Responsable:</label>
        <div class="col-md-4">
            <select id="responsable" name="responsable">
                <option value="">Select one...</option>
                <?php foreach ($responsables as $responsable) { ?>
                <option value="<?php echo $responsable['idResponsable']; ?>"><?php echo str_replace('--',' ',$responsable['nombreResponsable']); ?></option>
                <?php } ?>
            </select>
        </div>
        <label class="col-md-2">Puesto:</label>
        <div class="col-md-4">
            <select id="puesto" name="puesto">
                <option value="">Select one...</option>
                <?php foreach ($puestos as $puesto) { ?>
                <option value="<?php echo $puesto['idPuesto']; ?>"><?php echo $puesto['nombrePuesto']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="row ui-widget">
        <label class="col-md-2">Tipo de incidencias:</label>
        <div class="col-md-4">
            <select id="tipoIn" name="tipoIn">
                <option value="">Select one...</option>
                <?php foreach ($tiposincidencias as $tipoin) { ?>
                <option value="<?php echo $tipoin['idTipo']; ?>"><?php echo $tipoin['tipoIncidencia']; ?></option>
                <?php } ?>
            </select>
        </div>
        <label class="col-md-2">Fecha:</label>
        <div class="col-md-2"><input type="date" name="fechai" id="fechai"></div>
        <div class="col-md-2"><input type="date" name="fechaf" id="fechaf"></div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-2">
			<button class="button" onclick="filtrar_incidencias(empresa.value,ubicacion.value,responsable.value,puesto.value,tipoIn.value,fechai.value,fechaf.value)"><i class="fa fa-check"></i> Filtrar</button>
			<!---<button class="button" onclick="filtrar_incidencias(ubicacion.value,responsable.value,puesto.value,tipoIn.value,fechai.value,fechaf.value)"><i class="fa fa-check"></i> Filtrar</button>--->
            <a href="#" id="clicky">Limpiar filtros</a>
        </div>
    </div>
</div>

<div style="margin-top:15px;">
    <table class='listado'>
        <thead>
            <tr class='head'>
                <th>Folio</th>
                <!--<th>Empresa</th>-->
                <th>Responsable</th>
                <th>Ubicación</th>
                <th>Nombre Empleado</th>
                <th>A. Paterno Empleado</th>
                <th>A. Materno Empleado</th>
                <th>Puesto</th>
                <th>Tipo de incidencia</th>
                <th>Fecha de inicio</th>
                <!--<th>Fecha final</th>-->
                <th></th>
                <th></th>
            </tr>
        </thead>
        <h3 style="text-align:center;background:#ccc;font-weight:normal;padding:5px;margin-bottom:20px;">nombre de la empresa</h3>
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
            <?php }} ?>
        </tbody>
    </table>
</div>
