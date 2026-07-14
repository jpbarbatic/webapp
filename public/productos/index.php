<?php
$metodo='GET';
$db = require_once('../../includes/backend.php');
require_once('../../includes/productos.php');
require_once('../../includes/categorias.php');

$filtros = [];

if (isset($_GET['filtro']['nombre'])) {
    if((preg_match('/id:?(\d+)/', $_GET['filtro']['nombre'], $coincidencias))){
        $filtros['nombre']=['=', $coincidencias[0]];
    }else{
        $filtros['nombre']=['like', $_GET['filtro']['nombre']];
    }
}

if (isset($_GET['filtro']['categoria']) and !empty($_GET['filtro']['categoria'])) {
    $filtros['id_categoria']=['=', $_GET['filtro']['categoria']];
}
extract(paginacion());
$res = productos_listado($db, $filtros, $orden, $orden_dir, $items_pagina, $offset);
extract($res);

$categorias=categorias_listado($db);
$categoriasPorId = array_column($categorias['datos'], 'nombre', 'id');
$titulo = 'Productos';
$vista = 'productos/listado';
require('../../html/plantilla.html.php');
