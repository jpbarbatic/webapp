<?php
$permiso='usuarios.crear';
$metodo='GET';
require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');

$rol['id']='';
$rol['nombre']='';
$rol['descripcion']='';

$titulo='Nuevo rol';
$vista='roles/nuevo';
require('../../html/plantilla.html.php');

