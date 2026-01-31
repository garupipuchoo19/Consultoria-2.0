<?php
require_once "../includes/auth.php";
require_once "../includes/conexion.php";

$clientes = $pdo->query("
  SELECT * FROM clientes
  ORDER BY fecha_registro DESC
")->fetchAll();
include "../includes/header.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Clientes - Admin</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="admin-header">
  <h2>Clientes registrados</h2>
  <a href="dashboard.php">⬅ Volver al Dashboard</a>
</header>

<section class="container">

  <?php if (count($clientes) === 0): ?>
    <p>No hay clientes registrados aún.</p>
  <?php else: ?>

  <div class="table-wrapper">
    <table class="admin-table">
      <thead>
        <tr>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Origen</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($clientes as $c): ?>
        <tr>
          <td><?= htmlspecialchars($c['correo']) ?></td>
          <td><?= htmlspecialchars($c['telefono']) ?></td>
          <td>
            <span class="badge <?= $c['origen'] ?>">
              <?= ucfirst($c['origen']) ?>
            </span>
          </td>
          <td><?= $c['fecha_registro'] ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <?php endif; ?>

</section>

</body>
</html>
