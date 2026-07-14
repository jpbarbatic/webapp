<?php
$permiso='usuarios.crear';
$metodo='GET';
require_once('../../includes/backend.php');

$usuario=['id'=>'', 'nombre'=>'', 'apellidos'=>'', 'email'=>'', 'telefono'=>'', 'id_rol'=>0];
$titulo='Nuevo usuario';
$vista='usuarios/nuevo';
require('../../html/plantilla.html.php');
