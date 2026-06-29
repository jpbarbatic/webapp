<?php
require(__DIR__.'/../config.php');
require_once('permisos.php');
require_once('utilidades.php');
// Iniciamos las sesiones
session_start();

// Comprobamos si la sesión está inicializada. Si no lo está, redirigimos a login
if (!isset($_SESSION['usuario'])) {
    header('Location: '.URL_BASE);
    exit;
}

require('db_pdo.php');
// Creamos una conexión de base de datos
$db = db_open();

if (!$db) {
    die('Se ha producido un error');
}

$_SESSION['permisos'] = obtener_permisos_rol($db, $_SESSION['usuario']['id_rol']);
if(!$_SESSION['usuario']['id_rol']===1 && (isset($permiso) && !in_array($permiso, array_column($_SESSION['permisos'], 'nombre')))){
  die('No tienes permiso');
}

return $db;
