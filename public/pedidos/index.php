<?php
$permiso='pedidos.consultar';
$metodo='GET';
$db = require_once('../../includes/backend.php');
require_once('../../includes/pedidos.php');

$res=pedidos_obtener($db);
extract($res);

$titulo = 'Pedidos';
$vista = 'pedidos/listado';
require('../../html/plantilla.html.php');
