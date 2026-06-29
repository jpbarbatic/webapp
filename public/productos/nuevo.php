<?php
require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');

if(!$_SERVER['REQUEST_METHOD']=='GET' or !isset($db)){
    die();
}

$categorias=db_query($db, 'SELECT * FROM categorias');
$titulo='Nuevo producto';
$vista='productos/nuevo';
require('../../html/plantilla.html.php');