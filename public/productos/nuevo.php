<?php
$permiso='usuarios.crear';
$metodo='GET';
$db=require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');

$categorias=db_query($db, 'SELECT * FROM categorias');
$titulo='Nuevo producto';
$vista='productos/nuevo';
require('../../html/plantilla.html.php');