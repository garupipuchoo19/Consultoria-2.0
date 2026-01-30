CREATE DATABASE consultoria_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE consultoria_db;

CREATE TABLE administradores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    password_hash CHAR(64) NOT NULL,
    activo TINYINT(1) DEFAULT 1,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO administradores (nombre, correo, password_hash) VALUES
(
  'Jade Montalvo Valle',
  'montalvojadee@gmail.com',
  SHA2('JASDFG02', 256)
),
(
  'Cristopher Isaac Leon Olvera',
  'crizaak@gmail.com',
  SHA2('IsaaC1987', 256)
);

CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    origen ENUM('chatbot', 'contacto') NOT NULL
);

CREATE TABLE chatbot_mensajes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    mensaje_usuario TEXT NOT NULL,
    respuesta_bot TEXT,
    estado ENUM('pendiente', 'atendido') DEFAULT 'pendiente',
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE SET NULL
);

CREATE TABLE respuestas_admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mensaje_id INT NOT NULL,
    admin_id INT NOT NULL,
    respuesta TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (mensaje_id) REFERENCES chatbot_mensajes(id) ON DELETE CASCADE,
    FOREIGN KEY (admin_id) REFERENCES administradores(id) ON DELETE CASCADE
);
