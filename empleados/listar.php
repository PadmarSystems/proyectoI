<?php
require('clases/empleado.class.php');
$objemp = new empleado;

$empleados = $objemp->mostrar_empleados();
?>
<script type="text/javascript">
	$(function() {
		$('.listado tbody').on( 'click', 'i.fa-trash-o', function () {
			var str = 'empleados/controlador.php';
			var params = {a: 'eliminar',id: $(this).parents('tr').attr("id")};
			send_ajax_form(str,params);

		    $(".listado").DataTable()
		        .row( $(this).parents('tr') )
		        .remove()
		        .draw();
		} );
	});
</script>
<h1>Empleados </h1>
<br>
<table class='listado'>
	<thead>
		<tr>
			<th>Nombre Empleado</th>
			<th>A. Paterno Empleado</th>
			<th>A. Materno Empleado</th>
			<th>Empresa</th>
			<th>Puesto</th>
			<th>Telefono</th>
			<th>Tipo de nomina</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (count($empleados) > 0) {
			foreach ($empleados as $row) {
				$emp = explode("--", $row['nombreEmp']);

                if(!isset($emp[0])){
                    $emp[0] = '';
                }

                if(!isset($emp[1])){
                    $emp[1] = '';
                }

                if(!isset($emp[2])){
                    $emp[2] = '';
                }
		?>
		<tr id="<?php echo $row['idEmpleado']; ?>">
    		<td><?php echo $emp[0]; ?></td>
    		<td><?php echo $emp[1]; ?></td>
    		<td><?php echo $emp[2]; ?></td>
    		<td><?php echo $row['nombreEmpresa']; ?></td>
    		<td><?php echo $row['nombrePuesto']; ?></td>
    		<td><?php echo $row['telEmp']; ?></td>
    		<td><?php echo $row['tipoNomina']; ?></td>
    		<td class="actions">
				<a aria-hidden="true" title="Editar" onclick="goto('form&ac=editar&id=<?php echo $row["idEmpleado"]; ?>','empleados')"><i class="fa fa-pencil-square-o"></i></a>
				<a aria-hidden="true" title="Eliminar"><i class="fa fa-trash-o"></i></a>
    		</td>
    	</tr>
		<?php } } ?>
	</tbody>
</table>
