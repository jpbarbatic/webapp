<form action="productos/guardar.php" method="post">
    <div class="row mb-3">
        <div class="col-md-1">
            <label>ID</label>
            <input readonly class="form-control" name="id" value="<?php echo isset($producto) ? $producto['id'] : '' ?>">
        </div>
        <div class="col-md">
            <label>Nombre</label>
            <input required class="form-control" name="nombre" value="<?= isset($producto) ? $producto['nombre'] : '' ?>" required>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md">
            <label>Descripción</label>
            <textarea class="form-control" name="descripcion"><?= isset($item) ? $producto['descripcion'] : '' ?></textarea>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md">
            <label>Categoría</label>
            <select class="form-select" name="id_categoria">
                <option value="">-- Elija una categoría --</option>
                <?php echo html_opciones($categorias, $producto['id_categoria'], 'id', 'nombre'); ?>
            </select>
        </div>
        <div class="col-md">
            <label>Precio</label>
            <input class="form-control" name="precio" type="" value="<?= isset($producto) ? $producto['precio'] : '0.00' ?>" required>
        </div>
        <div class="col-md">
            <label>Stock</label>
            <input class="form-control" name="stock" type="number" value="<?= isset($producto) ? $producto['stock'] : 0 ?>" required>
        </div>
    </div>
    <input class="btn btn-success btn-sm mt-3" type="submit" value="Guardar">
</form>