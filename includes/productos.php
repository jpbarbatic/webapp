<?php

function productos_validar($formulario, $id=true){
    $reglas['nombre']=['reglas'=>'required|alpha_num|min:5|max:50'];
    $reglas['descripcion']=['reglas'=>'required|alpha_num|min:5|max:100'];
    $reglas['precio']=['reglas'=>'required|decimal'];
    $reglas['stock']=['reglas'=>'required|numeric'];
    $reglas['id_categoria']=['reglas'=>'required|numeric'];

    if($id){
        $reglas['id']=['reglas'=>'required|numeric'];
    }

    return validar_formulario($formulario, $reglas);
}

function productos_listado(DB $db, $filtros=[], $order_by='id', $order_dir='DESC', $limit=0, $offset=0,){
    $res=createFilters($filtros);
    $sql="SELECT * FROM productos";
    $productos=db_select($db, $sql.$res['where'], $res['params'], $limit, $offset, $order_by, $order_dir);
    return $productos;
}

/**
 * productos_obtener
 *
 * @param  mixed $db
 * @param  mixed $id
 * @return void
 */
function productos_obtener(DB $db, int $id){
    return db_get_by_id($db, 'productos', $id);
}

/**
 * productos_guardar
 *
 * @param  mixed $db
 * @param  mixed $producto
 * @return void
 */
function productos_guardar(DB $db, array $producto){
    $res=db_update($db, 'productos', $producto);
    return $res;
}