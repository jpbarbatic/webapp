<?php
$permiso = 'usuarios.crear';
$metodo = 'POST';
$db = require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');
require_once('../../includes/usuarios.php');

$formulario = validar_usuario($_REQUEST, false);

if (empty($formulario['errores'])) {
    $id = crear_usuario($db, $formulario['valores']);
    $_SESSION['mensaje']['ok'] = 'Registro creado correctamente';
    header('Location: ./' . $id);
} else {
    header('Location: ./nuevo');
}
