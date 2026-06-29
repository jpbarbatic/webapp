<?php
require_once('../../includes/backend.php');

if (!$_SERVER['REQUEST_METHOD'] == 'POST' or !isset($db)) {
    die();
}

if (empty($_REQUEST['id'])) {
    $id = db_insert($db, 'usuarios', $_REQUEST);
    $_SESSION['mensaje']['ok']='Registro creado correctamente';
}

header('Location: editar.php?id=' . $id);
