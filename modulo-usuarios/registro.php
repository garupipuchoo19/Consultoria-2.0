<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<div class="contenedor-form">
    <h2>Registro de Usuario</h2>

    <form id="formRegistro">
        <input type="text" id="nombre" placeholder="Nombre completo" required>
        <input type="email" id="correo" placeholder="Correo electrónico" required>
        <input type="text" id="telefono" placeholder="Teléfono">
        <button type="submit">Registrarme</button>
    </form>

    <div id="respuesta"></div>
    <p><a href="login.php">Volver al login</a></p>
</div>

<script src="../js/registro.js"></script>
</body>
</html>
