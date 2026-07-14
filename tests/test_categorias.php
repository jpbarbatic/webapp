<?php

require_once('../config.php');
require_once('../includes/db_pdo.php');
require_once('../includes/categorias.php');

$db=db_open();
$categorias=categorias_lista($db);
print_r($categorias);

$t=1;
foreach($categorias as $categoria){

    if($categoria['categoria_padre']!=null){
        for($i=0; $i<$t; $i++){
            echo '   ';
        }
        $t++;
    }else{
        $t=1;
    }
    echo $categoria['nombre'].PHP_EOL;

}