<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <!-- Bootstrap 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      font-family: system-ui, -apple-system, sans-serif;
    }
    .login-card {
      background: white;
      border-radius: 1rem;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }
    .login-header {
      background: linear-gradient(135deg, #4361ee 0%, #3a0ca3 100%);
      color: white;
      padding: 2rem;
      text-align: center;
    }
    .login-body { padding: 2rem; }
    .btn-login {
      background: #4361ee;
      border: none;
      transition: all 0.3s ease;
    }
    .btn-login:hover {
      background: #3a56d4;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(67, 97, 238, 0.3);
    }
    .form-control:focus, .form-check-input:checked {
      border-color: #4361ee;
      box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
    }
    .input-group-text { background-color: #f8f9fa; }
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-8 col-md-6 col-lg-4">
        <div class="login-card">
          <!-- Encabezado -->
          <div class="login-header">
            <i class="bi bi-shield-lock fs-1"></i>
            <h2 class="mt-2 mb-0">Bienvenido</h2>
            <p class="mb-0 opacity-75">Ingresa tus credenciales para continuar</p>
          </div>

          <!-- Formulario -->
          <div class="login-body">
            <form action="login.php" method="POST">
              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                  <input type="email" class="form-control" id="email" name="email" placeholder="tu@email.com" autocomplete="email" required>
                </div>
              </div>

              <!-- Contraseña -->
              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                  <span class="input-group-text"><i class="bi bi-lock"></i></span>
                  <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" autocomplete="current-password" required>
                  <button class="btn btn-outline-secondary" type="button" id="togglePassword" aria-label="Mostrar contraseña">
                    <i class="bi bi-eye"></i>
                  </button>
                </div>
              </div>

              <!-- Recordar & Olvidé contraseña -->
              <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="remember" name="remember">
                  <label class="form-check-label" for="remember">Recordarme</label>
                </div>
                <a href="#" class="text-decoration-none small text-muted">¿Olvidaste tu contraseña?</a>
              </div>

              <!-- Botón Submit -->
              <button type="submit" class="btn btn-primary btn-login w-100 py-2 fw-semibold">
                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
              </button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Script para mostrar/ocultar contraseña -->
  <script>
    document.getElementById('togglePassword').addEventListener('click', function () {
      const pwd = document.getElementById('password');
      const icon = this.querySelector('i');
      if (pwd.type === 'password') {
        pwd.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
      } else {
        pwd.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
      }
    });
  </script>
</body>
</html>