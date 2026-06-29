<?php
$db = require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');

if (!$_SERVER['REQUEST_METHOD'] == 'GET') {
    die();
}

$params = [];
$sql = 'SELECT * FROM productos WHERE TRUE';

if (isset($_GET['filtro']['nombre'])) {
    $sql .= ' AND nombre LIKE ?';
    $params[] = '%' . $_GET['filtro']['nombre'] . '%';
}

if (isset($_GET['filtro']['categoria']) and !empty($_GET['filtro']['categoria'])) {
    $sql .= ' AND id_categoria=?';
    $params[] = $_GET['filtro']['categoria'];
}

$orden = isset($_GET['orden']) ? $_GET['orden'] : 'id';
$orden_dir =  isset($_GET['orden_dir']) ? $_GET['orden_dir'] : 'asc';

//$res = db_select($db, $sql, $params, 0, 0, $orden, $orden_dir);
//extract($res);
require(__DIR__.'/../../includes/pdf.php');
generar_pdf_db($db, $sql, $params, $orden, $orden_dir, __DIR__.'/../../html/productos/listado.pdf.php');
//generar_pdf($res, __DIR__.'/../../html/productos/listado.pdf.php');