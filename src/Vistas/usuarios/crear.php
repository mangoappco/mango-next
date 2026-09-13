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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo! - Crear usuario</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media">
                <a href="index.php">
                    <div class="rdm-topbar--leading-navigation-icon">
                        <span class="material-symbols-rounded">arrow_back</span>
                    </div>
                </a>
            </div>
            <div class="rdm-topbar--body">
                <div class="rdm-sys-typography--title-large">
                    <div class="rdm-topbar--body-headline">Crear usuario</div>
                </div>
            </div>
            <div class="rdm-topbar--action">
                <div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema">
                    <span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span>
                </div>
            </div>
        </div>
    </header>

    <main class="rdm--contenedor-toolbar">
        <h1 class="rdm-sys-typography--display-medium">Nuevo usuario</h1>

    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoFormulario($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="index.php?accion=crear" enctype="multipart/form-data">
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

        <p>
            <label for="foto_perfil">Imagen de perfil</label>
            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/jpeg,image/png">
        </p>

        <button type="submit">Guardar usuario</button>
    </form>

    <p>
        <a href="index.php">Volver a la lista</a>
    </p>
    </main>
</body>
</html>