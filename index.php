<?php
$msg = "Favor de ingresar sus datos";
$stt = "";

if(isset($_SESSION)){
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
<title>Login</title>
</head>
<body>
    <form action="view.php" method="post">
        <p><?php echo $msg; ?></p>
        <div><span><i class="fa fa-user"></i></span><input type="text" placeholder="Usuario" value="" autofocus id="myusername" name="myusername" required/></div>
    	<div><span><i class="fa fa-lock"></i></span><input type="password" placeholder="Contraseña" value="" id="mypassword" name="mypassword" required/></div>
        <input type="submit" value="Iniciar Sesión" />
    </form>
</body>
</html>