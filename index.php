<?php
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
        <p>Favor de ingresar sus datos</p>
        <div><span><i class="fa fa-user"></i></span><input type="text" placeholder="Usuario" value="" autofocus id="myusername" name="myusername" /></div>
    	<div><span><i class="fa fa-lock"></i></span><input type="password" placeholder="Contraseña" value="" id="mypassword" name="mypassword" /></div>
        <input type="submit" value="Iniciar Sesión" />
    </form>
</body>
</html>
