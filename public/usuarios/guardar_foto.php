<?php
require_once('../../includes/backend.php');

if (!$_SERVER['REQUEST_METHOD'] == 'POST' or !isset($db)) {
    die();
}

if (isset($_FILES['foto']) and isset($_POST['id'])) {
    $ruta_original = $_FILES['foto']['tmp_name'];
    $ruta_destino = __DIR__ . '/../imagenes/usuarios/' . $_POST['id'] . '.jpg';

    // 2. Obtener dimensiones originales
    list($ancho_orig, $alto_orig) = getimagesize($ruta_original);

    // 3. Definir el nuevo ancho y calcular el alto proporcional
    $nuevo_ancho = 100;
    $nuevo_alto = ($alto_orig / $ancho_orig) * $nuevo_ancho;

    // 4. Crear los lienzos en memoria
    $lienzo_destino = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);
    $imagen_origen = imagecreatefromjpeg($ruta_original);

    // 5. Redimensionar con alta calidad (Resampling)
    imagecopyresampled(
        $lienzo_destino,
        $imagen_origen,
        0,
        0,
        0,
        0,
        $nuevo_ancho,
        $nuevo_alto,
        $ancho_orig,
        $alto_orig
    );

    // 6. Guardar en el disco con calidad del 85%
    imagejpeg($lienzo_destino, $ruta_destino, 85);

    // 7. Liberar memoria RAM ocupada
    imagedestroy($imagen_origen);
    imagedestroy($lienzo_destino);


    //copy($_FILES['foto']['tmp_name'], imagex);
    header('Location: editar.php?id=' . $_POST['id']);
    exit;
}

die();
