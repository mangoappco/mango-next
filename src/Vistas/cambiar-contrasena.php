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
    <script src="recursos/componentes/js/textfield.js"></script>
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media">
                <a href="index.php?accion=perfil"><div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div></a>
            </div>
            <div class="rdm-topbar--body"><div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Editar perfil</div></div></div>
            <div class="rdm-topbar--action"><div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema"><span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span></div></div>
        </div>
    </header>

    <main class="rdm--contenedor-toolbar">
    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoContrasena($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

        <form class="rdm-form--container" method="post" action="index.php?accion=cambiar-contrasena">
            <div class="rdm-form--elevated">
                <div class="rdm-form--body">
                    <h2 class="rdm-sys-typography--display-small">Seguridad</h2>
                    <h3 class="rdm-sys-typography--title-large">¿Cambiar contraseña?</h3>
                    <p class="rdm-sys-typography--body-large">
                        Cambiar contraseña para el usuario
                        <strong>
                            <?= escaparTextoContrasena((string) $usuarioAutenticado['nombres']) ?>
                            <?= escaparTextoContrasena((string) $usuarioAutenticado['apellidos']) ?>
                        </strong>
                        (<strong><?= escaparTextoContrasena((string) $usuarioAutenticado['correo']) ?></strong>).
                    </p>

                    <input type="hidden" name="token_csrf" value="<?= escaparTextoContrasena($tokenCsrf) ?>">

                    <div class="rdm-textfield--wrapper">
                        <div class="rdm-textfield--container rdm-textfield--outlined">
                            <div class="rdm-textfield--control">
                                <input type="password" id="contrasena_actual" name="contrasena_actual" placeholder=" " autocomplete="current-password" aria-describedby="contrasena_actual_support" required>
                                <label class="rdm-textfield--label" for="contrasena_actual">Contraseña actual</label>
                            </div>
                        </div>
                        <div class="rdm-textfield--support"><span class="rdm-textfield--support-text" id="contrasena_actual_support">Confirma tu contraseña actual.</span></div>
                    </div>

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

                <div class="rdm-card--action-left">
                    <p>
                        <button class="rdm-button--filled" type="submit">
                            <div class="rdm-button--container">
                                <div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">lock_reset</span></div></div>
                                <div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Confirmar</span></div>
                            </div>
                        </button>
                        <button class="rdm-button--text" type="button" onclick="window.location.href='index.php?accion=perfil';">
                            <div class="rdm-button--container">
                                <div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Cancelar</span></div>
                            </div>
                        </button>
                    </p>
                </div>
            </div>
        </form>
    </main>
</body>
</html>