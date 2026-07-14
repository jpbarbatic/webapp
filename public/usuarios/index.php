<?php
$permiso='usuarios.consulta';
$metodo='GET';
$titulo = 'Usuarios';
$vista = 'usuarios/listado';
$db = require_once('../../includes/backend.php');

$_SESSION['token'] = uniqid();
$p = isset($_GET['p'])  ? $_GET['p'] : 1;
$items_pagina = 10;
$offset=($p-1)*$items_pagina;

$res=db_select($db, 'SELECT * FROM usuarios', [], $items_pagina, $offset);
extract($res);
require('../../html/plantilla.html.php');
