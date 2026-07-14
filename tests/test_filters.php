<?php

require('../includes/db_pdo.php');
$filtros = [
    'nombre'    => ['like' => 'pepe'],          // Se convertirá en: nombre LIKE ?
    'precio'    => ['<=' => 23],                // Se convertirá en: precio <= ?
    'categoria' => ['in' => [1, 5, 9]],         // Se convertirá en: categoria IN (?,?,?)
    'activo'    => ['=' => 1],                  // Se convierte en: activo = ?
    'baja'      => ['is null' => true]          // Se convierte en: baja IS NULL (ignora el valor)
];
$res= createFilters($filtros);
print_r($res);