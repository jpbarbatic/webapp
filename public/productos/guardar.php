<?php
require_once('../../includes/backend.php');

if (!$_SERVER['REQUEST_METHOD'] == 'POST' or !isset($db)) {
    die();
}

if (empty($_REQUEST['id'])) {
    $id = db_insert($db, 'productos', $_REQUEST);
    $_SESSION['mensaje']['ok']='Registro guardado correctamente';
}else{
    $id=$_REQUEST['id'];
    $res=db_update($db, 'productos', $_REQUEST);
    $_SESSION['mensaje']['ok']='Registro guardado correctamente';
}

header('Location: editar.php?id=' . $id);
