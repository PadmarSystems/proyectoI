<?php
require('clases/incidencia.class.php');
$incidencia = new incidencia;
$tipos = $incidencia->mostrar_tipo_incidencias();
?>
<script type="text/javascript">
	$(function() {
		$('.listado tbody').on( 'click', 'i.fa-trash-o', function () {
			var str = 'tiposincidencias/controlador.php';
			var params = {a: 'eliminar',id: $(this).parents('tr').attr("id")};
			send_ajax_form(str,params);

		    $(".listado").DataTable()
		        .row( $(this).parents('tr') )
		        .remove()
		        .draw();
		} );
	});
</script>
<h1>Tipos de Incidencias</h1>
<ul class="submenu">
    <li><a href="view.php?com=tiposincidencias&mod=form&ac=nuevo"><i class="fa fa-plus"></i>Nuevo Tipo de incidencia</a></li>
</ul>
<div>
	<table class='listado'>
		<thead>
			<tr>
				<th>Tipo de incidencia</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (count($tipos) > 0) {
				foreach ($tipos as $row) {
			?>
			<tr id="<?php echo $row['idTipo']; ?>">
	    		<td><?php echo $row['tipoIncidencia']; ?></td>
	    		<td class="actions">
	    			<a title="Editar" onclick="goto('form&ac=editar&id=<?php echo $row["idTipo"]; ?>','tiposincidencias')"><i class="fa fa-pencil-square-o"></i></a>
	    			<a title="Eliminar"><i class="fa fa-trash-o"></i></a>
	    		</td>
	    	</tr>
			<?php } } ?>
		</tbody>
	</table>
</div>
