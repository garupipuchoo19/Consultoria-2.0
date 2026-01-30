<?php
require_once "../includes/auth.php";
require_once "../includes/conexion.php";

$mensajes = $pdo->query("
  SELECT cm.*, c.correo 
  FROM chatbot_mensajes cm
  LEFT JOIN clientes c ON c.id = cm.cliente_id
  ORDER BY cm.fecha DESC
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Chatbot - Admin</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header class="admin-header">
  <h2>Mensajes del Chatbot</h2>
  <a href="dashboard.php">⬅ Volver al Dashboard</a>
</header>

<section class="container">

<?php if (count($mensajes) === 0): ?>
  <p>No hay mensajes aún.</p>
<?php endif; ?>

<?php foreach ($mensajes as $m): ?>
  <div class="chat-admin-card">

    <p class="chat-admin-client">
      👤 <?= htmlspecialchars($m['correo'] ?? 'Cliente anónimo') ?>
    </p>

    <div class="chat-msg">
      <?= htmlspecialchars($m['mensaje_usuario']) ?>
    </div>

    <form action="responder.php" method="POST">
      <input type="hidden" name="mensaje_id" value="<?= $m['id'] ?>">
      <textarea 
        name="respuesta" 
        placeholder="Escribe la respuesta de soporte..."
        required></textarea>

      <button class="btn-primary">Responder</button>
    </form>

  </div>
<?php endforeach; ?>

</section>

</body>
</html>
