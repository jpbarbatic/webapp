<?php
$permisos = 'usuarios.crear';
$metodo = 'POST';
$db = require_once('../../includes/backend.php');

$formulario = validar_formulario($_POST, [
    'id' => 'required|numeric',
    'nombre' => 'required|alpha',
    'descripcion' => 'required|alpha',
]);

if (empty($formulario['errores'])) {
    $res = db_update($db, 'roles', $formulario['valores']);
    actualizar_permisos_rol($db, $_REQUEST['permisos'], $formulario['valores']['id']);
    $_SESSION['mensaje']['ok'] = 'Registro guardado correctamente';
}

if (isset($formulario['valores']['id'])) {
    header('Location: editar.php?id=' . $formulario['valores']['id']);
}
