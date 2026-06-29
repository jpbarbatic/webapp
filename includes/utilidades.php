<?php

function html_opciones($opciones, $seleccion, $id, $valor)
{
    $html = '';
    foreach ($opciones as $opcion) {
        $selected = $seleccion == $opcion[$id] ? 'selected' : '';
        $html .= "<option value='" . $opcion[$id] . "' $selected>" . $opcion[$valor] . "</option>\n";
    }
    return $html;
}

function html_input_valor($formulario, $campo, $defecto = '')
{
    return isset($formulario[$campo]) ? htmlspecialchars($formulario[$campo], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8', true) : $defecto;
}

function paginacion()
{
    $p = isset($_GET['p']) ? $_GET['p'] : 1;
    $items_pagina = 10;
    $offset = ($p - 1) * $items_pagina;
    $orden = isset($_GET['orden']) ? $_GET['orden'] : 'id';
    $orden_dir =  isset($_GET['orden_dir']) ? $_GET['orden_dir'] : 'asc';
    return compact('p', 'items_pagina', 'offset', 'orden', 'orden_dir');
}

function es_visible($vista){
  return preg_grep("/^$vista\.*/", array_column($_SESSION['permisos'], 'nombre'));
}

