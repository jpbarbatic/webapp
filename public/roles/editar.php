<?php

require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');

if(!$_SERVER['REQUEST_METHOD']=='GET' or !isset($db)){
    die();
}

if(!isset($_REQUEST['id'])){
    die();
}

$id=$_REQUEST['id'];

$rol=db_get_by_id($db, 'roles', $id);
$permisos=obtener_todos_permisos($db);
$permisos_rol=obtener_permisos_rol($db, $id);

$titulo='Editar rol';
$vista='roles/editar';
require('../../html/plantilla.html.php');
unset($_SESSION['mensaje']);
