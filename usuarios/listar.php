<?php
require('clases/usuario.class.php');
$usuario = new usuario;
$where = "WHERE idEmpresa= " . $_SESSION['idEmpresa'] . " ";
$usuarios = $usuario->mostrar_usuarios('*',$where);
?>
<h2>Usuarios </h2>
<br>
<table class='listado'>
	<thead>
		<tr>
			<th>Nombre</th>
			<th>Usuario</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (count($usuarios) > 0) {
			foreach ($usuarios as $row) {
		?>
		<tr id="<?php echo $row['idUsuario']; ?>">
    		<td><?php echo $row['nombreUsuario']; ?></td>
    		<td><?php echo $row['email']; ?></td>
    		<td><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar" style="cursor:pointer" onclick="goto('form&ac=editar&id=<?php echo $row["idUsuario"]; ?>','usuarios')"></i></td>
    	</tr>
		<?php } } ?>
	</tbody>
</table>