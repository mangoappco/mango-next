<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoLogin(string $valor): string
{
    // Evita que un valor escrito en el formulario se interprete como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>
<body>
    <h1>Iniciar sesión</h1>

    <?php if ($mensaje !== null): ?>
        <p><?= escaparTextoLogin((string) $mensaje) ?></p>
    <?php endif; ?>

    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoLogin($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="index.php?accion=login">
        <input type="hidden" name="token_csrf" value="<?= escaparTextoLogin($tokenCsrf) ?>">

        <p>
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" value="<?= escaparTextoLogin($datos['correo']) ?>" required>
        </p>

        <p>
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </p>

        <button type="submit">Iniciar sesión</button>
    </form>

    <p>
        <a href="index.php?accion=recuperar">¿Olvidaste tu contraseña?</a>
    </p>

    <p>
        <a href="index.php">Volver</a>
    </p>
</body>
</html>