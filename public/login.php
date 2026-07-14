<?php
require('../config.php');
require('../includes/db_pdo.php');
require('../includes/utilidades.php');
require('../includes/permisos.php');
session_start();
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    exit;
}

$db = db_open();

if (!$db) {
    die('Error de conexión');
}



// Buscamos el usuario cuyo nombre de usuario sea el usuario del formulario
$res = db_query($db, "SELECT * FROM usuarios WHERE email=?", [$_POST['email']]);

// Comprobamos que hay algún registro y luego comprobamos que el password del formulario 
// es el mismo que el registro de la base de datos
if (!empty($res) and password_verify($_POST['password'], $res[0]['password'])) {    
    session_regenerate_id(true); 
    $_SESSION['usuario'] = $res[0];
    $_SESSION['permisos'] = obtener_permisos_rol($db, $_SESSION['usuario']['id_rol']);
    mensaje_log('Login: '.$res[0]['email']);
    header('Location: '.URL_BASE);
    exit;
} else {
    $_SESSION['mensaje'] = 'Usuario y/o contraseña incorrectos';
    header('Location: index.php');
    exit;
}
