<?php
// Depuración de errores
ini_set('display_errors','On');
ini_set('error_reporting', E_ALL );
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Conexión a base de datos
define('DEBUG', true);
define('DB_TYPE', 'mysql');
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'example');
define('DB_NAME', 'empresa');
define('DB_PORT', 3308);

define('NOMBRE_WEB', 'Mi Empresa');