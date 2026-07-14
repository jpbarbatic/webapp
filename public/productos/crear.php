<?php
$permiso='productos.crear';
$metodo='POST';
$db=require_once('../../includes/backend.php');

if (empty($_REQUEST['id'])) {
    $id = db_insert($db, 'productos', $_REQUEST);
    $_SESSION['mensaje']['ok']='Registro guardado correctamente';
}else{
    $id=$_REQUEST['id'];
    $res=db_update($db, 'productos', $_REQUEST);
    $_SESSION['mensaje']['ok']='Registro guardado correctamente';
}

header("Location: ./$id");
