-- =========================
-- CREACIÓN DE LA BASE DE DATOS
-- =========================
CREATE DATABASE IF NOT EXISTS Consultoria;
USE Consultoria;

-- =========================
-- TABLA: Usuarios
-- =========================
CREATE TABLE usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    telefono VARCHAR(20),
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- TABLA: Servicios
-- =========================
CREATE TABLE servicios (
    id_servicio INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT NOT NULL,
    activo BOOLEAN DEFAULT TRUE
);

-- =========================
-- TABLA: Especializaciones
-- =========================
CREATE TABLE especializaciones (
    id_especializacion INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT
);

-- =========================
-- RELACIÓN: Servicios - Especializaciones
-- =========================
CREATE TABLE servicio_especializacion (
    id_servicio INT NOT NULL,
    id_especializacion INT NOT NULL,
    PRIMARY KEY (id_servicio, id_especializacion),
    FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio),
    FOREIGN KEY (id_especializacion) REFERENCES especializaciones(id_especializacion)
);

-- =========================
-- TABLA: Proyectos (Portafolio)
-- =========================
CREATE TABLE proyectos (
    id_proyecto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(150) NOT NULL,
    descripcion TEXT,
    empresa VARCHAR(150),
    fecha_inicio DATE,
    fecha_fin DATE
);

-- =========================
-- TABLA: Comentarios de Empresas
-- =========================
CREATE TABLE comentarios_empresas (
    id_comentario INT AUTO_INCREMENT PRIMARY KEY,
    id_proyecto INT NOT NULL,
    empresa VARCHAR(150) NOT NULL,
    comentario TEXT NOT NULL,
    calificacion INT CHECK (calificacion BETWEEN 1 AND 5),
    FOREIGN KEY (id_proyecto) REFERENCES proyectos(id_proyecto)
);

-- =========================
-- TABLA: Contactos (Correos y Teléfonos)
-- =========================
CREATE TABLE contactos (
    id_contacto INT AUTO_INCREMENT PRIMARY KEY,
    tipo ENUM('telefono', 'correo') NOT NULL,
    valor VARCHAR(150) NOT NULL
);

-- =========================
-- TABLA: Mensajes de Clientes (Chat)
-- =========================
CREATE TABLE mensajes_clientes (
    id_mensaje INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_servicio INT NOT NULL,
    mensaje TEXT NOT NULL,
    fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario),
    FOREIGN KEY (id_servicio) REFERENCES servicios(id_servicio)
);

-- =========================
-- TABLA: Posibles Clientes
-- (Solo usuarios que preguntaron por servicios)
-- =========================
CREATE TABLE posibles_clientes (
    id_posible_cliente INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL UNIQUE,
    fecha_contacto DATETIME DEFAULT CURRENT_TIMESTAMP,
    estado ENUM('nuevo', 'en seguimiento', 'cerrado') DEFAULT 'nuevo',
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);

-- =========================
-- TABLA: Administradores
-- =========================
CREATE TABLE administradores (
    id_admin INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('admin', 'superadmin') DEFAULT 'admin'
);

-- =========================
-- TRIGGER:
-- Cuando un usuario envía un mensaje,
-- automáticamente se convierte en posible cliente
-- =========================
DELIMITER $$

CREATE TRIGGER trg_insert_posible_cliente
AFTER INSERT ON mensajes_clientes
FOR EACH ROW
BEGIN
    INSERT IGNORE INTO posibles_clientes (id_usuario)
    VALUES (NEW.id_usuario);
END$$

DELIMITER ;


-- =========================
-- INCERTS DE EJEMPLO
-- =========================

INSERT INTO usuarios (nombre, correo, telefono) VALUES
('Ana López', 'ana.lopez@mail.com', '5512345678'),
('Carlos Méndez', 'carlos.mendez@mail.com', '5523456789'),
('Lucía Ramírez', 'lucia.ramirez@mail.com', '5534567890'),
('Jorge Torres', 'jorge.torres@mail.com', '5545678901'),
('María Fernández', 'maria.fernandez@mail.com', '5556789012');

INSERT INTO servicios (nombre, descripcion) VALUES
('Consultoría en Sistemas', 'Análisis y mejora de sistemas de información'),
('Ciberseguridad', 'Auditorías y protección de infraestructura digital'),
('Desarrollo de Software', 'Soluciones de software a medida'),
('Análisis de Datos', 'Procesamiento e interpretación de datos empresariales'),
('Soporte Tecnológico', 'Mantenimiento y soporte técnico especializado');

INSERT INTO especializaciones (nombre, descripcion) VALUES
('Sistemas Empresariales', 'Optimización de sistemas corporativos'),
('Seguridad Informática', 'Protección de datos y redes'),
('Desarrollo Web', 'Aplicaciones web modernas'),
('Business Intelligence', 'Análisis estratégico de información'),
('Infraestructura TI', 'Gestión de hardware y redes');

INSERT INTO servicio_especializacion VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

INSERT INTO proyectos (nombre, descripcion, empresa, fecha_inicio, fecha_fin) VALUES
('Sistema ERP', 'Implementación de ERP empresarial', 'Empresa Alpha', '2024-01-10', '2024-06-15'),
('Auditoría de Seguridad', 'Evaluación de seguridad informática', 'TechSecure', '2024-02-01', '2024-03-20'),
('Plataforma Web', 'Desarrollo de portal corporativo', 'WebCorp', '2023-11-05', '2024-02-28'),
('Dashboard BI', 'Panel de control de datos', 'DataVision', '2024-03-01', '2024-05-30'),
('Soporte TI', 'Mantenimiento de infraestructura', 'NetSolutions', '2023-09-01', '2024-01-31');

INSERT INTO comentarios_empresas (id_proyecto, empresa, comentario, calificacion) VALUES
(1, 'Empresa Alpha', 'El sistema mejoró notablemente nuestra operación.', 5),
(2, 'TechSecure', 'Auditoría clara y bien documentada.', 4),
(3, 'WebCorp', 'La plataforma cumplió con todas las expectativas.', 5),
(4, 'DataVision', 'Excelente análisis y visualización de datos.', 5),
(5, 'NetSolutions', 'Soporte eficiente y rápido.', 4);

INSERT INTO contactos (tipo, valor) VALUES
('telefono', '5511122233'),
('telefono', '5522233344'),
('correo', 'contacto@consultoria.com'),
('correo', 'soporte@consultoria.com'),
('correo', 'ventas@consultoria.com');

INSERT INTO mensajes_clientes (id_usuario, id_servicio, mensaje) VALUES
(1, 1, 'Me interesa mejorar el sistema de mi empresa'),
(2, 2, 'Quisiera una auditoría de seguridad'),
(3, 3, 'Busco desarrollar una aplicación web'),
(4, 4, 'Necesito análisis de datos para mi negocio'),
(5, 5, 'Requiero soporte técnico constante');
