<?php
$db = require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');
require_once('../../includes/permisos.php');

if (!$_SERVER['REQUEST_METHOD'] == 'GET') {
    die();
}

$permisos=obtener_permisos_rol($db, 1);
print_r($permisos);

$roles=obtener_roles($db);
print_r($roles);
