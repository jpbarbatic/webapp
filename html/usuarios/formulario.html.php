<form action="usuarios/<?=isset($usuario) ? 'guardar' : 'crear'?>.php" method="post">
    <div class="row mb-3">
        <div class="col-md-1">
            <label>ID</label>
            <input readonly class="form-control" name="id" value="<?=html_input_valor($usuario, 'id')?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <label>Nombre</label>
            <input class="form-control" name="nombre" value="<?=html_input_valor($usuario, 'nombre')?>" required>
        </div>
        <div class="col-md">
            <label>Apellidos</label>
            <input class="form-control" name="apellidos" value="<?php echo isset($usuario) ? $usuario['apellidos'] : '' ?>" required>
        </div>
        <div class="col-md">
            <label>Email</label>
            <input class="form-control" type="email" name="email" value="<?php echo isset($usuario) ? $usuario['email'] : '' ?>" required>

        </div>
        <div class="col-md">
            <label>Teléfono</label>
            <input class="form-control" name="telefono" value="<?php echo isset($usuario) ? $usuario['telefono'] : '' ?>">
        </div>
        <div class="col-md">
            <label>Rol</label>
            <select class="form-select" name="id_rol">
              <option></option>
              <?=html_opciones(obtener_roles($db), isset($usuario) ? $usuario['id_rol'] : '', 'id', 'nombre')?>
            </select>            
        </div>        
    </div>
    <input class="btn btn-success btn-sm mt-3" type="submit" value="Guardar">
</form>
