
<form action="roles/guardar.php" method="post">
  <div class="row">
  <div class="col">
  <input name="id" value="<?=isset($rol) ? $rol['id'] : ''?>">
  <input name="nombre" value="<?=isset($rol) ? $rol['nombre'] : ''?>">
  <input name="descripcion" value="<?=isset($rol) ? $rol['descripcion'] : ''?>">
  </div>
  </div>
  <?php foreach($permisos as $permiso): ?>
  <input type="checkbox" data-depende="<?=$permiso['depende_de']?>" <?=in_array($permiso['id'], array_column($permisos_rol, 'id')) ? 'checked':''?> name="permisos[]" value="<?=$permiso['id']?>"><?=$permiso['nombre']?><br>
  <?php endforeach; ?>
  <input type="submit" value="Guardar">
</form>

