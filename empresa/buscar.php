<?php
if (isset($_POST)) {
	$user = htmlspecialchars($_POST['myusername']);
    $pass = htmlspecialchars($_POST['mypassword']);

    echo "buscar";
}else{
	echo "No se encuentra la información solicitada";
}
?>