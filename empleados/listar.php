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
			<th>Tipo de nómina</th>
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
<<<<<<< HEAD
    		<td><?php echo $row['tipoNomina']; ?></td>
    		<td class="actions">
				<a aria-hidden="true" title="Editar" onclick="goto('form&ac=editar&id=<?php echo $row["idEmpleado"]; ?>','empleados')"><i class="fa fa-pencil-square-o"></i></a>
				<a aria-hidden="true" title="Eliminar"><i class="fa fa-trash-o"></i></a>
=======
    		<td><?php
    		switch($row['tipoNomina']){
				case 1:
    				echo "Semanal";
					break;
				case 2:
    				echo "Quincenal";
					break;
				case 3:
    				echo "Mensual";
					break;
				default:
					echo "No se especificó un tipo de nómina";
					break;
    		} 
    		//echo $row['tipoNomina']; ?></td>
    		<td><i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar" style="cursor:pointer" onclick="goto('form&ac=editar&id=<?php echo $row["idEmpleado"]; ?>','empleados')"></i> &nbsp &nbsp 
    			<i class="fa fa-trash-o" aria-hidden="true" title="Eliminar" style="cursor:pointer"></i>
>>>>>>> 141b4cbdc79a2bbee95135073c5d67f2bfd92d74
    		</td>
    	</tr>
		<?php } } ?>
	</tbody>
</table>
