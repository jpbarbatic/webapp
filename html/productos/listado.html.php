<h2><?php echo $titulo; ?></h2>
<a class="btn btn-secondary btn-sm" href="productos/nuevo.php">Nuevo</a>
<a class="btn btn-secondary btn-sm" href="productos/exportar.php<?= $_SERVER['QUERY_STRING'] ?? '' ?>">PDF</a>
<?php include 'filtro.html.php' ?>
<hr>
<?php if (isset($datos) and !empty($datos)): ?>
    <?php include __DIR__ . '/' . '../paginacion.html.php' ?>
    <div class="table-responsive">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th class="text-center">Stock</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $producto): ?>
                    <tr>
                        <td><?= $producto['id'] ?></td>
                        <td><?= $producto['nombre'] ?></td>
                        <td><?= $categoriasPorId[$producto['id_categoria']] ?></td>
                        <td class="text-end"><?= $producto['stock'] ?></td>
                        <td class="text-end"><?= $producto['precio'] ?></td>
                        <td class="text-center"><a class="btn btn-primary btn-sm" href="productos/editar.php?id=<?= $producto['id'] ?>">Editar</a> <button type="button" class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="<?= (int)$producto['id'] ?>">
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
