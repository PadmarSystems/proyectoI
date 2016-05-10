<?php
require("ruta.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title>Reggy.MX</title>
<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/style.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $ruta; ?>css/font-awesome.css" />
<script type="text/javascript" src="<?php echo $ruta; ?>js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="<?php echo $ruta; ?>js/jquery-ui.min.js"></script>
</head>
<body>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 logoLogin"><img src="images/logo.png" /></div>
		<form action="empresa/buscar.php" method="post" class="col-md-4 col-md-offset-4 login">
	        <div class="message">
				<h4>Registra una Empresa</h4>
			</div>
	        <div class="inputs"><i class="fa fa-building"></i><input type="text" placeholder="Empresa" value="" autofocus id="miempresa" name="miempresa" required/></div>
	    	<div class="inputs"><i class="fa fa-lock"></i><input type="password" placeholder="Contraseña" value="" id="mypassword" name="mypassword" required/></div>
	        <input type="submit" value="Buscar" />
	    </form>
	</div>
</body>
</html>
