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

$producto=db_get_by_id($db, 'productos', $id);
$categorias=db_query($db, 'SELECT * FROM categorias');

$titulo='Editar producto';
$vista='productos/editar';
require('../../html/plantilla.html.php');
