<?php
$db = require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');

if (!$_SERVER['REQUEST_METHOD'] == 'GET') {
    die();
}

extract(paginacion());
$params=[];
$sql='SELECT * FROM roles';
$res = db_select($db, $sql, $params, $items_pagina, $offset, $orden, $orden_dir);
extract($res);

$titulo = 'Roles';
$vista = 'roles/listado';
require('../../html/plantilla.html.php');
