<?php
require('../config.php');
require('../includes/db_pdo.php');
require('../includes/productos.php');

$filtros = [
    //'nombre'    => ['like' => 'cam'],          // Se convertirá en: nombre LIKE ?
    'precio'    => ['<=' => 10],                // Se convertirá en: precio <= ?
    'stock'     => ['>=' => 100]
];

$db=db_open();
$res= createFilters($filtros);
print_r($res);
$productos=productos_listado($db, $filtros, 'precio');
//$productos=productos_listado($db);
print_r($productos);