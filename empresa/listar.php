<?php
require('clases/empresa.class.php');
$empresa = new empresa;
$where = "WHERE idEmpresa = ".$_SESSION['idEmpresa'];
$empresas = $empresa->mostrar_empresas('*',$where);
?>

<h1>Empresas </h1>
<br>
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
    		<td style="text-align:center"><?php echo $row['aliasEmpresa']; ?></td>
    		<td style="text-align:center"><?php echo $row['fechaCreacion']; ?></td>
    		<td style="text-align:center">
    			<i class="fa fa-pencil-square-o" aria-hidden="true" title="Editar" style="cursor:pointer" onclick="goto('form&ac=editar&id=<?php echo $row["idEmpresa"]; ?>','empresa')"></i>
    		</td>
    	</tr>
		<?php } } ?>
	</tbody>
</table>