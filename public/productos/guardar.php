<?php
$permiso = 'productos.actualizar';
$metodo = 'POST';
$db = require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');
require_once('../../includes/productos.php');

$formulario = productos_validar($_POST);

if (empty($formulario['errores'])) {

    $res = productos_guardar($db, $formulario['valores']);
    if ($res) {
        $_SESSION['mensaje']['ok'] = 'Registro guardado correctamente';
    } else {
        $_SESSION['mensaje']['ko'] = 'Se ha producido un error';
    }
} else {
    $_SESSION['mensaje']['ko'] = 'Se ha producido un error';
}

if (isset($formulario['valores']['id'])) {
    header('Location: ./' . $formulario['valores']['id']);
} else {
    header('Location: .');
}
