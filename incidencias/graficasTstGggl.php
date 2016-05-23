<?php
require('clases/empleado.class.php');
require('clases/incidencia.class.php');
require('clases/responsable.class.php');
require('clases/ubicacion.class.php');
$empleado = new empleado;
$incidencia = new incidencia;
$responsbale = new responsable;
$ubicacion = new ubicacion;
$empleados = $empleado->mostrar_empleados();
$tiposincidencias = $incidencia->mostrar_tipo_incidencias();
$responsables = $responsbale -> verResponsables($_SESSION['idEmpresa']);
$ubicaciones = $ubicacion->getUbicacionesxEmp($_SESSION['idEmpresa']);
	$x = date_default_timezone_get();
	date_default_timezone_get('America/Mexico City');
$mes = date('n');
$fecha = date('Y-m-d');
?>
<style>
	.sel {
		width:250px;
	}
</style>
<script src="incidencias/loader.js"></script>
<script src="incidencias/incidenciasTstGggl.js"></script>
<h2>Graficador de Incidencias</h2>
	<div>
		<div>
			<label>Tipo de gráfica</label>
			<div class="ui-widget">
			<select class="sel" id="tipograf" readonly onchange="showSelect($(this).val());">
				<option value="">---</option>
					<option value="1">Total de incidencias</option>
					<option value="2">Incidencias mensuales (por empleado)</option>
					<option value="3">Incidencias mensuales (todos los empleados)</option>
					<option value="4">Incidencias del año actual</option>
					<option value="5">Por Supervisor</option>
					<option value="6">Por Ubicación</option>
			</select>
				<!---<div>
					<button value="1" onclick="chgnVal($(this).val());">Total de incidencias</button>
					<button value="2" onclick="chgnVal($(this).val());">Incidencias mensuales (por empleado)</button>
					<button value="3" onclick="chgnVal($(this).val());">Incidencias mensuales (todos los empleados)</button>
					<button value="4" onclick="chgnVal($(this).val());">Incidencias del año actual</button>
					<button value="5" onclick="chgnVal($(this).val());">Por supervisor</button>
					<button value="6" onclick="chgnVal($(this).val());">Por ubicación</button>
					<input type="hidden" id="boton" value=""/>
				</div>--->
			</div>
		</div>
		<div id="responsables" style="display:none">
			<label>Supervisor: </label>
			<div class="ui-widget">
			<select class="sel" id="selResponsable" readonly>
				<option value="">---</option>
				<?php foreach ($responsables as $resp) {
					echo '<option value="'.$resp['idResponsable'].'">'.$resp['nombreResponsable'].'</option>';
				}?>
			</select>
			</div>
		</div>
		<div id="ubicaciones" style="display:none">
			<label>Ubicación: </label>
			<div class="ui-widget">
			<select class="sel" id="selUbicacion" readonly>
				<option value="">---</option>
				<?php foreach ($ubicaciones as $resp) {
					echo '<option value="'.$resp['idUbicacion'].'">'.$resp['nombreUbicacion'].'</option>';
				}?>
			</select>
			</div>
		</div>
		<div id="empleado" style="display:none">
			<label>Empleado: </label>
			<div class="ui-widget">
			<select class="sel" id="selEmpleado" readonly>
				<option value="">---</option>
				<?php foreach ($empleados as $empleado) { ?>
					<option value="<?php echo $empleado['idEmpleado']; ?>"><?php echo str_replace('--',' ',$empleado['nombreEmp']); ?></option>
				<?php } ?>
			</select>
			</div>
		</div>
		<div id="mes" style="display:none">
			<label>Mes: </label>
			<div class="ui-widget">
			<select class="sel" id="selectMes" readonly>
				<option value="">---</option>
				<option value="1" <?php if ($mes == 1){ echo "selected"; } ?>>Enero</option>
				<option value="2" <?php if ($mes == 2){ echo "selected"; } ?>>Febrero</option>
				<option value="3" <?php if ($mes == 3){ echo "selected"; } ?>>Marzo</option>
				<option value="4" <?php if ($mes == 4){ echo "selected"; } ?>>Abril</option>
				<option value="5" <?php if ($mes == 5){ echo "selected"; } ?>>Mayo</option>
				<option value="6" <?php if ($mes == 6){ echo "selected"; } ?>>Junio</option>
				<option value="7" <?php if ($mes == 7){ echo "selected"; } ?>>Julio</option>
				<option value="8" <?php if ($mes == 8){ echo "selected"; } ?>>Agosto</option>
				<option value="9" <?php if ($mes == 9){ echo "selected"; } ?>>Septiembre</option>
				<option value="10" <?php if ($mes == 10){ echo "selected"; } ?>>Octubre</option>
				<option value="11" <?php if ($mes == 11){ echo "selected"; } ?>>Noviembre</option>
				<option value="12" <?php if ($mes == 12){ echo "selected"; } ?>>Diciembre</option>
			</select>
			</div>
		</div>
		<div id="incidencia" style="display:none">
			<label>Incidencia: </label>
			<div class="ui-widget">
			<select class="sel" id="selIncidencia" readonly>
				<option value="">---</option>
				<?php foreach ($tiposincidencias as $tipos){
					echo '<option value="'.$tipos['idTipo'].'*3*'.$tipos['tipoIncidencia'].'">'.$tipos['tipoIncidencia'].'</option>';
				}?>
			</select>
			</div>
		</div><br/>
		<input type="hidden" id="idEmp" value="<?php echo $_SESSION['idEmpresa']; ?>"/>
		<div><button onclick="loadGraph();">Cargar gráfica</button></div>
	</div><br/>
	<div align="center">
		<div id="grafica" style="min-width: 300px; min-height: 400px;"></div>
		<div id="dialog-message"></div>
	</div>