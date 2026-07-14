<?php

$permiso='usuarios.actualizar';
$metodo='GET';
$db=require_once('../../includes/backend.php');


if(!parametro_valido($_GET, 'id', 'int')){
    die();
}

$usuario=db_get_by_id($db, 'usuarios', $_GET['id']);
if(!$usuario){
    header('Location: .');
    exit;
}
$titulo='Editar usuario';
$vista='usuarios/editar';
require('../../html/plantilla.html.php');
