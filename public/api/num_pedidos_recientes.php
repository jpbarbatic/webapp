<?php
$metodo='GET';
$db = require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');
require_once('../../includes/pedidos.php');

$num=pedidos_obtener_num_recientes($db);
if($num!==false){
    $json=[
        'datos'=>$num
    ];

    sendJson($json, 60);
}