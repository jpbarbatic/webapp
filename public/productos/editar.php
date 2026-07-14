<?php
$metodo = 'GET';
$db = require_once('../../includes/backend.php');
require_once('../../includes/productos.php');
require_once('../../includes/categorias.php');

$id = parametro_valido($_GET, 'id', 'int');
if (!$id) {
    die();
}
$producto = productos_obtener($id);
if (!$producto) {
    redirigir('.');
}

$categorias = categorias_lista($db);
$titulo = 'Editar producto';
$vista = 'productos/editar';
require('../../html/plantilla.html.php');
