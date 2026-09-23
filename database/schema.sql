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
    foto_perfil VARCHAR(255) NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Catálogo de marcas o franquicias.
CREATE TABLE marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(120) NOT NULL,
    slug VARCHAR(140) NOT NULL UNIQUE,
    descripcion VARCHAR(255) NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

INSERT INTO marcas (nombre, slug, descripcion) VALUES
    ('Marca principal', 'marca-principal', 'Marca inicial para comenzar a crear locales.');

-- Catálogo de roles del sistema.
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    slug VARCHAR(80) NOT NULL UNIQUE,
    nombre VARCHAR(120) NOT NULL,
    descripcion VARCHAR(255) NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Puntos de venta asociados a una marca.
CREATE TABLE locales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marca_id INT NOT NULL,
    codigo VARCHAR(50) NULL UNIQUE,
    nombre VARCHAR(150) NOT NULL,
    direccion VARCHAR(200) NOT NULL,
    telefono VARCHAR(20) NULL,
    ciudad VARCHAR(100) NULL,
    barrio VARCHAR(100) NULL,
    tipo_local VARCHAR(50) NOT NULL DEFAULT 'sucursal',
    apertura TIME NULL,
    cierre TIME NULL,
    propina_porcentaje DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    imagen VARCHAR(255) NULL,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_locales_marca (marca_id),
    INDEX idx_locales_activo (activo),
    CONSTRAINT fk_locales_marca
        FOREIGN KEY (marca_id) REFERENCES marcas (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

-- Asignación de usuarios a locales y roles, útil para operación multi-sede.
CREATE TABLE usuario_locales (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    local_id INT NOT NULL,
    rol_id INT NOT NULL,
    es_principal TINYINT(1) NOT NULL DEFAULT 0,
    activo TINYINT(1) NOT NULL DEFAULT 1,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    actualizado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY uq_usuario_local (usuario_id, local_id),
    INDEX idx_usuario_local_usuario (usuario_id),
    INDEX idx_usuario_local_local (local_id),
    INDEX idx_usuario_local_rol (rol_id),
    CONSTRAINT fk_usuario_locales_usuario
        FOREIGN KEY (usuario_id) REFERENCES usuarios (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_usuario_locales_local
        FOREIGN KEY (local_id) REFERENCES locales (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT fk_usuario_locales_rol
        FOREIGN KEY (rol_id) REFERENCES roles (id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_unicode_ci;

INSERT INTO roles (slug, nombre, descripcion) VALUES
    ('superadmin', 'Super administrador', 'Acceso total al sistema y a todas las sedes.'),
    ('administrador_local', 'Administrador local', 'Gestiona una sede o varias sedes asignadas.'),
    ('cajero', 'Cajero', 'Opera caja, cobros y aperturas de turno.'),
    ('mesero', 'Mesero', 'Atiende mesas y pedidos en sala.'),
    ('cocinero', 'Cocinero', 'Gestiona la preparación de pedidos en cocina.');

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
