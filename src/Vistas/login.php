<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoLogin(string $valor): string
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
    <title>ManGo! - Iniciar sesión</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
</head>
<body>
    <!-- Barra superior base del container, adaptada para una vista pública. -->
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
        <h1 class="rdm-sys-typography--display-small">Iniciar sesión</h1>

        <?php if ($mensaje !== null): ?>
            <p class="rdm-sys-typography--body-large">
                <?= escaparTextoLogin((string) $mensaje) ?>
            </p>
        <?php endif; ?>

        <?php if ($errores !== []): ?>
            <ul class="rdm-sys-typography--body-large">
                <?php foreach ($errores as $error): ?>
                    <li><?= escaparTextoLogin($error) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form class="rdm-form--container" method="post" action="index.php?accion=login">
            <div class="rdm-form--outlined">
                <div class="rdm-form--body">
                    <input type="hidden" name="token_csrf" value="<?= escaparTextoLogin($tokenCsrf) ?>">

                    <div class="rdm-textfield--wrapper">
                        <div class="rdm-textfield--container rdm-textfield--outlined">
                            <div class="rdm-textfield--control">
                                <input
                                    type="email"
                                    id="correo"
                                    name="correo"
                                    placeholder=" "
                                    value="<?= escaparTextoLogin($datos['correo']) ?>"
                                    autocomplete="email"
                                    aria-describedby="correo_support"
                                    required
                                >
                                <label class="rdm-textfield--label" for="correo">Correo electrónico</label>
                            </div>
                        </div>
                        <div class="rdm-textfield--support">
                            <span class="rdm-textfield--support-text" id="correo_support">
                                Usa el correo asociado a tu cuenta.
                            </span>
                        </div>
                    </div>

                    <div class="rdm-textfield--wrapper">
                        <div class="rdm-textfield--container rdm-textfield--outlined">
                            <div class="rdm-textfield--control">
                                <input
                                    type="password"
                                    id="contrasena"
                                    name="contrasena"
                                    placeholder=" "
                                    autocomplete="current-password"
                                    aria-describedby="contrasena_support"
                                    required
                                >
                                <label class="rdm-textfield--label" for="contrasena">Contraseña</label>
                            </div>
                        </div>
                        <div class="rdm-textfield--support">
                            <span class="rdm-textfield--support-text" id="contrasena_support">
                                Introduce tu contraseña para continuar.
                            </span>
                        </div>
                    </div>

                    <p class="rdm-form--action-right">
                        <button class="rdm-button--filled" type="submit">
                            <span class="rdm-button--container">
                                <span class="rdm-button--body">
                                    <span class="rdm-sys-typography--label-large">Iniciar sesión</span>
                                </span>
                            </span>
                        </button>
                    </p>
                </div>
            </div>
        </form>

        <p class="rdm-sys-typography--body-large">
            <a href="index.php?accion=recuperar">¿Olvidaste tu contraseña?</a>
        </p>

        <?php if (($_ENV['APP_ENV'] ?? 'production') !== 'production'): ?>
            <p class="rdm-sys-typography--body-medium">
                <a href="../componentes/index.php" target="_blank" rel="noopener">
                    Ver biblioteca de componentes
                </a>
            </p>
        <?php endif; ?>
    </main>
</body>
</html>