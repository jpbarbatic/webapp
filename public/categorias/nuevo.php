<?php
require_once('../../includes/backend.php');

if(!$_SERVER['REQUEST_METHOD']=='GET' or !isset($db)){
    die();
}

$titulo='Nuevo usuario';
$vista='usuarios/nuevo';
require('../../html/plantilla.html.php');