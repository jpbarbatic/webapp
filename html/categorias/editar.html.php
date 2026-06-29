<h2><?php echo $titulo; ?></h2>
<button type="button" class="btn btn-danger btn-sm"
                            data-bs-toggle="modal"
                            data-bs-target="#deleteModal"
                            data-id="<?= (int)$categoria['id'] ?>">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
<?php require "formulario.html.php" ?>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="deleteForm" method="POST" action="usuarios/borrar.php">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel">⚠️ Confirmar eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este registro? <strong>Esta acción es irreversible.</strong></p>
                    <input type="hidden" name="id" id="modalRecordId">
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" id="btnConfirmDelete">
                        <span class="spinner-border spinner-border-sm d-none" id="btnSpinner"></span>
                        Sí, eliminar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>