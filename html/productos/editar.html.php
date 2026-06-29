<h2><?php echo $titulo; ?></h2>
<button type="button" class="btn btn-danger btn-sm"
    data-bs-toggle="modal"
    data-bs-target="#deleteModal"
    data-id="<?= (int)$producto['id'] ?>">
    <i class="bi bi-trash"></i> Eliminar
</button>
<hr>
<?php require "formulario.html.php" ?>
<hr>
<form action="productos/subir_fotos.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $producto['id'] ?>">
    <div class="row">
        <div class="col">
            <input class="form-control" type="file" name="fotos[]" multiple accept="image/png, image/jpeg">
        </div>
        <div class="col">
            <input class="btn btn-primary" type="submit" value="Subir">
        </div>
    </div>
</form>
<div class="row mt-3">
    <div class="col">
        <?php for ($i = 1; $i <= $producto['num_fotos']; $i++): ?>
            <img style="height: 100px;" class="img-thumbnail" src="imagenes/productos/<?= $producto['id'] ?>/<?= $i ?>.jpg">
        <?php endfor; ?>
    </div>
</div>