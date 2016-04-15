<?php
require('clases/empleado.class.php');
$empleado = new empleado;

$empleados = $empleado->mostrar_empleados();
?>


<h1>Incidencias</h1>
<button class="ex" onclick="goto('form&ac=nuevo','incidencias')">Registrar incidencia</button>
<table class='listado' >
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
               <button class="ex">Ver perfil</button><br>
               <button class="ex">Ver más</button>
           </td>
       </tr>
       <?php } } ?>
	</tbody>
</table>
