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

    <?php if ($mensaje !== null): ?>
        <p><?= escaparHtml((string) $mensaje) ?></p>
    <?php endif; ?>

    <p>
        <a href="index.php?accion=crear">Crear usuario</a>
        <a href="index.php?accion=bienvenida">Volver a la bienvenida</a>
    </p>

    <form method="get" action="index.php">
        <label for="buscar">Buscar usuario</label>
        <input type="search" id="buscar" name="buscar" value="<?= escaparHtml($busqueda) ?>">
        <button type="submit">Buscar</button>
    </form>

    <?php if ($busqueda !== ''): ?>
        <p>
            Resultados para: <?= escaparHtml($busqueda) ?>
            <a href="index.php">Limpiar búsqueda</a>
        </p>
    <?php endif; ?>

    <?php if ($usuarios === [] && $busqueda === ''): ?>
        <p>No hay usuarios registrados.</p>
    <?php elseif ($usuarios === []): ?>
        <p>No se encontraron usuarios.</p>
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
                    <th>Acciones</th>
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
                        <td>
                            <a href="index.php?accion=ver&id=<?= (int) $usuario['id'] ?>">Ver</a>
                            <a href="index.php?accion=editar&id=<?= (int) $usuario['id'] ?>">Editar</a>
                            <a href="index.php?accion=eliminar&id=<?= (int) $usuario['id'] ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>