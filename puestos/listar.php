<?php
require('clases/puesto.class.php');
$puesto = new puesto;


$where = "WHERE puestos.idEmpresa= " . $_SESSION['idEmpresa'] . " ";
$puestos = $puesto->mostrar_puestos('puestos.*,nombreEmpresa',$where);

?> 
<script type="text/javascript">
	$(function() {
		$('.listado tbody').on( 'click', 'i.fa-trash-o', function () {
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
    		<td>
    			<i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar" style="cursor:pointer" onclick="goto('form&ac=editar&id=<?php echo $row["idPuesto"]; ?>','puestos')"></i>
    			&nbsp &nbsp <i class="fa fa-trash-o" aria-hidden="true" title="Eliminar" style="cursor:pointer"></i>
    		</td>
    	</tr>
		<?php } } ?>
	</tbody>
</table>