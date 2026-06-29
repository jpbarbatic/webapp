<?php
require_once('../../includes/backend.php');


if (!$_SERVER['REQUEST_METHOD'] == 'POST' or !isset($db)) {
    die();
}

$id=$_REQUEST['id'];
$res=db_update($db, 'usuarios', $_REQUEST);
actualizar_permisos_rol($db, $_REQUEST['permisos'], $id);
$_SESSION['mensaje']['ok']='Registro guardado correctamente';

header('Location: editar.php?id=' . $id);
