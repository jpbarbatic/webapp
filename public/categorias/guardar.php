<?php
$metodo='POST';
$db=require_once('../../includes/backend.php');

if (empty($_POST['id'])) {
    $id = db_insert($db, 'categorias', $_POST);
    $_SESSION['mensaje']['ok']='Registro guardado correctamente';
}else{
    $id=$_POST['id'];
    $res=db_update($db, 'categorias', $_POST);
    $_SESSION['mensaje']['ok']='Registro guardado correctamente';
}

header('Location: editar.php?id=' . $id);
