<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoReactivacion(string $valor): string
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
    <title>ManGo! - Reactivar usuario</title>
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
        <aside class="rdm-alert rdm-alert--error" role="alert" aria-live="assertive">
            <div class="rdm-alert--icon">
                <span class="material-symbols-rounded">error</span>
            </div>
            <div class="rdm-alert--body">
                <?php if (count($errores) === 1): ?>
                    <p class="rdm-sys-typography--body-large"><?= escaparTextoReactivacion($errores[0]) ?></p>
                <?php else: ?>
                    <ul class="rdm-sys-typography--body-large">
                        <?php foreach ($errores as $error): ?>
                            <li><?= escaparTextoReactivacion($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </aside>
    <?php endif; ?>

        <form class="rdm-form--container" method="post" action="index.php?accion=reactivar&id=<?= (int) $usuario['id'] ?>">
            <div class="rdm-form--elevated">
                <div class="rdm-form--body">
                    <h2 class="rdm-sys-typography--display-small">Activar</h2>
                    <h3 class="rdm-sys-typography--title-large">¿Confirmar activación?</h3>
                    <p class="rdm-sys-typography--body-large">
                        El usuario
                        <strong>
                            <?= escaparTextoReactivacion((string) $usuario['nombres']) ?>
                            <?= escaparTextoReactivacion((string) $usuario['apellidos']) ?>
                        </strong>
                        (<strong><?= escaparTextoReactivacion((string) $usuario['correo']) ?></strong>)
                        podrá volver a iniciar sesión después de reactivarlo.
                    </p>

                    <input type="hidden" name="token_csrf" value="<?= escaparTextoReactivacion($tokenCsrf) ?>">

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
                                <div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">person_add</span></div></div>
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