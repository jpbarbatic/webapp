<h2><?php echo $titulo; ?></h2>
<a class="btn btn-secondary btn-sm" href="roles/nuevo.php">Nuevo</a>
<hr>
<?php if (isset($datos) and !empty($datos)): ?>
    <?php include __DIR__ . '/' . '../paginacion.html.php' ?>
    <div class="table-responsive">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $rol): ?>
                    <tr>
                        <td><?= $rol['id'] ?></td>
                        <td><?= $rol['nombre'] ?></td>
                        <td><?= $rol['descripcion'] ?></td>
                        <td><a class="btn btn-primary btn-sm" href="roles/<?= $rol['id'] ?>">Editar</a> <button type="button" class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="<?= (int)$rol['id'] ?>">
                                <i class="bi bi-trash"></i> Eliminar
                            </button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include __DIR__ . '/' . '../paginacion.html.php' ?>
    <?php include __DIR__ . '/' . '../confirmacion.borrado.html.php' ?>

<?php endif; ?>