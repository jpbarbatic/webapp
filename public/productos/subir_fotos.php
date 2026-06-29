<?php
require_once('../../includes/backend.php');
require_once('../../includes/utilidades.php');

if (!$_SERVER['REQUEST_METHOD'] == 'POST' or !isset($db)) {
    die();
}
$id = $_POST['id'];
for ($i = 0; $i < count($_FILES['fotos']['name']); $i++) {
    if (!$_FILES['fotos']['error'][$i]) {
        echo "Copiando foto ";
        // Comprobar tamaño del fichero, formato
        db_begin($db);
        $producto=db_get_by_id($db, 'productos', $id);
        $producto['num_fotos']++;
        db_update($db, 'productos', $producto);
        $path=__DIR__ . '/../imagenes/productos/' . $id;

        if(!is_dir($path)){
            mkdir($path);
        }
        
        if(copy($_FILES['fotos']['tmp_name'][$i], $path . '/'.$producto['num_fotos'].'.jpg')){
            db_commit($db);            
        }else{
            db_rollback($db);
        }
    }
}


//header('Location: editar.php?id=' . $id);
