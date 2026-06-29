<?php
$db = require_once('../../includes/backend.php');

if (!$_SERVER['REQUEST_METHOD'] == 'GET') {
    die();
}

$_SESSION['token'] = uniqid();
$p = isset($_GET['p'])  ? $_GET['p'] : 1;
$items_pagina = 10;
$offset=($p-1)*$items_pagina;

$res=db_select($db, 'SELECT * FROM categorias', [], $items_pagina, $offset);
extract($res);
$titulo = 'Categorías';
$vista = 'categorias/listado';
require('../../html/plantilla.html.php');
