<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoRestablecer(string $valor): string
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
    <title>ManGo! - Restablecer contraseña</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
    <script src="recursos/componentes/js/textfield.js"></script>
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media">
                <a href="index.php?accion=login">
                    <div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div>
                </a>
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
        <h1 class="rdm-sys-typography--display-medium">Restablecer contraseña</h1>

    <?php if ($errores !== []): ?>
        <aside class="rdm-alert rdm-alert--error" role="alert" aria-live="assertive">
            <div class="rdm-alert--icon">
                <span class="material-symbols-rounded">error</span>
            </div>
            <div class="rdm-alert--body">
                <?php if (count($errores) === 1): ?>
                    <p class="rdm-sys-typography--body-large"><?= escaparTextoRestablecer($errores[0]) ?></p>
                <?php else: ?>
                    <ul class="rdm-sys-typography--body-large">
                        <?php foreach ($errores as $error): ?>
                            <li><?= escaparTextoRestablecer($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </aside>
    <?php endif; ?>

        <form class="rdm-form--container" method="post" action="index.php?accion=restablecer&amp;token=<?= urlencode($tokenRecuperacion) ?>">
            <div class="rdm-form--elevated">
                <div class="rdm-form--body">
                    <input type="hidden" name="token_csrf" value="<?= escaparTextoRestablecer($tokenCsrf) ?>">

                    <div class="rdm-textfield--wrapper">
                        <div class="rdm-textfield--container rdm-textfield--outlined">
                            <div class="rdm-textfield--control">
                                <input type="password" id="contrasena_nueva" name="contrasena_nueva" placeholder=" " autocomplete="new-password" aria-describedby="contrasena_nueva_support" minlength="8" required>
                                <label class="rdm-textfield--label" for="contrasena_nueva">Nueva contraseña</label>
                            </div>
                        </div>
                        <div class="rdm-textfield--support"><span class="rdm-textfield--support-text" id="contrasena_nueva_support">Debe tener al menos 8 caracteres.</span></div>
                    </div>

                    <div class="rdm-textfield--wrapper">
                        <div class="rdm-textfield--container rdm-textfield--outlined">
                            <div class="rdm-textfield--control">
                                <input type="password" id="contrasena_confirmacion" name="contrasena_confirmacion" placeholder=" " autocomplete="new-password" aria-describedby="contrasena_confirmacion_support" minlength="8" required>
                                <label class="rdm-textfield--label" for="contrasena_confirmacion">Confirmar nueva contraseña</label>
                            </div>
                        </div>
                        <div class="rdm-textfield--support"><span class="rdm-textfield--support-text" id="contrasena_confirmacion_support">Escribe nuevamente la nueva contraseña.</span></div>
                    </div>
                </div>

                <div class="rdm-form--action-left">
                    <p>
                        <button class="rdm-button--filled" type="submit">
                            <div class="rdm-button--container">
                                <div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">lock_reset</span></div></div>
                                <div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Restablecer contraseña</span></div>
                            </div>
                        </button>
                    </p>
                </div>
            </div>
        </form>
    </main>
</body>
</html>