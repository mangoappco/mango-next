<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte los valores del perfil en texto seguro para HTML.
function escaparTextoPerfil(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

// Usa el avatar predeterminado cuando el usuario no tiene imagen.
$rutaImagenPerfil = (string) ($datos['foto_perfil'] ?: 'recursos/img/avatar-default.svg');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo! - Editar perfil</title>
</head>
<body>
    <h1>Editar perfil</h1>

    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoPerfil($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="index.php?accion=perfil" enctype="multipart/form-data">
        <input type="hidden" name="token_csrf" value="<?= escaparTextoPerfil($tokenCsrf) ?>">

        <p>
            <img
                src="<?= escaparTextoPerfil($rutaImagenPerfil) ?>"
                alt="Imagen de perfil de <?= escaparTextoPerfil((string) $datos['nombres']) ?>"
                width="160"
            >
        </p>

        <p>
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" value="<?= escaparTextoPerfil((string) $datos['correo']) ?>" required>
        </p>

        <p>
            <label for="nombres">Nombres</label>
            <input type="text" id="nombres" name="nombres" value="<?= escaparTextoPerfil((string) $datos['nombres']) ?>" required>
        </p>

        <p>
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" value="<?= escaparTextoPerfil((string) $datos['apellidos']) ?>" required>
        </p>

        <p>
            <label for="foto_perfil">Nueva imagen de perfil</label>
            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/jpeg,image/png">
        </p>

        <p>Deja el campo vacío para conservar la imagen actual.</p>

        <?php if (!empty($datos['foto_perfil'])): ?>
            <p>
                <label>
                    <input type="checkbox" name="eliminar_foto" value="1">
                    Eliminar imagen actual
                </label>
            </p>
        <?php endif; ?>

        <button type="submit">Guardar perfil</button>
    </form>

    <p>
        <a href="index.php?accion=cambiar-contrasena">Cambiar contraseña</a>
    </p>

    <p>
        <a href="index.php?accion=bienvenida">Volver a la bienvenida</a>
    </p>
</body>
</html>
