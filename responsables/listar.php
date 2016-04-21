<?php
require('clases/responsable.class.php');
$responsable = new responsable;
$where = "WHERE idEmpresa= " . $_SESSION['idEmpresa'] . " ";
$responsables = $responsable->mostrar_responsables('*',$where);
?>
<script type="text/javascript">
	$(function() {
		$('.listado tbody').on( 'click', 'i.fa-trash-o', function () {
			var str = 'responsables/controlador.php';
			var params = {a: 'eliminar',id: $(this).parents('tr').attr("id")};
			send_ajax_form(str,params);
			
		    $(".listado").DataTable()
		        .row( $(this).parents('tr') )
		        .remove()
		        .draw();
		} );
	});
</script>
<h2>Responsables </h2>
<br>
<table class='listado'>
	<thead>
		<tr>
			<th>Nombre </th>
			<th>A. Paterno </th>
			<th>A. Materno </th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php
		if (count($responsables) > 0) {
			foreach ($responsables as $row) {
				$emp = explode("--", $row['nombreResponsable']);

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
		<tr id="<?php echo $row['idResponsable']; ?>">
    		<td><?php echo $emp[0]; ?></td>
    		<td><?php echo $emp[1]; ?></td>
    		<td><?php echo $emp[2]; ?></td>
    		<td>
    			<i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar" style="cursor:pointer" onclick="goto('form&ac=editar&id=<?php echo $row["idResponsable"]; ?>','responsables')"></i>
    			&nbsp &nbsp <i class="fa fa-trash-o" aria-hidden="true" title="Eliminar" style="cursor:pointer"></i>
    		</td>
    	</tr>
		<?php } } ?>
	</tbody>
</table>