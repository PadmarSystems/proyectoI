<?php
require('clases/empleado.class.php');
$empleado = new empleado;

$empleados = $empleado->mostrar_empleados();
?>
<script type="text/javascript" src="<?php echo $ruta; ?>incidencias/incidencias.js"></script>

<h1>Incidencias</h1>
<button class="ex" onclick="goto('form&ac=nuevo','incidencias')">Registrar incidencia</button>
</br>
</br>
<table class='listado' >
  <thead>
    <tr><td></td>
    <td></td>
    <td></td>
    </tr>
  </thead>
	<tbody id="">
    <?php
       if (count($empleados) > 0) {
            foreach ($empleados as $row) {
    ?>
       <tr id="<?php echo $row['idEmpleado']; ?>">
           <td>
               <?php echo str_replace('--',' ',$row['nombreEmp']); ?><br>
               <?php echo $row['nombrePuesto']; ?><br>
               <?php echo $row['nombreUbicacion']; ?><br>
               <?php echo $row['nombreResponsable']; ?>
           </td>
           <td>
               <button class="nin" onclick="goto('form&ac=nuevo&id=<?php echo $row["idEmpleado"]; ?>','incidencias')">Registrar<br> Incidencia</button>
           </td>
           <td>
               <button class="ex" onclick="mostrardetalle('Kardex',<?php echo $row['idEmpleado']; ?>);" >Ver perfil</button>&nbsp&nbsp
               <button class="ex" onclick="mostrardetalle('Detalle',<?php echo $row['idEmpleado']; ?>);" >Ver más</button>
           </td>
       </tr>
       <?php } } ?>
	</tbody>
</table>
<div id="dialog-message"></div>
