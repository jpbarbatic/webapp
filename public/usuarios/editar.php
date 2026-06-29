<?php

require_once('../../includes/backend.php');

if(!$_SERVER['REQUEST_METHOD']=='GET' or !isset($db)){
    die();
}

if(!isset($_REQUEST['id'])){
    die();
}

$id=$_REQUEST['id'];

$usuario=db_get_by_id($db, 'usuarios', $id);

$titulo='Editar usuario';
$vista='usuarios/editar';
require('../../html/plantilla.html.php');
unset($_SESSION['mensaje']);
