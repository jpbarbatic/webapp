<?php
require_once('../../includes/backend.php');

if (!$_SERVER['REQUEST_METHOD'] == 'POST' or !isset($db)) {
    die();
}

$res = db_update($db, 'usuarios', ['id' => $_REQUEST['id'], 'password' => password_hash($_REQUEST['password'], PASSWORD_DEFAULT)]);
if ($res) {
    $_SESSION['mensaje']['ok'] = 'Password actualizado correctamente';
} else {
    $_SESSION['mensaje']['ko'] = 'No se ha podido actualizar el password';
}

header('Location: editar.php?id=' . $_REQUEST['id']);
