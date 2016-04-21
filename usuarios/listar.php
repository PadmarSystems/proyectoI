<?php
require('clases/usuario.class.php');
$usuario = new usuario;
$where = "WHERE idEmpresa= " . $_SESSION['idEmpresa'] . " ";
$usuarios = $usuario->mostrar_usuarios('*',$where);
?>
<script type="text/javascript">
	$(function() {
		$('.listado tbody').on( 'click', 'i.fa-trash-o', function () {
			var str = 'usuarios/controlador.php';
			var params = {a: 'eliminar',id: $(this).parents('tr').attr("id")};
			send_ajax_form(str,params);
			
		    $(".listado").DataTable()
		        .row( $(this).parents('tr') )
		        .remove()
		        .draw();
		} );
	});
</script>
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
    		<td>
    			<i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar" style="cursor:pointer" onclick="goto('form&ac=editar&id=<?php echo $row["idUsuario"]; ?>','usuarios')"></i>
    			&nbsp &nbsp <i class="fa fa-trash-o" aria-hidden="true" title="Eliminar" style="cursor:pointer"></i>
    		</td>
    	</tr>
		<?php } } ?>
	</tbody>
</table>