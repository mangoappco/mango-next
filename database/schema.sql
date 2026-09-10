-- Esquema base de ManGo! para MySQL/MariaDB.
-- Importa este archivo en la base de datos de cada instalación.

-- Tabla principal de usuarios.
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR(190) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL,
    nombres VARCHAR(150) NOT NULL,
    apellidos VARCHAR(150) NOT NULL,
    tipo VARCHAR(50) NOT NULL DEFAULT 'usuario',
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Tokens temporales para recuperación de contraseña.
CREATE TABLE recuperacion_contrasenas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    token_hash CHAR(64) NOT NULL UNIQUE,
    expira_en DATETIME NOT NULL,
    usado_en DATETIME NULL,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_recuperacion_usuario (usuario_id),
    INDEX idx_recuperacion_expiracion (expira_en)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Registra eventos de seguridad sin guardar contraseñas ni tokens.
CREATE TABLE registro_actividad (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NULL,
    correo VARCHAR(190) NULL,
    accion VARCHAR(80) NOT NULL,
    direccion_ip VARCHAR(45) NULL,
    agente_usuario TEXT NULL,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_actividad_usuario (usuario_id),
    INDEX idx_actividad_accion (accion),
    INDEX idx_actividad_fecha (creado_en)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

  -- Controla intentos fallidos por correo e IP, incluso entre sesiones distintas.
  CREATE TABLE intentos_login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR(190) NOT NULL,
    direccion_ip VARCHAR(45) NOT NULL,
    intentos INT NOT NULL DEFAULT 0,
    bloqueado_hasta DATETIME NULL,
    actualizado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
      ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_intentos_correo_ip (correo, direccion_ip),
    INDEX idx_intentos_bloqueo (bloqueado_hasta)
  ) ENGINE=InnoDB
    DEFAULT CHARSET=utf8mb4
    COLLATE=utf8mb4_unicode_ci;
