<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoEliminacion(string $valor): string
{
    // Evita que los datos se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo! - Desactivar usuario</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
    <script src="recursos/componentes/js/textfield.js"></script>
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media">
                <a href="index.php?accion=editar&id=<?= (int) $usuario['id'] ?>">
                    <div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div>
                </a>
            </div>
            <div class="rdm-topbar--body">
                <div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Usuarios</div></div>
            </div>
            <div class="rdm-topbar--action">
                <div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema"><span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span></div>
            </div>
        </div>
    </header>

    <main class="rdm--contenedor-toolbar">
    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoEliminacion($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

        <form class="rdm-form--container" method="post" action="index.php?accion=desactivar&id=<?= (int) $usuario['id'] ?>">
            <div class="rdm-form--elevated">
                <div class="rdm-form--body">
                    <h2 class="rdm-sys-typography--display-small">Desactivar</h2>
                    <h3 class="rdm-sys-typography--title-large">¿Confirmar desactivación?</h3>
                    <p class="rdm-sys-typography--body-large">
                        El usuario
                        <strong>
                            <?= escaparTextoEliminacion((string) $usuario['nombres']) ?>
                            <?= escaparTextoEliminacion((string) $usuario['apellidos']) ?>
                        </strong>
                        (<strong><?= escaparTextoEliminacion((string) $usuario['correo']) ?></strong>)
                        conservará su registro, pero no podrá iniciar sesión después de desactivarlo.
                    </p>

                    <input type="hidden" name="token_csrf" value="<?= escaparTextoEliminacion($tokenCsrf) ?>">

                    <div class="rdm-textfield--wrapper">
                        <div class="rdm-textfield--container rdm-textfield--outlined">
                            <div class="rdm-textfield--control">
                                <input type="password" id="contrasena_actual" name="contrasena_actual" placeholder=" " autocomplete="current-password" aria-describedby="contrasena_actual_support" required>
                                <label class="rdm-textfield--label" for="contrasena_actual">Contraseña actual</label>
                            </div>
                        </div>
                        <div class="rdm-textfield--support">
                            <span class="rdm-textfield--support-text" id="contrasena_actual_support">Confirma tu identidad para continuar.</span>
                        </div>
                    </div>
                </div>

                <div class="rdm-form--action-left">
                    <p>
                        <button class="rdm-button--filled" type="submit">
                            <div class="rdm-button--container">
                                <div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">person_off</span></div></div>
                                <div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Confirmar</span></div>
                            </div>
                        </button>
                        <button class="rdm-button--text" type="button" onclick="window.location.href='index.php?accion=editar&id=<?= (int) $usuario['id'] ?>';">
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