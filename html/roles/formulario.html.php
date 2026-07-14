<form action="roles/guardar.php" method="post">
  <div class="row">
    <div class="col-md-1">
      <label>ID</label>
      <input readonly class="form-control" name="id" value="<?= isset($rol) ? $rol['id'] : '' ?>">
    </div>
    <div class="col-md">
      <label>Nombre</label>
      <input class="form-control" name="nombre" value="<?= isset($rol) ? $rol['nombre'] : '' ?>">
    </div>
    <div class="col-md">
      <label>Descripción</label>
      <input class="form-control" name="descripcion" value="<?= isset($rol) ? $rol['descripcion'] : '' ?>">
    </div>
  </div>
  <?php if (isset($permisos) and isset($permisos_rol)): ?>
    <h2 class="mt-3">Permisos</h2>
    <?php foreach ($permisos as $permiso): ?>
      <input class="form-check-input" type="checkbox" data-depende="<?= $permiso['depende_de'] ?>" <?= in_array($permiso['id'], array_column($permisos_rol, 'id')) ? 'checked' : '' ?> name="permisos[]" value="<?= $permiso['id'] ?>"> <?= $permiso['descripcion'] ?><br>
    <?php endforeach; ?>
  <?php endif; ?>
  <input class="btn btn-success mt-3" type="submit" value="Guardar">
</form>