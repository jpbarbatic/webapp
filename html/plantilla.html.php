<!doctype html>
<html lang="es">
<?php include 'head.html.php' ?>

<body>
    <?php include "nav.html.php" ?>
    <main class="container">
        <?php include "mensajes.html.php" ?>
        <?php if (file_exists(__DIR__ . '/' . $vista . ".html.php")) {
            include __DIR__ . '/' . $vista . ".html.php";
        } ?>
        <button id="btn-notificaciones">Activar Notificaciones</button>
    </main>

    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <!--<img src="..." class="rounded me-2" alt="..."> -->
                <strong class="me-auto">Notificación</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Nuevo pedido
            </div>
        </div>
    </div>

    <script src="assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <?php include __DIR__ . '/comun.script.php'; ?>
    <?php if (file_exists(__DIR__ . '/' . $vista . ".script.php")) {
        include __DIR__ . '/' . $vista . ".script.php";
    } ?>
    <script>
        async function actualizarPedidos() {
            try {
                const respuesta = await fetch('api/num_pedidos_recientes.php');
                const json = await respuesta.json();
                console.log('Pedidos actuales:', json.datos);
                if (json.datos >= 0) {
                    document.getElementById('num_pedidos').innerText = json.datos;
                    /*
                    const toastElement = document.getElementById('liveToast');
                    const toast = new bootstrap.Toast(toastElement);
                    toast.show();*/

                    /*var notification = new Notification("Nuevo pedido", {
                        body: "Las notificaciones locales se han activado con éxito.",
                        icon: "ruta/al/icono.png"
                    });*/
                }

                // Aquí actualizarías el DOM con los datos recibidos
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // Ejecutar cada minuto (60000 milisegundos)
        actualizarPedidos();
        setInterval(actualizarPedidos, 60000);

        // 1. Verificar si el navegador soporta notificaciones
        if (!('Notification' in window)) {
            console.log("Este navegador no soporta notificaciones");
        } else {
            // Seleccionar el botón del HTML
            const boton = document.getElementById('btn-notificaciones');

            // Escuchar el clic del usuario (acción requerida por el navegador)
            boton.addEventListener('click', function() {

                // 2. Solicitar permiso al usuario dentro del evento click
                Notification.requestPermission().then(function(permission) {
                    if (permission === 'granted') {
                        console.log("¡Permiso concedido por el usuario!");

                        // Opcional: Ocultar el botón ya que tenemos el permiso
                        boton.style.display = 'none';

                        // 3. Crear y lanzar la notificación básica
                        var notification = new Notification("¡Gracias!", {
                            body: "Las notificaciones locales se han activado con éxito.",
                            icon: "ruta/al/icono.png"
                        });

                        // 4. Añadir acción al hacer clic en la alerta
                        notification.onclick = function() {
                            window.open("https://tusitio.com");
                        };

                    } else if (permission === 'denied') {
                        console.warn("El usuario ha rechazado las notificaciones.");
                    }
                });

            });
        }
    </script>
</body>

</html>
<?php unset($_SESSION['mensaje']); ?>