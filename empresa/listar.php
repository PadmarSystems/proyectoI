<?php
require('clases/empresa.class.php');
$empresa = new empresa;

$empresas = $empresa->mostrar_empresas();
?>

<h1>Empresas</h1>
<div>
	<table class='listado'>
		<thead>
			<tr>
				<th>Empresa</th>
				<th>Fecha de Registro</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			if (count($empresas) > 0) {
				foreach ($empresas as $row) {
			?>
			<tr id="<?php echo $row['idEmpresa']; ?>">
	    		<td><?php echo $row['aliasEmpresa']; ?></td>
	    		<td><?php echo $row['fechaCreacion']; ?></td>
	    		<td class="actions">
	    			<a title="Editar" onclick="goto('form&ac=editar&id=<?php echo $row["idEmpresa"]; ?>','empresa')"><i class="fa fa-pencil-square-o"></i></a>
	    		</td>
	    	</tr>
			<?php } } ?>
		</tbody>
	</table>
</div>
