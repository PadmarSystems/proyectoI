<?php
$emp = explode("--", 'Monica Hernandez');
print_r($emp);

if (isset($emp[0])) {
 echo $emp[0];
}

if (isset($emp[1])) {
 echo $emp[1];
}
?>