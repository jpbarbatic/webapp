<?php

// ESTADOS DE LOS PEDIDOS
define('PEDIDO_CANCELADO', 0);      // Cancelado por el usuario o por falta de stock
define('PEDIDO_PENDIENTE_PAGO', 1); // El usuario creó el carrito pero el pago falló o está retenido
define('PEDIDO_PAGADO', 2);         // Pago confirmado, listo para que el almacén lo prepare
define('PEDIDO_EN_PREPARACION', 3); // El almacén está empaquetando los productos
define('PEDIDO_ENVIADO', 4);        // El paquete ya lo tiene la empresa de transporte
define('PEDIDO_ENTREGADO', 5);      // El cliente ya recibió el paquete (Finalizado)
define('PEDIDO_DEVOLUCION', 6);     // El cliente devolvió el producto y está en disputa/reembolso

$estados_pedidos = [
    PEDIDO_PENDIENTE_PAGO => 'Pendiente de Pago',
    PEDIDO_PAGADO         => 'Pagado',
    PEDIDO_EN_PREPARACION => 'En Preparación',
    PEDIDO_ENVIADO        => 'Enviado',
    PEDIDO_ENTREGADO      => 'Entregado',
    PEDIDO_CANCELADO      => 'Cancelado',
    PEDIDO_DEVOLUCION     => 'Devolución'
];
function pedidos_obtener_num_recientes(DB $db)
{
    $res = db_query($db, 'SELECT count(*) as num_pedidos from pedidos');

    return $res[0]['num_pedidos'];
}

function pedidos_obtener_por_id(DB $db, int $id_pedido)
{
    $pedido = db_get_by_id($db, 'pedidos', $id_pedido);
    if ($pedido === false) {
        return false;
    }

    return $pedido;
}

function pedidos_obtener(DB $db, $filtros=[], $orden='id', $orden_dir='DESC', $limit=0, $offset=0)
{
    $res=createFilters($filtros);
    $sql = 'SELECT * FROM pedidos'.$res['where'];
    $res = db_select($db, $sql, $res['params'], $offset, $offset, $orden, $orden_dir);
    return $res;
}

function obtener_lineas_pedido($db, $id_pedido)
{
    $sql = 'SELECT * from lineas_pedidos lp JOIN productos p ON lp.id_producto=p.id WHERE id_pedido=?';
    $res = db_query($db, $sql, [$id_pedido]);

    return $res;
}

/**
 * pedidos_crear
 *
 * @param  mixed $db
 * @param  mixed $pedido
 * @param  mixed $lineas_pedido
 * @return void
 */
function pedidos_crear(DB $db, array $pedido, array $lineas_pedido)
{
    if (!db_begin($db)) {
        return false;
    }
    // Crear pedido
    $id_pedido = db_insert($db, 'pedidos', $pedido);
    $error = false;
    $importe=0.0;
    foreach ($lineas_pedido as $linea_pedido) {
        $producto = db_get_by_id($db, 'productos', $linea_pedido['id_producto']);
        $importe+=$producto['precio']*$linea_pedido['cantidad'];
        if (!$producto) {
            $error = true;
            break;
        }
        $producto['stock'] -= $linea_pedido['cantidad'];
        $linea_pedido['id_pedido'] = $id_pedido;
        if (!db_insert($db, 'lineas_pedidos', $linea_pedido) or !db_update($db, 'productos', $producto)) {
            $error = true;
            break;
        }
    }

    if(!db_update($db, 'pedidos', ['id'=>$id_pedido, 'importe'=>$importe])){
        $error = true;
    }

    if (!$error && db_commit($db)) {
        // Notificamos al cliente
        notificar_pedido($db, $id_pedido);
        return $id_pedido;
    }

    db_rollback($db);

    return false;
}

function notificar_pedido($db, $id_pedido){

}