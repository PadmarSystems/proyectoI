<?php
require('clases/ubicacion.class.php');
$ubicacion = new ubicacion;
$where = "WHERE idEmpresa= " . $_SESSION['idEmpresa'] . " ";
$ubicaciones = $ubicacion->mostrar_ubicaciones('*',$where);
?>
<script type="text/javascript">
	$(function() {
		$('.listado tbody').on( 'click', '.fa-trash-o', function () {
			var str = 'ubicaciones/controlador.php';
			var params = {a: 'eliminar',id: $(this).parents('tr').attr("id")};
			send_ajax_form(str,params);

		    $(".listado").DataTable()
		        .row( $(this).parents('tr') )
		        .remove()
		        .draw();
		} );
	});
</script>
<h1>Ubicaciones</h1>
<ul class="submenu">
    <li><a href="view.php?com=ubicaciones&mod=form&ac=nuevo"><i class="fa fa-plus"></i>Nueva Ubicación</a></li>
</ul>
<div>
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
	    		<td class="actions">
	    			<a title="Editar" onclick="goto('form&ac=editar&id=<?php echo $row["idUbicacion"]; ?>','ubicaciones')"><i class="fa fa-pencil-square-o"></i></a>
	    			<a title="Eliminar"><i class="fa fa-trash-o"></i></a>
	    		</td>
	    	</tr>
			<?php } } ?>
		</tbody>
	</table>
</div>
