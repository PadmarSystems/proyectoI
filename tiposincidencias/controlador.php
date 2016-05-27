<?php
require('../clases/incidencia.class.php');
$incidencia = new incidencia;
$stt="";
if(isset($_POST['a'])){
	$accion=$_POST['a'];
	switch ($accion){
		case 'Registrar':
			$array = array('tipoIncidencia'=>$_POST['tipo']);
			$inserta = $incidencia->insertartipo($array);
			if($inserta){
				$stt = "success";
			}else{
				$stt = "error";
			}	
			
			header('Location: ../view.php?com=tiposincidencias&mod=listar&stt='.$stt);
			break;
		case 'Editar':
			$array = array('tipoIncidencia'=>$_POST['tipo']);
			$actualiza = $incidencia->actualizartipo($array,$_POST['idTipo']);
			if($actualiza){
				$stt = "success";
			}else{
				$stt = "failed";
			}

			header('Location: ../view.php?com=tiposincidencias&mod=listar&stt='.$stt);
			break;
		case 'eliminar':
				$elimina = $incidencia->eliminartipo($_POST['id']);
			if($elimina){
				echo "eliminado";
			}else{
				echo "";
			}
			break;
		default:
			header('Location: ../view.php?com=tiposincidencias&mod=form&ac=nuevo&stt=error');
			break;
	}
}else{
	header('Location: ../view.php?mod=notfound');
}
?>