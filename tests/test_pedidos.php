<?php

require_once('../config.php');
$db=require_once('../includes/db_pdo.php');
require_once('../includes/productos.php');
require_once('../includes/pedidos.php');

$pedido=[
    'nombre_apellidos'=>'Pepe González',
    'direccion_envio'=>'Avda. Tore Tore nº1',
    'poblacion_envio'=>'Torre del Mar',
    'cp_envio'=>'29740',
    'provincia_envio'=>'Málaga',
    'telefono'=>'234234234',
    'email'=>'pepe@gmail.com'
];
$db=db_open();
$producto1=productos_obtener($db, 1);
$producto2=productos_obtener($db, 2);
$lineas[]=['id_producto'=>1, 'cantidad'=>2, 'importe'=>$producto1['precio']];
$lineas[]=['id_producto'=>2, 'cantidad'=>2, 'importe'=>$producto2['precio']];

print_r($producto1);
print_r($producto2);
print_r($lineas);

echo pedidos_crear($db, $pedido, $lineas);
