<?php
require('clases/puesto.class.php');
$puesto = new puesto;
$where = "WHERE puestos.idEmpresa= " . $_SESSION['idEmpresa'];
$puestos = $puesto->mostrar_puestos('puestos.*,nombreEmpresa',$where);
?>
<script type="text/javascript">
	$(function() {
		$('.listado tbody').on( 'click', '.fa-trash-o', function () {
			var str = 'puestos/controlador.php';
			var params = {a: 'eliminar',id: $(this).parents('tr').attr("id")};
			send_ajax_form(str,params);

		    $(".listado").DataTable()
		        .row( $(this).parents('tr') )
		        .remove()
		        .draw();
		} );
	});
</script>
<h2>Puestos</h2>
<ul class="submenu">
    <li><a href="view.php?com=puestos&mod=form&ac=nuevo"><i class="fa fa-plus"></i>Nuevo Puesto</a></li>
</ul>
<div>
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
	    		<td class="actions">
	    			<a title="Editar" onclick="goto('form&ac=editar&id=<?php echo $row["idPuesto"]; ?>','puestos')"><i class="fa fa-pencil-square-o"></i></a>
	    			<a title="Eliminar"><i class="fa fa-trash-o"></i></a>
	    		</td>
	    	</tr>
			<?php } } ?>
		</tbody>
	</table>
</div>
