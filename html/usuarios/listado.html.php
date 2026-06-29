<h2><?php echo $titulo; ?></h2>
<a class="btn btn-secondary btn-sm" href="usuarios/nuevo.php">Nuevo</a>
<a class="btn btn-secondary btn-sm" href="usuarios/nuevo.php">PDF</a>
<?php if (isset($datos) and !empty($datos)): ?>
    <div class="table-responsive">
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <?php foreach ($datos as $usuario): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= $usuario['nombre'] ?></td>
                    <td><?= $usuario['apellidos'] ?></td>
                    <td><?= $usuario['telefono'] ?></td>
                    <td><a href="mailto:<?= $usuario['email'] ?>" target="_blank"><?= $usuario['email'] ?></a></td>
                    <td><a class="btn btn-primary btn-sm" href="usuarios/<?= $usuario['id'] ?>">Editar</a> <button type="button" class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-id="<?= (int)$usuario['id'] ?>">
                            <i class="bi bi-trash"></i> Eliminar
                        </button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <?php include __DIR__ . '/'.'../paginacion.html.php' ?>
    <?php include __DIR__ . '/'.'../confirmacion.borrado.html.php' ?>
    
<?php endif; ?> 
