<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultoría Tecnológica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ===== HEADER ===== -->
<header class="header">
    <div class="container header-content">
        <h1 class="logo">Consultoría Tech</h1>
        <nav class="nav">
            <a href="#servicios">Servicios</a>
            <a href="#especializaciones">Especialización</a>
            <a href="#portafolio">Portafolio</a>
            <a href="#comentarios">Clientes</a>
            <a href="#contacto" class="btn-primary">Contacto</a>
        </nav>
    </div>
</header>

<!-- ===== HERO ===== -->
<section class="hero">
    <div class="container">
        <h2>Impulsamos soluciones tecnológicas reales</h2>
        <p>Desarrollamos sistemas, páginas web y soluciones digitales a la medida de tu empresa.</p>
        <a href="#contacto" class="btn-primary">Hablar con un asesor</a>
    </div>
</section>

<!-- ===== SERVICIOS ===== -->
<section id="servicios" class="section">
    <div class="container">
        <h2>Nuestros Servicios</h2>
        <div class="cards">
            <div class="card">Desarrollo Web</div>
            <div class="card">Sistemas a Medida</div>
            <div class="card">Soporte Técnico</div>
            <div class="card">Consultoría Tecnológica</div>
        </div>
    </div>
</section>

<!-- ===== ESPECIALIZACIONES ===== -->
<section id="especializaciones" class="section alt">
    <div class="container">
        <h2>Especializaciones</h2>
        <ul class="list">
            <li>PHP & MySQL</li>
            <li>JavaScript & Frontend</li>
            <li>Automatización de procesos</li>
            <li>Diseño UX/UI</li>
        </ul>
    </div>
</section>

<!-- ===== PORTAFOLIO ===== -->
<section id="portafolio" class="section">
    <div class="container">
        <h2>Portafolio</h2>
        <div class="cards">
            <div class="card">Sistema de Gestión</div>
            <div class="card">Plataforma Educativa</div>
            <div class="card">Página Corporativa</div>
        </div>
    </div>
</section>

<!-- ===== COMENTARIOS ===== -->
<section id="comentarios" class="section alt">
    <div class="container">
        <h2>Empresas que confiaron en nosotros</h2>
        <blockquote>
            “Excelente atención y resultados rápidos.”
            <span>— Empresa ABC</span>
        </blockquote>
        <blockquote>
            “Soluciones profesionales y soporte constante.”
            <span>— Empresa XYZ</span>
        </blockquote>
    </div>
</section>

<!-- ===== CONTACTO ===== -->
<section id="contacto" class="section">
    <div class="container">
        <h2>Contacto</h2>
        <p>Déjanos tu correo y teléfono, un asesor se pondrá en contacto contigo.</p>

        <!-- Este formulario luego lo conectamos al chatbot -->
        <form class="contact-form">
            <input type="email" placeholder="Correo electrónico" required>
            <input type="text" placeholder="Teléfono" required>
            <button type="submit">Enviar</button>
        </form>
    </div>
</section>

<!-- ===== FOOTER ===== -->
<footer class="footer">
    <div class="container">
        <p>© 2026 Consultoría Tech. Todos los derechos reservados.</p>
        <a href="login.php">Acceso Administrador</a>
    </div>
</footer>

</body>
</html>
