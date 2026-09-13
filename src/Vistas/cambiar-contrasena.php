<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoContrasena(string $valor): string
{
    // Evita que los mensajes se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo! - Cambiar contraseña</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media">
                <a href="index.php?accion=bienvenida"><div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div></a>
            </div>
            <div class="rdm-topbar--body"><div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Cambiar contraseña</div></div></div>
            <div class="rdm-topbar--action"><div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema"><span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span></div></div>
        </div>
    </header>

    <main class="rdm--contenedor-toolbar">
        <h1 class="rdm-sys-typography--display-medium">Actualizar contraseña</h1>

    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoContrasena($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="index.php?accion=cambiar-contrasena">
        <input type="hidden" name="token_csrf" value="<?= escaparTextoContrasena($tokenCsrf) ?>">

        <p>
            <label for="contrasena_actual">Contraseña actual</label>
            <input type="password" id="contrasena_actual" name="contrasena_actual" required>
        </p>

        <p>
            <label for="contrasena_nueva">Nueva contraseña</label>
            <input type="password" id="contrasena_nueva" name="contrasena_nueva" minlength="8" required>
        </p>

        <p>
            <label for="contrasena_confirmacion">Confirmar nueva contraseña</label>
            <input type="password" id="contrasena_confirmacion" name="contrasena_confirmacion" minlength="8" required>
        </p>

        <button type="submit">Guardar nueva contraseña</button>
    </form>

    <p>
        <a href="index.php?accion=bienvenida">Volver a la bienvenida</a>
    </p>
    </main>
</body>
</html>