<?php
/*
SCRIPT para cambios a la BD (No debe permanecer en produccion una vez utilizado)
*/
require_once 'clases/config.gral.php';
if(!isset($conexSM)) $conexSM = new SafeMySQL();
$actualiza = filter_input(INPUT_GET, 'a');
$tiempoInicio = microtime(true);

if($actualiza == 1){
	//agrega campo para descripcion corta de sucursal
	$sql = "ALTER TABLE `usuario` CHANGE `contraseña` `contrasena` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `empleado` ADD `contactoAccidente` VARCHAR(255) NULL AFTER`idPuesto`, ADD `numeroAccidente` VARCHAR(20) NULL AFTER `contactoAccidente`, ADD `fotoEmp` VARCHAR(300) NULL AFTER `numeroAccidente`";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `empleado` ADD `tipoNomina` INT(2) NOT NULL AFTER `emailEmp`";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `empresa` CHANGE `fechaCreacion` `fechaCreacion` TIMESTAMP NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `empresa` CHANGE `fechaActualizacion` `fechaActualizacion` TIMESTAMP NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `usuario` CHANGE `fechaCreacion` `fechaCreacion` TIMESTAMP NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `usuario` CHANGE `fechaActualizacion` `fechaActualizacion` TIMESTAMP NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `empleado` CHANGE `fechaCreacion` `fechaCreacion` TIMESTAMP NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `usuario` CHANGE `contraseña` `contrasena` VARCHAR(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';
}

if ($actualiza == 2) {
	$sql = "RENAME TABLE empleado TO empleados";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "RENAME TABLE empresa TO empresas";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "RENAME TABLE puesto TO puestos";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "RENAME TABLE responsable TO responsables";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "RENAME TABLE ubicacion TO ubicaciones";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "RENAME TABLE usuario TO usuarios";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';
}

if ($actualiza == 3) {
	$sql = "ALTER TABLE `puestos` CHANGE `fechaCreacion` `fechaCreacion` TIMESTAMP NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `puestos` CHANGE `fechaActualizacion` `fechaActualizacion` TIMESTAMP NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `responsables` CHANGE `fechaCreacion` `fechaCreacion` TIMESTAMP NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `responsables` CHANGE `fechaActualizacion` `fechaActualizacion` TIMESTAMP NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `ubicaciones` CHANGE `fechaCreacion` `fechaCreacion` TIMESTAMP NULL DEFAULT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';

	$sql = "ALTER TABLE `ubicaciones` CHANGE `fechaActualizacion` `fechaActualizacion` TIMESTAMP NOT NULL";
	$result = $conexSM->query($sql);
	if($result) echo 'Query ejecutado correctamente';
}

$tiempoFinal = microtime(true);
echo '<h2>Tiempo de ejecucion = ' . round(($tiempoFinal - $tiempoInicio), 4) . ' seg.</h2> Fecha: ' . date('Y-m-d H:i:s');
?>