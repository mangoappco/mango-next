<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoFormulario(string $valor): string
{
    // Evita que un valor escrito en el formulario se interprete como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear usuario</title>
</head>
<body>
    <h1>Crear usuario</h1>

    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoFormulario($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="index.php?accion=crear">
        <input type="hidden" name="token_csrf" value="<?= escaparTextoFormulario($tokenCsrf) ?>">

        <p>
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" value="<?= escaparTextoFormulario((string) ($datos['correo'] ?? '')) ?>" required>
        </p>

        <p>
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </p>

        <p>
            <label for="nombres">Nombres</label>
            <input type="text" id="nombres" name="nombres" value="<?= escaparTextoFormulario((string) ($datos['nombres'] ?? '')) ?>" required>
        </p>

        <p>
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" value="<?= escaparTextoFormulario((string) ($datos['apellidos'] ?? '')) ?>" required>
        </p>

        <p>
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo">
                <option value="usuario">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
        </p>

        <button type="submit">Guardar usuario</button>
    </form>

    <p>
        <a href="index.php">Volver a la lista</a>
    </p>
</body>
</html>