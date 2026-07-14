<?php

function categorias_listado($db, $filtros=[], $order_by='id', $order_dir='DESC', $limit=0, $offset=0){
    $categorias=db_select($db, "SELECT * FROM categorias", []);
    return $categorias;
}

function categorias_lista($db){
    $categorias=categorias_arbol($db);
    $categorias=db_query($db, 'SELECT * FROM categorias ORDER BY nombre');
    return construirLista($categorias, null);    
}

function construirLista($categorias, $idPadre){
    $rama = [];

    foreach ($categorias as $categoria) {
        // Si el padre coincide con el nivel actual que estamos buscando
        if ($categoria['categoria_padre'] == $idPadre) {
            
            // Llamada recursiva: buscamos los hijos de la categoría actual
            $hijos = construirLista($categorias, $categoria['id']);
            $rama[]=$categoria;
            // Si tiene hijos, los añadimos al nodo actual
            if (!empty($hijos)) {
                $rama=array_merge($rama, $hijos);
            } 
        }
    }

    return $rama;
}

function categorias_arbol($db){
    $categorias=db_query($db, 'SELECT * FROM categorias ORDER BY nombre');
    return construirArbol($categorias, null);   
}

function construirArbol($categorias, $idPadre){
   $rama = [];

    foreach ($categorias as $categoria) {
        // Si el padre coincide con el nivel actual que estamos buscando
        if ($categoria['categoria_padre'] == $idPadre) {
            
            // Llamada recursiva: buscamos los hijos de la categoría actual
            $hijos = construirArbol($categorias, $categoria['id']);
            
            // Si tiene hijos, los añadimos al nodo actual
            if (!empty($hijos)) {
                $categoria['subcategorias'] = $hijos;
            } else {
                $categoria['subcategorias'] = []; // Array vacío si no tiene hijos
            }
            
            $rama[] = $categoria;
        }
    }

    return $rama;
}

