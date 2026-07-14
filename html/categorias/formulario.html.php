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
        <div class="col-md">
            <label>Depende de</label>
            <select class="form-select" name="categoria_padre">
                <option value="">Ninguna</option>
                <?php $t=0; foreach($categorias as $c): ?>
                <?php if($c['categoria_padre']!=null) $t++; else $t=0; ?>
                <?php $selected=(isset($categoria) and $categoria['categoria_padre']===$c['id']) ? 'selected' : ''?>
                <option <?= $selected ?> value="<?= $c['id'] ?>"><?= str_repeat('-', $t).' '.$c['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>    
    <input class="btn btn-success btn-sm mt-3" type="submit" value="Guardar">
</form>