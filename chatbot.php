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

  <!-- Datos del cliente -->
    <div id="lead-form" class="lead-form">
    <input type="email" id="correo" placeholder="Tu correo" required>
    <input type="text" id="telefono" placeholder="Tu teléfono" required>

    <!-- BOTÓN CLAVE -->
    <button id="btnConfirmar">Confirmar e iniciar chat</button>
    </div>

  <!-- Entrada de mensajes -->
    <div id="chat-input" class="chat-input hidden">
    <input 
        type="text" 
        id="mensaje" 
        placeholder="Escribe tu mensaje..." 
        disabled
    >
    <button id="btnEnviar" disabled>Enviar</button>
    </div>

</div>

<script src="js/chatbot.js"></script>
</body>
</html>
