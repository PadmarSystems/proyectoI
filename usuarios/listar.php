<?php
require('clases/usuario.class.php');
$usuario = new usuario;
$where = "WHERE idEmpresa= " . $_SESSION['idEmpresa'];
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
<h1>Usuarios</h1>
<ul class="submenu">
    <li><a href="view.php?com=usuarios&mod=form&ac=nuevo"><i class="fa fa-plus"></i>Nuevo Usuario</a></li>
</ul>
<div>
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
	    		<td class="actions">
	    			<a title="Editar" onclick="goto('form&ac=editar&id=<?php echo $row["idUsuario"]; ?>','usuarios')"><i class="fa fa-pencil-square-o"></i></a>
	    			<a title="Eliminar"><i class="fa fa-trash-o"></i></a>
	    		</td>
	    	</tr>
			<?php } } ?>
		</tbody>
	</table>
</div>
