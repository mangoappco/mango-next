<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoDetalle(string $valor): string
{
    // Evita que los datos se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle del usuario</title>
</head>
<body>
    <h1>Detalle del usuario</h1>

    <dl>
        <dt>ID</dt>
        <dd><?= escaparTextoDetalle((string) $usuario['id']) ?></dd>

        <dt>Correo electrónico</dt>
        <dd><?= escaparTextoDetalle((string) $usuario['correo']) ?></dd>

        <dt>Nombres</dt>
        <dd><?= escaparTextoDetalle((string) $usuario['nombres']) ?></dd>

        <dt>Apellidos</dt>
        <dd><?= escaparTextoDetalle((string) $usuario['apellidos']) ?></dd>

        <dt>Tipo</dt>
        <dd><?= escaparTextoDetalle((string) $usuario['tipo']) ?></dd>

        <dt>Estado</dt>
        <dd><?= (int) $usuario['activo'] === 1 ? 'Activo' : 'Inactivo' ?></dd>
    </dl>

    <p>
        <a href="index.php?accion=editar&id=<?= (int) $usuario['id'] ?>">Editar usuario</a>
    </p>

    <p>
        <a href="index.php?accion=eliminar&id=<?= (int) $usuario['id'] ?>">Eliminar usuario</a>
    </p>

    <p>
        <a href="index.php">Volver a la lista</a>
    </p>
</body>
</html>