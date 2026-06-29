<?php include __DIR__.'/../config.php'?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <base href="<?= URL_BASE ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>404 - Página no encontrada</title>
  <style>
    :root {
      --primary: #4f46e5;
      --primary-hover: #4338ca;
      --bg: #f8fafc;
      --text: #1e293b;
      --text-muted: #64748b;
      --card-bg: #ffffff;
      --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
      background: var(--bg);
      color: var(--text);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      line-height: 1.6;
    }

    .container {
      text-align: center;
      max-width: 500px;
      width: 100%;
    }

    .error-code {
      font-size: 8rem;
      font-weight: 800;
      color: var(--primary);
      line-height: 1;
      margin-bottom: 1rem;
      text-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .error-title {
      font-size: 1.875rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: var(--text);
    }

    .error-message {
      color: var(--text-muted);
      margin-bottom: 2rem;
      font-size: 1.125rem;
    }

    .home-link {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background: var(--primary);
      color: white;
      text-decoration: none;
      padding: 0.875rem 1.5rem;
      border-radius: 0.5rem;
      font-weight: 600;
      transition: background 0.2s, transform 0.1s;
      box-shadow: var(--shadow);
    }

    .home-link:hover {
      background: var(--primary-hover);
      transform: translateY(-2px);
    }

    .home-link:active {
      transform: translateY(0);
    }

    .home-link svg {
      width: 1.25rem;
      height: 1.25rem;
    }

    .decoration {
      margin: 2.5rem 0;
      display: flex;
      justify-content: center;
      gap: 0.5rem;
      opacity: 0.6;
    }

    .decoration span {
      display: inline-block;
      width: 8px;
      height: 8px;
      background: var(--primary);
      border-radius: 50%;
      animation: pulse 1.5s ease-in-out infinite;
    }

    .decoration span:nth-child(2) { animation-delay: 0.2s; }
    .decoration span:nth-child(3) { animation-delay: 0.4s; }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.3); opacity: 0.6; }
    }

    @media (max-width: 480px) {
      .error-code {
        font-size: 6rem;
      }
      .error-title {
        font-size: 1.5rem;
      }
      .error-message {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="error-code"><?= http_response_code() ?></div>
    <?php include '../html/errores/'.http_response_code().'.html.php' ?>    

    <div class="decoration">
      <span></span><span></span><span></span>
    </div>

    <a href="" class="home-link">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
      </svg>
      Volver al inicio
    </a>
  </div>

  <script>
    // Opcional: Redirigir automáticamente después de X segundos
    // setTimeout(() => { window.location.href = '/'; }, 10000);
    
    // Opcional: Registrar el error en consola para debugging
    console.warn('404: Página no encontrada en', window.location.pathname);
  </script>
</body>
</html>