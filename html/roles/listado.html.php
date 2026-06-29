<h2><?php echo $titulo; ?></h2>
<a class="btn btn-secondary btn-sm" href="productos/nuevo.php">Nuevo</a>
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
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $rol): ?>
                    <tr>
                        <td><?= $rol['id'] ?></td>
                        <td><?= $rol['nombre'] ?></td>
                        <td><?= $rol['descripcion'] ?></td>

                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php include __DIR__ . '/' . '../paginacion.html.php' ?>
    <?php include __DIR__ . '/' . '../confirmacion.borrado.html.php' ?>

<?php endif; ?>
