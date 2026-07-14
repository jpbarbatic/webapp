<?php
include '../config.php';
include ROOT_DIR.'/includes/utilidades.php';
session_start();
mensaje_log('Logout: '.$_SESSION['usuario']['email']);

session_unset();
session_destroy();
session_regenerate_id(true);

header('Location: '.URL_BASE);
