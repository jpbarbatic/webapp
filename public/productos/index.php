<?php
$db = require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');

if (!$_SERVER['REQUEST_METHOD'] == 'GET') {
    die();
}

extract(paginacion());

$params = [];
$sql = 'SELECT * FROM productos WHERE TRUE';

if (isset($_GET['filtro']['nombre'])) {
    if((preg_match('/id:?(\d+)/', $_GET['filtro']['nombre'], $coincidencias))){
        $sql .= ' AND id = ?';
        $params[] = $coincidencias[1];
    }else{
    $sql .= ' AND nombre LIKE ?';
    $params[] = '%' . $_GET['filtro']['nombre'] . '%';
    }
}

if (isset($_GET['filtro']['categoria']) and !empty($_GET['filtro']['categoria'])) {
    $sql .= ' AND id_categoria=?';
    $params[] = $_GET['filtro']['categoria'];
}

$res = db_select($db, $sql, $params, $items_pagina, $offset, $orden, $orden_dir);
extract($res);

$categorias=db_query($db, 'SELECT * FROM categorias ORDER BY nombre');
$categoriasPorId = array_column($categorias, 'nombre', 'id');
$titulo = 'Productos';
$vista = 'productos/listado';
require('../../html/plantilla.html.php');
