<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoReactivacion(string $valor): string
{
    // Evita que los datos se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ManGo! - Reactivar usuario</title>
</head>
<body>
    <h1>Reactivar usuario</h1>

    <p>¿Deseas reactivar este usuario?</p>

    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoReactivacion($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <dl>
        <dt>ID</dt>
        <dd><?= escaparTextoReactivacion((string) $usuario['id']) ?></dd>

        <dt>Correo electrónico</dt>
        <dd><?= escaparTextoReactivacion((string) $usuario['correo']) ?></dd>

        <dt>Nombres</dt>
        <dd><?= escaparTextoReactivacion((string) $usuario['nombres']) ?></dd>

        <dt>Apellidos</dt>
        <dd><?= escaparTextoReactivacion((string) $usuario['apellidos']) ?></dd>
    </dl>

    <form method="post" action="index.php?accion=reactivar&id=<?= (int) $usuario['id'] ?>">
        <input type="hidden" name="token_csrf" value="<?= escaparTextoReactivacion($tokenCsrf) ?>">
        <p>
            <label for="contrasena_actual">Confirma tu contraseña actual</label>
            <input type="password" id="contrasena_actual" name="contrasena_actual" required>
        </p>
        <button type="submit">Confirmar reactivación</button>
    </form>

    <p>
        <a href="index.php">Cancelar y volver a la lista</a>
    </p>
</body>
</html>