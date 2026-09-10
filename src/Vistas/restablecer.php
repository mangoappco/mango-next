<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoRestablecer(string $valor): string
{
    // Evita que los mensajes se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer contraseña</title>
</head>
<body>
    <h1>Restablecer contraseña</h1>

    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoRestablecer($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="index.php?accion=restablecer&amp;token=<?= urlencode($tokenRecuperacion) ?>">
        <input type="hidden" name="token_csrf" value="<?= escaparTextoRestablecer($tokenCsrf) ?>">

        <p>
            <label for="contrasena_nueva">Nueva contraseña</label>
            <input type="password" id="contrasena_nueva" name="contrasena_nueva" minlength="8" required>
        </p>

        <p>
            <label for="contrasena_confirmacion">Confirmar nueva contraseña</label>
            <input type="password" id="contrasena_confirmacion" name="contrasena_confirmacion" minlength="8" required>
        </p>

        <button type="submit">Restablecer contraseña</button>
    </form>
</body>
</html>