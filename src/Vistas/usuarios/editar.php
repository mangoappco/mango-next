<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoEdicion(string $valor): string
{
    // Evita que los datos se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ManGo! - Editar usuario</title>
</head>
<body>
    <h1>Editar usuario</h1>

    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoEdicion($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="index.php?accion=editar&id=<?= (int) $datos['id'] ?>">
        <input type="hidden" name="token_csrf" value="<?= escaparTextoEdicion($tokenCsrf) ?>">

        <p>
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" value="<?= escaparTextoEdicion((string) $datos['correo']) ?>" required>
        </p>

        <p>
            <label for="contrasena">Nueva contraseña</label>
            <input type="password" id="contrasena" name="contrasena">
        </p>

        <p>Deja este campo vacío para conservar la contraseña actual.</p>

        <p>
            <label for="nombres">Nombres</label>
            <input type="text" id="nombres" name="nombres" value="<?= escaparTextoEdicion((string) $datos['nombres']) ?>" required>
        </p>

        <p>
            <label for="apellidos">Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" value="<?= escaparTextoEdicion((string) $datos['apellidos']) ?>" required>
        </p>

        <p>
            <label for="tipo">Tipo</label>
            <select id="tipo" name="tipo">
                <option value="usuario"<?= $datos['tipo'] === 'usuario' ? ' selected' : '' ?>>Usuario</option>
                <option value="admin"<?= $datos['tipo'] === 'admin' ? ' selected' : '' ?>>Administrador</option>
            </select>
        </p>

        <button type="submit">Guardar cambios</button>
    </form>

    <p>
        <a href="index.php">Volver a la lista</a>
    </p>
</body>
</html>