<?php
$metodo = 'GET';
$db = require_once('../../includes/backend.php');
require_once('../../includes/pedidos.php');

if (!isset($_REQUEST['id'])) {
    die();
}

$id = $_REQUEST['id'];

$pedido = db_get_by_id($db, 'pedidos', $id);
switch ($pedido['estado']) {
    case PEDIDO_PAGADO:
        unset($estados_pedidos[PEDIDO_PENDIENTE_PAGO]);
        break;
    case PEDIDO_EN_PREPARACION:
        unset($estados_pedidos[PEDIDO_PENDIENTE_PAGO]);
        unset($estados_pedidos[PEDIDO_EN_PREPARACION]);
        break;
}
$lineas_pedido = obtener_lineas_pedido($db, $id);

$titulo = 'Detalle pedido';
$vista = 'pedidos/editar';
require('../../html/plantilla.html.php');
