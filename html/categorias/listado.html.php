<h2><?php echo $titulo; ?></h2>
<a class="btn btn-secondary btn-sm" href="productos/nuevo.php">Nuevo</a>
<a class="btn btn-secondary btn-sm" href="productos/exportar.php?<?= $_SERVER['QUERY_STRING'] ?? '' ?>">PDF</a>
<?php if (isset($datos) and !empty($datos)): ?>
    <div class="table-responsive">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <?php foreach ($datos as $producto): ?>
                <tr>
                    <td><?= $producto['id'] ?></td>
                    <td><?= $producto['nombre'] ?></td>
                    <td><a class="btn btn-primary btn-sm" href="categorias/editar.php?id=<?= $producto['id'] ?>">Editar</a> <button type="button" class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-id="<?= (int)$producto['id'] ?>">
                            <i class="bi bi-trash"></i> Eliminar
                        </button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php include __DIR__ . '/'.'../paginacion.html.php' ?>

<?php endif; ?>
