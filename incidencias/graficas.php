<?php
require('clases/empleado.class.php');
$empleado = new empleado;
require('clases/incidencia.class.php');
$incidencia = new incidencia;
$empleados = $empleado->mostrar_empleados();
$tiposincidencias = $incidencia->mostrar_tipo_incidencias();
?>
<script type="text/javascript" src="<?php echo $ruta; ?>incidencias/incidencias.js"></script>
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
	.sel {
		width:200px;
	}
</style>
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="incidencias/graficas.js"></script>
<h2>Graficador de Incidencias</h2>
	<div>
		<div>
			<label>Tipo de gráfica: </label>
			<div class="ui-widget">
			<select class="sel" id="tipograf" readonly onchange="showSelect($(this).val());">
				<option value="">---</option>
					<option value="1">Incidencias por mes</option>
					<option value="2">Tipo de incidencias</option> <!----CAMBIAR NOMBRE ---->
			</select>
			</div>
		</div>
		<div>
			<label>Empleado: </label>
			<div class="ui-widget">
			<select class="sel" id="empleado" readonly>
				<option value="">---</option>
				<?php foreach ($empleados as $empleado) { ?>
					<option value="<?php echo $empleado['idEmpleado']; ?>"><?php echo str_replace('--',' ',$empleado['nombreEmp']); ?></option>
				<?php } ?>
			</select>
			</div>
		</div>
		<div id="mes" style="display:none">
			<label>Mes: </label> <!---- revisar el año ----->
			<div class="ui-widget">
			<select class="sel" id="selectMes" readonly>
				<option value="">---</option>
				<option value="01">Enero</option>
				<option value="02">Febrero</option>
				<option value="03">Marzo</option>
				<option value="04">Abril</option>
				<option value="05">Mayo</option>
				<option value="06">Junio</option>
				<option value="07">Julio</option>
				<option value="08">Agosto</option>
				<option value="09">Septiembre</option>
				<option value="10">Octubre</option>
				<option value="11">Noviembre</option>
				<option value="12">Diciembre</option>
			</select>
			</div>
		</div>
		<div id="incidencia" style="display:none">
			<label>Incidencia: </label>
			<div class="ui-widget">
			<select class="sel" id="selIncidencia" readonly>
				<option value="">---</option>
				<?php
				foreach ($tiposincidencias as $tipos){
					echo '<option value="'.$tipos['idTipo'].'">'.$tipos['tipoIncidencia'].'</option>';
				}?>
			</select>
			</div>
		</div><br/>
		<input type="hidden" id="idEmp" value="<?php echo $_SESSION['idEmpresa']; ?>"/>
		<div><button onclick="loadGraph();">Cargar gráfica</button></div>
	</div><br/>
	<div align="center">
		<div id="grafica" style="min-width: 300px; min-height: 400px; width: 1150px; height: 450px"></div>
	</div>