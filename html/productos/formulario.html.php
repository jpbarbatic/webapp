<form action="productos/<?= empty($producto['id']) ? 'crear' :'guardar'?>.php" method="post">
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
            <textarea class="form-control" name="descripcion"><?= isset($producto) ? $producto['descripcion'] : '' ?></textarea>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md">
            <label>Categoría</label>
            <select class="form-select" name="id_categoria">
                <option value="">-- Elija una categoría --</option>
                <?php $t=0; foreach($categorias as $categoria): ?>
                <?php if($categoria['categoria_padre']!=null) $t++; else $t=0; ?>
                <?php $selected=(isset($producto) and $categoria['id']===$producto['id_categoria']) ? 'selected' : ''?>
                <option <?= $selected ?> value="<?= $categoria['id'] ?>"><?= str_repeat('-', $t).' '.$categoria['nombre'] ?></option>
                <?php endforeach; ?>
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
