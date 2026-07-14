<h2><?php echo $titulo; ?></h2>
<a class="btn btn-secondary btn-sm" href="pedidos/nuevo.php">Nuevo</a>
<a class="btn btn-secondary btn-sm" href="<?= ruta('pedidos/pdf', true, null) ?>">PDF</a>

<hr>
<?php if (isset($datos)): ?>
    <?php include __DIR__ . '/' . '../paginacion.html.php' ?>
    <div class="table-responsive">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Importe</th>
                    <th>Estado</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $pedido): ?>
                    <tr>
                        <td><?= $pedido['id'] ?></td>
                        <td><?= $pedido['fecha'] ?></td>
                        <td><?= $pedido['importe'] ?></td>
                        <td><?= $estados_pedidos[$pedido['estado']] ?></td>
                        <td class="text-center"><a class="btn btn-primary btn-sm" href="pedidos/<?= $pedido['id'] ?>">Editar</a> <button type="button" class="btn btn-danger btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                data-id="<?= (int)$pedido['id'] ?>">
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
