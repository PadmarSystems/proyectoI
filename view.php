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

if($_SESSION['logged'] == TRUE){
require("ruta.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Bienvenido <?php echo $_SESSION['nombre']; ?></title>
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
			<li><a title="Inicio" onclick="goto();">Inicio</a></li>
            <li><a title="Salir" href="logout.php">Salir del sistema</a></li>
		</ul>
	</nav>
    <div>
		<?php include($carpeta.$contenido.".php"); ?>
    </div>
</body>
</html>
<?php }else{
    header('Location: index.php');
    exit;
} ?>