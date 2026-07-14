<?php

function validar_usuario($datos, $id = true)
{
    $validacion['nombre'] = ['reglas'=>'required|alpha|max:50'];
    $validacion['apellidos'] = ['reglas'=>'required|alpha|max:50'];
    $validacion['id_rol'] = ['reglas'=>'required|numeric'];

    if($id){
        $validacion['id'] = ['reglas'=>'required|numeric'];
    }

    $formulario = validar_formulario($datos, $validacion);

    return $formulario;
}

function guardar_usuario($db, $datos)
{
    $res = db_update($db, 'usuarios', $datos);

    return $res;
}

function crear_usuario($db, $datos){
    $id=db_insert($db, 'usuarios', $_REQUEST);

    return $id;
}

function obtener_perfil($db, $id_usuario) {}

function guardar_perfil($db, $perfil) {}

function actualizar_password($db, $id_usuario, $password) {}
