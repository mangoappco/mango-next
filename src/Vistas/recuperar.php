<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoRecuperacion(string $valor): string
{
    // Evita que los datos se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ManGo! - Recuperar contraseña</title>
</head>
<body>
    <h1>Recuperar contraseña</h1>

    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoRecuperacion($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <?php if ($mensajeRecuperacion !== null): ?>
        <p><?= escaparTextoRecuperacion($mensajeRecuperacion) ?></p>
    <?php endif; ?>

    <form method="post" action="index.php?accion=recuperar">
        <input type="hidden" name="token_csrf" value="<?= escaparTextoRecuperacion($tokenCsrf) ?>">

        <p>
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" value="<?= escaparTextoRecuperacion($correoRecuperacion) ?>" required>
        </p>

        <button type="submit">Solicitar recuperación</button>
    </form>

    <?php if ($enlaceRecuperacion !== null): ?>
        <p>En desarrollo, este sería el enlace enviado por correo:</p>
        <p><a href="<?= escaparTextoRecuperacion($enlaceRecuperacion) ?>">Abrir enlace de recuperación</a></p>
    <?php endif; ?>

    <p>
        <a href="index.php?accion=login">Volver al login</a>
    </p>
</body>
</html>