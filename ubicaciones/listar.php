<?php
require('clases/ubicacion.class.php');
$ubicacion = new ubicacion;
$where = "WHERE idEmpresa= " . $_SESSION['idEmpresa'] . " ";
$ubicaciones = $ubicacion->mostrar_ubicaciones('*',$where);
?>
<script type="text/javascript">
	$(function() {
		$('.listado tbody').on( 'click', 'i.fa-trash-o', function () {
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
    		<td>
    			<i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar" style="cursor:pointer" onclick="goto('form&ac=editar&id=<?php echo $row["idUbicacion"]; ?>','ubicaciones')"></i>
    			&nbsp &nbsp <i class="fa fa-trash-o" aria-hidden="true" title="Eliminar" style="cursor:pointer"></i>
    		</td>
    	</tr>
		<?php } } ?>
	</tbody>
</table>