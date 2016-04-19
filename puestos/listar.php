<?php
require('clases/puesto.class.php');
$puesto = new puesto;


$where = "WHERE puestos.idEmpresa= " . $_SESSION['idEmpresa'] . " ";
$puestos = $puesto->mostrar_puestos('puestos.*,nombreEmpresa',$where);

?>
<h2>Puestos </h2>
<table class='listado'>
	<thead>
		<tr>
			<th>Puesto</th>
			<th>Fecha de Registro</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (count($puestos) > 0) {
			foreach ($puestos as $row) {
		?>
		<tr id="<?php echo $row['idPuesto']; ?>">
    		<td><?php echo $row['nombrePuesto']; ?></td>
    		<td><?php echo $row['fechaCreacion']; ?></td>
    		<td><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar" style="cursor:pointer" onclick="goto('form&ac=editar&id=<?php echo $row["idPuesto"]; ?>','puestos')"></i></td>
    	</tr>
		<?php } } ?>
	</tbody>
</table>