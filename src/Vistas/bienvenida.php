<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoBienvenida(string $valor): string
{
    // Evita que los datos de sesión se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ManGo! - Bienvenida</title>
</head>
<body>
    <h1>Bienvenido a ManGo!</h1>

    <p>Has iniciado sesión correctamente.</p>

    <?php if ($mensaje !== null): ?>
        <p><?= escaparTextoBienvenida((string) $mensaje) ?></p>
    <?php endif; ?>

    <dl>
        <dt>Correo electrónico</dt>
        <dd><?= escaparTextoBienvenida((string) $usuarioAutenticado['correo']) ?></dd>

        <dt>Tipo de usuario</dt>
        <dd><?= escaparTextoBienvenida((string) $usuarioAutenticado['tipo']) ?></dd>
    </dl>

    <p>
        <a href="index.php">Entrar al CRUD de usuarios</a>
        <a href="index.php?accion=cambiar-contrasena">Cambiar contraseña</a>
    </p>

    <form method="post" action="index.php?accion=cerrar-sesion">
        <input type="hidden" name="token_csrf" value="<?= escaparTextoBienvenida($tokenCsrf) ?>">
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>