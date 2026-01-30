<?php
require_once "../includes/auth.php";
require_once "../includes/conexion.php";

// MÉTRICAS
$totalClientes = $pdo->query("SELECT COUNT(*) FROM clientes")->fetchColumn();
$totalMensajes = $pdo->query("SELECT COUNT(*) FROM chatbot_mensajes")->fetchColumn();
$pendientes = $pdo->query("SELECT COUNT(*) FROM chatbot_mensajes WHERE estado='pendiente'")->fetchColumn();
$atendidos = $pdo->query("SELECT COUNT(*) FROM chatbot_mensajes WHERE estado='atendido'")->fetchColumn();
$totalCorreos = $pdo->query("SELECT COUNT(*) FROM correos_enviados")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - Admin</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="admin-header">
  <h2>Panel Administrativo</h2>
  <div>
    <span>👤 <?= $_SESSION['admin_nombre']; ?></span>
    <a href="../logout.php">Cerrar sesión</a>
  </div>
</header>

<section class="container">

  <div class="dashboard-cards">

    <div class="dash-card">
      <h3><?= $totalClientes ?></h3>
      <p>Clientes registrados</p>
    </div>

    <div class="dash-card">
      <h3><?= $totalMensajes ?></h3>
      <p>Mensajes recibidos</p>
    </div>

    <div class="dash-card">
      <h3><?= $pendientes ?></h3>
      <p>Mensajes pendientes</p>
    </div>

    <div class="dash-card">
      <h3><?= $atendidos ?></h3>
      <p>Mensajes atendidos</p>
    </div>

    <div class="dash-card">
      <h3><?= $totalCorreos ?></h3>
      <p>Correos enviados</p>
    </div>

  </div>

  <div class="dashboard-actions">
    <a href="chatbot.php" class="btn-primary">💬 Ver Chatbot</a>
    <a href="clientes.php" class="btn-primary">👥 Ver Clientes</a>
  </div>

</section>

</body>
</html>
