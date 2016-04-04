<?php
/*
CONFIGURACIÓN GENERAL DEL SISTEMA
Se debe incluir este archivo en todos los php para importar funciones generales o controlar la sesión del usuario por ejemplo.
*/
error_reporting(-1);
date_default_timezone_set('UTC');
date_default_timezone_set('America/Mexico_City'); //Definir zona horaria
setlocale(LC_ALL,'es_ES');
require_once 'safemysql.php';

