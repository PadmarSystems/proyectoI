<?php
require('clases/empleado.class.php');
$empleado = new empleado;

$empleados = $empleado->mostrar_empleados();
?>
<script type="text/javascript" src="<?php echo $ruta; ?>incidencias/incidencias.js"></script>

<h1>Incidencias</h1>
<div>
    <button class="ex" onclick="goto('form&ac=nuevo','incidencias')">Registrar incidencia</button>
</div>
<p id="dialog-message"></p>
<table class="pages">
    <thead>
        <tr>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($empleados) > 0) {
            $i = 0;
            foreach ($empleados as $row) {
                if($i%2 == 0) { ?>
                    <tr>
                <?php } ?>
                    <td id="<?php echo $row['idEmpleado']; ?>">
                        <?php echo str_replace('--',' ',$row['nombreEmp']); ?><br>
                        <?php echo $row['nombrePuesto']; ?><br>
                        <?php echo $row['nombreUbicacion']; ?><br>
                        <?php echo $row['nombreResponsable']; ?>
                        <button class="nin" onclick="goto('form&ac=nuevo&id=<?php echo $row["idEmpleado"]; ?>','incidencias')">Registrar<br> Incidencia</button>
                        <button class="ex" onclick="mostrardetalle('Kardex',<?php echo $row['idEmpleado']; ?>);" >Ver perfil</button>&nbsp&nbsp
                        <button class="ex" onclick="mostrardetalle('Detalle',<?php echo $row['idEmpleado']; ?>);" >Ver más</button>
                    </td>
                <?php if(($i+1)%2 == 1 && ($i+1)-count($empleados)==0) {
                    echo '<td></td>';
                }
                if($i%2 == 1 || count($empleados) == ($i+1)) { ?>
                    </tr>
                <?php }
                $i++;
            }
        } ?>
        </tbody>
    </table>
