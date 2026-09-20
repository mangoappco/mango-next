<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoBienvenida(string $valor): string
{
    // Evita que los datos de sesión se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

// Usa el avatar predeterminado cuando la sesión no tiene una imagen cargada.
$rutaImagenPerfil = (string) ($usuarioAutenticado['foto_perfil'] ?: 'recursos/img/avatar-default.svg');
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
    <script src="recursos/componentes/js/snackbar.js"></script>
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
                <a href="index.php?accion=perfil">
                    <div
                        class="rdm-topbar--avatar"
                        style="background-image: url('<?= escaparTextoBienvenida($rutaImagenPerfil) ?>');"
                        title="Editar perfil"
                    ></div>
                </a>
            </div>
        </div>
    </header>

    <main class="rdm--contenedor-toolbar">
        <h1 class="rdm-sys-typography--display-small">Bienvenido a ManGo!</h1>

        <?php if ($mensaje !== null): ?>
            <?php
                $tipoMensaje = is_array($mensaje) ? (string) ($mensaje['tipo'] ?? 'exito') : 'exito';
                $textoMensaje = is_array($mensaje) ? (string) ($mensaje['texto'] ?? '') : (string) $mensaje;
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    if (typeof window.rdmShowSnackbar === 'function') {
                        window.rdmShowSnackbar(
                            <?= json_encode($textoMensaje, JSON_UNESCAPED_UNICODE) ?>,
                            null,
                            null,
                            3200,
                            <?= json_encode($tipoMensaje, JSON_UNESCAPED_UNICODE) ?>
                        );
                    }
                });
            </script>
        <?php endif; ?>

        <section class="rdm-card--container">
            <article class="rdm-card--elevated">
                <div
                    class="rdm-card--media"
                    style="background-image: url('<?= escaparTextoBienvenida($rutaImagenPerfil) ?>');"
                    role="img"
                    aria-label="Imagen de perfil de <?= escaparTextoBienvenida((string) $usuarioAutenticado['nombres']) ?>"
                >
                    <h1 class="rdm-sys-typography--display-medium">
                        <?= escaparTextoBienvenida((string) ($usuarioAutenticado['nombres'] ?? '')) ?>
                        <?= escaparTextoBienvenida((string) ($usuarioAutenticado['apellidos'] ?? '')) ?>
                    </h1>
                </div>

                <div class="rdm-card--body">
                    <h2 class="rdm-sys-typography--display-small">
                        <?= escaparTextoBienvenida((string) $usuarioAutenticado['tipo']) ?>
                    </h2>
                    <h3 class="rdm-sys-typography--title-large">
                        <?= escaparTextoBienvenida((string) $usuarioAutenticado['correo']) ?>
                    </h3>
                </div>

                <form id="form-cerrar-sesion" method="post" action="index.php?accion=cerrar-sesion">
                    <input type="hidden" name="token_csrf" value="<?= escaparTextoBienvenida($tokenCsrf) ?>">
                </form>

                <div class="rdm-card--action-left">
                    <p>
                        <button class="rdm-button--filled" type="button" onclick="window.location.href='index.php?accion=perfil';">
                            <div class="rdm-button--container">
                                <div class="rdm-button--media">
                                    <div class="rdm-button--icon">
                                        <span class="material-symbols-rounded">person_edit</span>
                                    </div>
                                </div>
                                <div class="rdm-button--body">
                                    <span class="rdm-sys-typography--label-large">Editar perfil</span>
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

        <section class="rdm-card--container">
            <article class="rdm-card--elevated">
                <div class="rdm-card--body">
                    <h2 class="rdm-sys-typography--display-small">Configuración</h2>
                </div>

                <div class="rdm-card--action-left">
                    <p>
                        <button class="rdm-button--filled" type="button" onclick="window.location.href='index.php';">
                            <div class="rdm-button--container">
                                <div class="rdm-button--body">
                                    <span class="rdm-sys-typography--label-large">Usuarios</span>
                                </div>
                            </div>
                        </button>
                    </p>
                </div>
            </article>
        </section>

    </main>
</body>
</html>