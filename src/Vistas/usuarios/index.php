<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparHtml(string $valor): string
{
    // Evita que los datos de la base de datos se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios</title>
</head>
<body>
    <h1>Usuarios</h1>

    <?php if ($usuarios === []): ?>
        <p>No hay usuarios registrados.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Correo</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Tipo</th>
                    <th>Activo</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= escaparHtml((string) $usuario['id']) ?></td>
                        <td><?= escaparHtml((string) $usuario['correo']) ?></td>
                        <td><?= escaparHtml((string) $usuario['nombres']) ?></td>
                        <td><?= escaparHtml((string) $usuario['apellidos']) ?></td>
                        <td><?= escaparHtml((string) $usuario['tipo']) ?></td>
                        <td><?= (int) $usuario['activo'] === 1 ? 'Sí' : 'No' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>