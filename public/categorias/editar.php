<?php
$metodo='GET';
$db=require_once('../../includes/backend.php');
require_once('../../includes/categorias.php');

if(!isset($_REQUEST['id'])){
    die();
}



$id=$_REQUEST['id'];

$categoria=db_get_by_id($db, 'categorias', $id);
$categorias=categorias_lista($db);

$titulo='Editar categoría';
$vista='categorias/editar';
require('../../html/plantilla.html.php');
unset($_SESSION['mensaje']);