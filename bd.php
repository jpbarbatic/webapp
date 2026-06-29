<?php
require 'config.php';
require 'includes/db_pdo.php';

if($_SERVER['REQUEST_METHOD']==='POST'){

  try {
      $pdo = db_open();

      // 2. Leer el fichero SQL
      $sql_file = $_REQUEST['fichero']; // Reemplaza con la ruta de tu archivo
      $sql_contenido = file_get_contents($sql_file);

      if ($sql_contenido === false) {
          die("Error al leer el archivo SQL.");
      }

      // 3. Opcional: Dividir el contenido por punto y coma (;)
      // Esto es necesario si el archivo contiene múltiples instrucciones
      $sentencias = array_filter(array_map('trim', explode(';', $sql_contenido)));

      // 4. Ejecutar cada sentencia
      foreach ($sentencias as $sentencia) {
          if (!empty($sentencia)) {
              $pdo->exec($sentencia);
          }
      }

      $mensaje="Fichero SQL ejecutado exitosamente.";

  } catch (PDOException $e) {
      echo "Error en la base de datos: " . $e->getMessage();
      exit;
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carga de Base de Datos</title>
  <style>
    body {
      font-family: system-ui, -apple-system, sans-serif;
      max-width: 400px;
      margin: 2rem auto;
      padding: 1rem;
      background-color: #f9f9f9;
      color: #333;
    }
    form {
      background: white;
      padding: 1.5rem;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .radio-group {
      margin-bottom: 1.5rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }
    
    input{
      border-radius: 10px;
    }
    
    input[type="radio"] {
      width: 1.2rem;
      height: 1.2rem;
      cursor: pointer;
    }
    label {
      cursor: pointer;
      font-weight: 500;
    }
    input[type="submit"] {
      width: 100%;
      padding: 0.75rem;
      background-color: #0066cc;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.2s;
    }
    input[type="submit"]:hover {
      background-color: #0052a3;
    }
    .status-msg {
      margin-top: 1rem;
      padding: 0.75rem;
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
      border-radius: 4px;
      text-align: center;
    }
  </style>
</head>
<body>

  <main>
  <h1>Restaurar Base de Datos</h1>
    <form action="" method="post">
      <table>
      <tr>
        <td><label>Host </label></td>
        <td><input value="<?=DB_HOST?>"></td>
      </tr>
      <tr>
        <td><label>Nombre bd </label></td>
        <td><input value="<?=DB_NAME?>"></td>
      </tr> 
      <tr>
        <td><label>Usuario </label></td>
        <td><input value="<?=DB_USER?>"></td>
      </tr>
      <tr>
        <td><label>Password </label></td>
        <td><input value="<?=DB_PASS?>"></td>
       </tr>
       <tr>
        <td><label>Puerto </label></td>
        <td><input value="<?=DB_PORT?>"></td>
        </tr>
      </table>
      <div class="radio-group">
          <?php foreach (glob("*.sql") as $filename): ?>
          <input type="radio" name="fichero" value="<?=$filename?>"><label><?=$filename?></label>
          <?php endforeach; ?>
      </div>      
      <input type="submit" value="Cargar Fichero">
    </form>
    <?php if(isset($mensaje)): ?>
    <p class="status-msg" role="alert">Fichero SQL ejecutado exitosamente.</p>
    <?php endif; ?>
  </main>

</body>
</html>
