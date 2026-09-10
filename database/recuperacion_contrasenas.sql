-- Guarda tokens temporales para recuperar contraseñas.
CREATE TABLE recuperacion_contrasenas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    token_hash CHAR(64) NOT NULL UNIQUE,
    expira_en DATETIME NOT NULL,
    usado_en DATETIME NULL,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);