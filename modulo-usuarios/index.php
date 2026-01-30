<?php
include("../config/conexion.php");

$servicios = $conexion->query("SELECT nombre, descripcion FROM servicios WHERE activo = 1");
$contactos = $conexion->query("SELECT * FROM contactos");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultoría Empresarial</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>

<header class="header-principal">
    <h1>Consultoría Empresarial</h1>
    <p>Soluciones tecnológicas que impulsan tu negocio</p>
    <a href="modulo-usuarios/login.php" class="btn-principal">Iniciar sesión</a>
</header>

<section class="seccion">
    <h2>¿Quiénes somos?</h2>
    <p>
        Somos una empresa de consultoría especializada en soluciones tecnológicas,
        orientadas a mejorar procesos, fortalecer la seguridad informática y apoyar
        la toma de decisiones estratégicas en las organizaciones.
    </p>
</section>

<section class="seccion">
    <h2>Misión</h2>
    <p>
        Brindar servicios de consultoría de alta calidad que permitan a nuestros clientes
        optimizar sus recursos mediante el uso eficiente de la tecnología.
    </p>

    <h2>Visión</h2>
    <p>
        Ser una empresa líder en consultoría tecnológica, reconocida por su compromiso,
        innovación y excelencia profesional.
    </p>
</section>

<section class="seccion">
    <h2>Servicios</h2>

    <div class="contenedor-servicios">
        <?php while ($s = $servicios->fetch_assoc()): ?>
            <div class="card-servicio">
                <h3><?= $s["nombre"] ?></h3>
                <p><?= $s["descripcion"] ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</section>

<section class="seccion">
    <h2>Contáctanos</h2>

    <?php while ($c = $contactos->fetch_assoc()): ?>
        <p><strong><?= ucfirst($c["tipo"]) ?>:</strong> <?= $c["valor"] ?></p>
    <?php endwhile; ?>
</section>

<section class="seccion">
    <h2>Visítanos</h2>

    <iframe
        class="mapa"
        src="https://www.google.com/maps?q=Ciudad+de+México&output=embed">
    </iframe>
</section>

<footer class="footer">
    <p>&copy; <?= date("Y") ?> Consultoría Empresarial. Todos los derechos reservados.</p>
</footer>

</body>
</html>
