<?php
/*if (isset($_POST)) {
    print_r($_POST);
}*/
require("ruta.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Bienvenido</title>
<script type="text/javascript" src="<?php echo $ruta; ?>js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>js/funciones.js"></script>
</head>
<?php
if (isset($_GET['mod'])) {
	$contenido=$_GET['mod'];
	if(isset($_GET['com'])) {
		$carpeta=$_GET['com']."/";
	}
} else {
	$contenido = 'portada';
	$carpeta = '';
}
?>
<body>
	<nav>
		<ul>
		    <li><a title="Empleados" onclick="goto('listar','empleados');">Ver empleados</a></li>
		    <li><a title="Incidencias" onclick="goto('','incidencias')">Nueva Incidencia</a></li>
		    <li><a title="Reportes" onclick="goto('','reportes')">Generar Reporte</a></li>
		    <li><a title="Configs" onclick="goto('index','configuracion')">Configuración</a></li>
		</ul>
	</nav>
    <div>
		<?php include($carpeta.$contenido.".php"); ?>
    </div>
</body>
</html>
