<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Chat Soporte</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="chat-widget">

  <div class="chat-header">💬 Soporte en línea</div>

  <div id="chat-messages" class="chat-messages"></div>

  <!-- Datos del cliente (opcional) -->
<div class="lead-form">
  <input type="email" id="correo" placeholder="Tu correo (opcional)">
  <input type="text" id="telefono" placeholder="Tu teléfono (opcional)">
  <button id="btnGuardar" type="button">Guardar datos</button>
</div>

<!-- Chat siempre activo -->
<div class="chat-input">
  <input type="text" id="mensaje" placeholder="Escribe tu mensaje...">
  <button id="btnEnviar" type="button">Enviar</button>
</div>

</div>

<script src="js/chatbot.js"></script>
</body>
</html>
