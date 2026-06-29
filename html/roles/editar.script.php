<script>
document.addEventListener("DOMContentLoaded", () => {
    const checkboxes = document.querySelectorAll('input[name="permisos[]"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const permisoId = this.value;

            // --- SI MARCO EL CHECKBOX: Marcar su padre ---
            if (this.checked) {
                const padreId = this.dataset.depende;
                if (padreId) {
                    const checkboxPadre = document.querySelector(`input[name="permisos[]"][value="${padreId}"]`);
                    if (checkboxPadre && !checkboxPadre.checked) {
                        checkboxPadre.checked = true;
                        // Disparamos el evento 'change' en el padre por si tiene más dependencias hacia arriba
                        checkboxPadre.dispatchEvent(new Event('change'));
                    }
                }
            } 
            // --- SI DESMARCO EL CHECKBOX: Desmarcar sus hijos ---
            else {
                // Buscamos cualquier checkbox cuyo 'data-depende' sea igual al ID que acabo de desmarcar
                const checkboxesHijos = document.querySelectorAll(`input[name="permisos[]"][data-depende="${permisoId}"]`);
                checkboxesHijos.forEach(checkboxHijo => {
                    if (checkboxHijo.checked) {
                        checkboxHijo.checked = false;
                        // Disparamos el evento en el hijo por si tiene sub-hijos hacia abajo
                        checkboxHijo.dispatchEvent(new Event('change'));
                    }
                });
            }
        });
    });
});
</script>

