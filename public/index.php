<?php
include '../config.php';

session_start();
if (isset($_SESSION['usuario'])) {
    header('Location: dashboard/');
    exit;
}

require('../html/login.html.php');
unset($_SESSION['mensaje']);
