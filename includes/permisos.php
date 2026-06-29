<?php

function obtener_roles($db){

  $sql='select * from roles';
  
  $roles=db_query($db, $sql);  
  
  return $roles;  
}

function obtener_todos_permisos($db){
$sql='select * from permisos order by nombre';
$permisos=db_query($db, $sql);
return $permisos;
}

function obtener_permisos_rol($db, $id_rol){

  $sql='select p.id, p.nombre
  from roles_permisos rp 
  join permisos p on rp.id_permiso=p.id
  where rp.id_rol=?
  order by p.nombre';
  
  $res=db_query($db, $sql, [$id_rol]);

  return $res;
}

function actualizar_permisos_rol($db, $permisos, $id_rol){
  $sql='delete from roles_permisos where id_rol=?';
  $res=db_query($db, $sql, [$id_rol]);
  foreach($permisos as $permiso){
    $sql='insert into roles_permisos (id_rol, id_permiso) values (?,?)';
    $res=db_query($db, $sql, [$id_rol, $permiso]);
  }
}

