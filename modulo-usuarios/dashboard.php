<?php
session_start();
include("../config/conexion.php");

if (!isset($_SESSION["id_usuario"])) {
    header("Location: login.php");
    exit;
}

$servicios = $conexion->query("SELECT id_servicio, nombre FROM servicios WHERE activo = 1");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<div class="contenedor-form">
    <h2>Bienvenido, <?= $_SESSION["nombre"] ?></h2>
    <p>Selecciona un servicio y envíanos tu solicitud</p>

    <form id="formMensaje">
        <label>Servicio</label>
        <select id="servicio" required>
            <option value="">Selecciona un servicio</option>
            <?php while ($s = $servicios->fetch_assoc()): ?>
                <option value="<?= $s["id_servicio"] ?>">
                    <?= $s["nombre"] ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label>Mensaje</label>
        <textarea id="mensaje" placeholder="Describe tu necesidad" required></textarea>

        <button type="submit">Enviar mensaje</button>
    </form>

    <div id="respuesta"></div>
</div>

<script src="../js/mensaje.js"></script>
</body>
</html>
