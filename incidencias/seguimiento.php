<?php
require('clases/empleado.class.php');
$empleado = new empleado;

$empleados = $empleado->mostrar_empleados();
?>


<h1>Incidencias</h1>

<table >
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
               <button onclick="alert('formulario');">Registrar<br> Incidencia</button>
           </td>
           <td>
               <button onclick="alert('Perfil')">Ver perfil</button><br>
               <button onclick="alert('Alert')">Ver más</button>
           </td>
       </tr>
       <?php } } ?>
	</tbody>
</table>

