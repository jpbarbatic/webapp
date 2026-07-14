<script>
document.addEventListener('DOMContentLoaded', () => {
  const deleteModal = document.getElementById('deleteModal');
  const modalRecordId = document.getElementById('modalRecordId');
  const deleteForm = document.getElementById('deleteForm');
  const btnConfirm = document.getElementById('btnConfirmDelete');
  const btnSpinner = document.getElementById('btnSpinner');

  // 1. Cuando el modal se abre, captura el ID del botón que lo activó
  deleteModal.addEventListener('show.bs.modal', (event) => {
    const button = event.relatedTarget; // Botón clickeado
    const recordId = button.getAttribute('data-id');
    modalRecordId.value = recordId;
  });

  // 2. Al enviar el formulario, mostrar loading y evitar doble clic
  deleteForm.addEventListener('submit', () => {
    btnConfirm.disabled = true;
    btnSpinner.classList.remove('d-none');
  });
});
</script>

<script src="assets/baguettebox.js/dist/baguetteBox.min.js" async></script>
<script>
window.addEventListener('load', function() {
  baguetteBox.run('.gallery');
});
</script>