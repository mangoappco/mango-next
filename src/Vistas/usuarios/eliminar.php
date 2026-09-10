<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoEliminacion(string $valor): string
{
    // Evita que los datos se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar usuario</title>
</head>
<body>
    <h1>Eliminar usuario</h1>

    <p>¿Deseas eliminar este usuario?</p>

    <dl>
        <dt>ID</dt>
        <dd><?= escaparTextoEliminacion((string) $usuario['id']) ?></dd>

        <dt>Correo electrónico</dt>
        <dd><?= escaparTextoEliminacion((string) $usuario['correo']) ?></dd>

        <dt>Nombres</dt>
        <dd><?= escaparTextoEliminacion((string) $usuario['nombres']) ?></dd>

        <dt>Apellidos</dt>
        <dd><?= escaparTextoEliminacion((string) $usuario['apellidos']) ?></dd>
    </dl>

    <form method="post" action="index.php?accion=eliminar&id=<?= (int) $usuario['id'] ?>">
        <button type="submit">Confirmar eliminación</button>
    </form>

    <p>
        <a href="index.php">Cancelar y volver a la lista</a>
    </p>
</body>
</html>