<?php
require('../clases/usuario.class.php');
if (isset($_POST)) {
	print_r($_POST);
	$empresa = htmlspecialchars($_POST['miempresa']);
    $pass = htmlspecialchars($_POST['mypassword']);

    

    //verifico el nombre de la empresa

    echo "buscar";
}else{
	echo "No se encuentra la información solicitada";
}
?>