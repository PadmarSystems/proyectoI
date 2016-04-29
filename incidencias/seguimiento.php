<?php
require('clases/empleado.class.php');
$empleado = new empleado;

$empleados = $empleado->mostrar_empleados();
?>
<script type="text/javascript" src="<?php echo $ruta; ?>incidencias/incidencias.js"></script>

<h1>Incidencias</h1>
<ul class="submenu">
    <li><a class="ex" onclick="goto('form&ac=nuevo','incidencias')"><i class="fa fa-plus"></i>Registrar incidencia</a></li>
</ul>
<div>
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
                        <div class="card">
                            <div class="row title">
                                <div class="col-md-12">
                                    <h3><?php echo str_replace('--',' ',$row['nombreEmp']); ?></h3>
                                    <small><i><?php echo $row['nombrePuesto']; ?></i></small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <ul>
                                        <li><b>Ubicación:</b></br><?php echo $row['nombreUbicacion']; ?></li>
                                        <li><b>Responsable:</b></br><?php echo $row['nombreResponsable']; ?></li>
                                    </ul>
                                </div>
                                <div class="col-md-3 btns">
                                    <a class="nin" onclick="goto('form&ac=nuevo&id=<?php echo $row["idEmpleado"]; ?>','incidencias')"><i class="fa fa-calendar-plus-o"></i>Registrar Incidencia</a>
                                </div>
                                <div class="col-md-4 btns">
                                    <a class="ex" onclick="mostrardetalle('Kardex',<?php echo $row['idEmpleado']; ?>,550);" ><i class="fa fa-user"></i>Perfil</a>
                                    <a class="ex" onclick="mostrardetalle('Detalle',<?php echo $row['idEmpleado']; ?>);" ><i class="fa fa-external-link"></i>Detalles</a>
                                </div>
                            </div>
                        </div>
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
    <div id="dialog-message" style="display:none;"></div>
</div>
