<?php
$msg = "Favor de ingresar sus datos";
$stt = "";
session_start();
if(isset($_SESSION['logged'])){
	header('Location: view.php?');
	exit;
}

if (isset($_GET['stt'])) {
	$stt = $_GET['stt'];
	if ($stt == "error") {
		$msg = "Compruebe que los datos introducidos sean correctos";
	}

	if ($stt == "ended") {
		$msg="Sesión finalizada. Hasta pronto";
	}
}
require("ruta.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>SRin</title>
<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/font-awesome.css" />
<script type="text/javascript" src="<?php echo $ruta; ?>js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>js/jquery-ui.min.js"></script>
</head>
<body>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 logoLogin"><img src="images/logo.png" /></div>
		<form action="view.php" method="post" class="col-md-4 col-md-offset-4 login">
	        <div class="message">
				<h4>Iniciar Sesión</h4>
				<p><?php echo $msg; ?></p>
			</div>
	        <div class="inputs"><i class="fa fa-user"></i><input type="text" placeholder="Usuario" value="" autofocus id="myusername" name="myusername" required/></div>
	    	<div class="inputs"><i class="fa fa-lock"></i><input type="password" placeholder="Contraseña" value="" id="mypassword" name="mypassword" required/></div>
	        <input type="submit" value="Iniciar Sesión" />
	    </form>
	</div>
</body>
</html>
