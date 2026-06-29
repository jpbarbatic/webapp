<?php
require_once('../../includes/backend.php');

if(!$_SERVER['REQUEST_METHOD']=='GET' or !isset($db)){
    die();
}

if(!isset($_REQUEST['id'])){
    die();
}

$id=$_REQUEST['id'];

$categoria=db_get_by_id($db, 'categorias', $id);

$titulo='Editar categoría';
$vista='categorias/editar';
require('../../html/plantilla.html.php');
unset($_SESSION['mensaje']);