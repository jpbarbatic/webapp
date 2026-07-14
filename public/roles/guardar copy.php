<?php
$permisos = 'usuarios.crear';
$metodo = 'POST';
$db = require_once('../../includes/backend.php');

$formulario = validar_formulario($_POST, [
    'nombre' => 'required|alpha',
    'descripcion' => 'required|alpha',
]);

if (empty($formulario['errores'])) {
    $id = db_insert($db, 'roles', $formulario['valores']);
    $_SESSION['mensaje']['ok'] = 'Registro guardado correctamente';
    header('Location: editar.php?id=' . $id);
}else{
    $_SESSION['mensaje']['ko'] = 'Se ha producido un error';
    header('Location: nuevo.php');
}