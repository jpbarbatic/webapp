<?php
$metodo='GET';
$db = require_once('../../includes/backend.php');

$logs = file(ROOT_DIR.'/log.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$titulo = 'Logs';
$vista = 'logs/listado';
require('../../html/plantilla.html.php');