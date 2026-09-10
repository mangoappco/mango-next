<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escapeHtml(string $value): string
{
    // Evita que los datos de la base de datos se interpreten como HTML.
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
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

    <?php if ($users === []): ?>
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
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= escapeHtml((string) $user['id']) ?></td>
                        <td><?= escapeHtml((string) $user['correo']) ?></td>
                        <td><?= escapeHtml((string) $user['nombres']) ?></td>
                        <td><?= escapeHtml((string) $user['apellidos']) ?></td>
                        <td><?= escapeHtml((string) $user['tipo']) ?></td>
                        <td><?= (int) $user['activo'] === 1 ? 'Sí' : 'No' ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>