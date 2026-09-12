<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoBienvenida(string $valor): string
{
    // Evita que los datos de sesión se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo! - Bienvenida</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media">
                <div class="rdm-topbar--media-placeholder" aria-hidden="true"></div>
            </div>

            <div class="rdm-topbar--body">
                <div class="rdm-sys-typography--title-large">
                    <div class="rdm-topbar--body-headline">
                        <div class="rdm-topbar--mango-logo" aria-hidden="true"></div>
                        ManGo! - Next
                    </div>
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
        <h1 class="rdm-sys-typography--display-small">Bienvenido a ManGo!</h1>

        <p class="rdm-sys-typography--body-large">Has iniciado sesión correctamente.</p>

        <?php if ($mensaje !== null): ?>
            <p class="rdm-sys-typography--body-large">
                <?= escaparTextoBienvenida((string) $mensaje) ?>
            </p>
        <?php endif; ?>

        <section class="rdm-card--container">
            <article class="rdm-card--outlined">
                <div class="rdm-card--body">
                    <h2 class="rdm-sys-typography--display-small">Sesión actual</h2>
                    <h3 class="rdm-sys-typography--title-large">
                        <?= escaparTextoBienvenida((string) $usuarioAutenticado['correo']) ?>
                    </h3>
                    <p class="rdm-sys-typography--body-large">
                        <?= escaparTextoBienvenida((string) ($usuarioAutenticado['nombres'] ?? '')) ?>
                        <?= escaparTextoBienvenida((string) ($usuarioAutenticado['apellidos'] ?? '')) ?>
                        (<?= escaparTextoBienvenida((string) $usuarioAutenticado['tipo']) ?>)
                    </p>
                </div>

                <form id="form-cerrar-sesion" method="post" action="index.php?accion=cerrar-sesion">
                    <input type="hidden" name="token_csrf" value="<?= escaparTextoBienvenida($tokenCsrf) ?>">
                </form>

                <div class="rdm-card--action-left">
                    <p>
                        <button class="rdm-button--filled" type="button" onclick="window.location.href='index.php?accion=cambiar-contrasena';">
                            <div class="rdm-button--container">
                                <div class="rdm-button--media">
                                    <div class="rdm-button--icon">
                                        <span class="material-symbols-rounded">lock_reset</span>
                                    </div>
                                </div>
                                <div class="rdm-button--body">
                                    <span class="rdm-sys-typography--label-large">Cambiar contraseña</span>
                                </div>
                            </div>
                        </button>

                        <button class="rdm-button--text" type="submit" form="form-cerrar-sesion">
                            <div class="rdm-button--container">
                                <div class="rdm-button--body">
                                    <span class="rdm-sys-typography--label-large">Cerrar sesión</span>
                                </div>
                            </div>
                        </button>
                    </p>
                </div>
            </article>
        </section>

        <p class="rdm-form--action-left">
            <a class="rdm-button--filled" href="index.php">
                <span class="rdm-button--container">
                    <span class="rdm-button--body">
                        <span class="rdm-sys-typography--label-large">Entrar al CRUD</span>
                    </span>
                </span>
            </a>

        </p>
    </main>
</body>
</html>