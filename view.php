<?php
session_start();

if (isset($_POST) && !isset($_SESSION['logged'])) {
    require('clases/usuario.class.php');
    $usuario = new usuario;

    $user = htmlspecialchars($_POST['myusername']);
    $pass = htmlspecialchars($_POST['mypassword']);

    $row = $usuario->loginusuario($user, $pass);

    if (count($row) > 1) {
        $horaActual = date("H:i:s");
        $_SESSION['idUsuario']=$row['idUsuario'];
        $_SESSION['nombre'] = $row['nombreUsuario'];
        $_SESSION['idEmpresa'] = $row['idEmpresa'];
        $_SESSION['empresa'] = $row['aliasEmpresa'];
        $_SESSION['logged'] = TRUE;
        $_SESSION['caducidad'] = date('H:i:s', strtotime($horaActual) + 600);

    }else{
        header('Location: index.php?stt=error');
        exit;
    }
}
unset($_POST);
if($_SESSION['logged'] == TRUE){
require("ruta.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Bienvenido <?php echo $_SESSION['nombre']; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="<?php echo $ruta; ?>js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>js/jquery-ui.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>js/funciones.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>js/combobox.js"></script>
<script type="text/javascript">
    $(function() {
        if($('.listado').length) {
            $('.listado').each(function(i,e) {
                if(!$(this).hasClass("destroy")) {
                    $(".listado").dataTable({
                        "dom": '<lf>rt<ip>',
                        stateSave: true,
                        aLengthMenu: [
                            [25, 10, 50, 100, -1],
                            [25, 10, 50, 100, "Todo"]
                        ],
                        "bSort": true,
                        "language": {
                            "emptyTable": "No hay datos disponibles en la tabla.",
                            "info": "Se muestran de _START_ a _END_ de _TOTAL_",
                            "infoEmpty": "Se muestran de 0 a 0 de 0",
                            "infoFiltered": "(filtrado de _MAX_ totales)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "No se encontraron resultados.",
                            "paginate": {
                                "first": "Primera",
                                "last": "Última",
                                "next": "Sig.",
                                "previous": "Ant."
                            },
                            "aria": {
                                "sortAscending":  ": activar para ordenar ascendente",
                                "sortDescending": ": activar para ordenar descendente"
                            }
                        },
                        "pagingType": "full_numbers"
                    });
                    //$('.dataTables_filter label').after('<button class="print" onclick="imprimir()">Imprimir</button>');
                }
            });
        }
    });
</script>
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
}?>
<body>
    <nav>
        <a class="btn-menu" id="mainmenu"><i class="fa fa-bars"></i></a>
        <a class="logo" onclick="goto()"><img src="images/logo2.png" alt="Logotipo" /></a>
        <div class="navbar">
            <a class="btn-menu"><i class="fa fa-ellipsis-v"></i></a>
            <ul>
                <li><a onclick="goto('configurar','configuracion')"><i class="fa fa-sliders"></i>Configuración</a></li>
                <li><a href="logout.php"><i class="fa fa-sign-out"></i>Cerrar Sesión</a></li>
            </ul>
        </div>
    </nav>
    <section class="sidebar">
        <ul>
            <li><span>Menu Principal</span></li>
            <li><a onclick="goto()"><i class="fa fa-dashboard"></i>Dashboard</a></li>
            <li><a onclick="goto('listar','empleados');"><i class="fa fa-users"></i>Empleados</a></li>
            <li><span>Incidencias</span></li>
            <li><a onclick="goto('seguimiento','incidencias')"><i class="fa fa-plus"></i>Registrar</a></li>
            <li><a onclick="goto('lista_incidencias','reportes')"><i class="fa fa-file-text"></i>Reportes</a></li>
        </ul>
    </section>
    <section class="layout-content">
        <?php include($carpeta.$contenido.".php"); ?>
    </section>
</body>
</html>
<?php } else {
    header('Location: index.php');
    exit;

} ?>
