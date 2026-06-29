<?php
require_once('../../includes/backend.php');

if (!$_SERVER['REQUEST_METHOD'] == 'GET' or !isset($db)) {
    die();
}

if (db_delete_by_id($db, 'productos', $_REQUEST['id'])) {
    $_SESSION['mensaje']['ok']='Registro borrado correctamente';
}
header('Location: .');
