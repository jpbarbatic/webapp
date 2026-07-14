<?php
$permiso = 'usuarios.actualizar';
$metodo = 'POST';
$db = require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');
require_once('../../includes/usuarios.php');

$formulario = validar_usuario($_POST);

// Si no hay errores
if (empty($formulario['errores'])) {
    $res = guardar_usuario($db, $formulario['valores']);
    $_SESSION['mensaje']['ok'] = 'Registro guardado correctamente';
}

if(isset($formulario['valores']['id'])){
    header('Location: ./' . $formulario['valores']['id']);
}else{
    header('Location: .');
}
