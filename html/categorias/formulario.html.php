<hr>
<form action="categorias/guardar.php" method="post">
    <div class="row mb-3">
        <div class="col-md-1">
            <label>ID</label>
            <input readonly class="form-control" name="id" value="<?php echo isset($categoria) ? $categoria['id'] : '' ?>">
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <label>Nombre</label>
            <input class="form-control" name="nombre" value="<?php echo isset($categoria) ? $categoria['nombre'] : '' ?>" required>
        </div>
    </div>
    <input class="btn btn-success btn-sm mt-3" type="submit" value="Guardar">
</form>