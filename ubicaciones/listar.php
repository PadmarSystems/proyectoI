<?php
require('clases/ubicacion.class.php');
$ubicacion = new ubicacion;
$where = "WHERE idEmpresa= " . $_SESSION['idEmpresa'] . " ";
$ubicaciones = $ubicacion->mostrar_ubicaciones('*',$where);
?>
<h2>Ubicaciones </h2>
<br>
<table class='listado'>
	<thead>
		<tr>
			<th>Ubicación</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (count($ubicaciones) > 0) {
			foreach ($ubicaciones as $row) {
		?>
		<tr id="<?php echo $row['idUbicacion']; ?>">
    		<td><?php echo $row['nombreUbicacion']; ?></td>
    		<td><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar" style="cursor:pointer" onclick="goto('form&ac=editar&id=<?php echo $row["idUbicacion"]; ?>','ubicaciones')"></i></td>
    	</tr>
		<?php } } ?>
	</tbody>
</table>