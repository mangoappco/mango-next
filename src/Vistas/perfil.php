<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte los valores del perfil en texto seguro para HTML.
function escaparTextoPerfil(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

// Usa el avatar predeterminado cuando el usuario no tiene imagen.
$rutaImagenPerfil = (string) ($datos['foto_perfil'] ?: 'recursos/img/avatar-default.svg');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo! - Editar perfil</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
    <script src="recursos/componentes/js/textfield.js"></script>
    <script src="recursos/componentes/js/fileinput.js"></script>
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media">
                <a href="index.php?accion=bienvenida"><div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div></a>
            </div>
            <div class="rdm-topbar--body"><div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Editar perfil</div></div></div>
            <div class="rdm-topbar--action"><div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema"><span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span></div></div>
        </div>
    </header>

    <main class="rdm--contenedor-toolbar">
        <h1 class="rdm-sys-typography--display-medium">Mis datos personales</h1>

    <?php if ($errores !== []): ?>
        <aside class="rdm-alert rdm-alert--error" role="alert" aria-live="assertive">
            <div class="rdm-alert--icon">
                <span class="material-symbols-rounded">error</span>
            </div>
            <div class="rdm-alert--body">
                <?php if (count($errores) === 1): ?>
                    <p class="rdm-sys-typography--body-large"><?= escaparTextoPerfil($errores[0]) ?></p>
                <?php else: ?>
                    <ul class="rdm-sys-typography--body-large">
                        <?php foreach ($errores as $error): ?>
                            <li><?= escaparTextoPerfil($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </aside>
    <?php endif; ?>

    <form class="rdm-form--container rdm-form--stacked" method="post" action="index.php?accion=perfil" enctype="multipart/form-data">
        <div class="rdm-form--elevated">
            <div class="rdm-form--body">
                <input type="hidden" name="token_csrf" value="<?= escaparTextoPerfil($tokenCsrf) ?>">

                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <input type="text" id="nombres" name="nombres" placeholder=" " value="<?= escaparTextoPerfil((string) $datos['nombres']) ?>" autocomplete="given-name" aria-describedby="nombres_support" required>
                            <label class="rdm-textfield--label" for="nombres">Nombres</label>
                        </div>
                    </div>
                    <div class="rdm-textfield--support"><span class="rdm-textfield--support-text" id="nombres_support">Escribe tus nombres.</span></div>
                </div>

                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <input type="text" id="apellidos" name="apellidos" placeholder=" " value="<?= escaparTextoPerfil((string) $datos['apellidos']) ?>" autocomplete="family-name" aria-describedby="apellidos_support" required>
                            <label class="rdm-textfield--label" for="apellidos">Apellidos</label>
                        </div>
                    </div>
                    <div class="rdm-textfield--support"><span class="rdm-textfield--support-text" id="apellidos_support">Escribe tus apellidos.</span></div>
                </div>

                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <input type="email" id="correo" name="correo" placeholder=" " value="<?= escaparTextoPerfil((string) $datos['correo']) ?>" autocomplete="email" aria-describedby="correo_support" required>
                            <label class="rdm-textfield--label" for="correo">Correo electrónico</label>
                        </div>
                    </div>
                    <div class="rdm-textfield--support"><span class="rdm-textfield--support-text" id="correo_support">Usa un correo válido.</span></div>
                </div>
            </div>
        </div>

        <h2 class="rdm-sys-typography--display-small">Imagen</h2>

        <div class="rdm-form--elevated">
            <div class="rdm-form--body">
                <p>
                    <img src="<?= escaparTextoPerfil($rutaImagenPerfil) ?>" alt="Imagen de perfil de <?= escaparTextoPerfil((string) $datos['nombres']) ?>" width="160">
                </p>

                <div class="rdm-fileinput--wrapper" data-fileinput id="fi_foto_perfil">
                    <div class="rdm-fileinput--container rdm-fileinput--outlined">
                        <div class="rdm-fileinput--control">
                            <div class="rdm-fileinput--leading-icon"><span class="material-symbols-rounded">image</span></div>
                            <input class="rdm-fileinput--field" type="text" readonly placeholder=" " id="fi_foto_perfil_display" aria-describedby="fi_foto_perfil_help">
                            <label class="rdm-fileinput--label" for="fi_foto_perfil_display">Imagen de perfil</label>
                            <button type="button" class="rdm-fileinput--trailing-icon" data-file-trigger aria-label="Subir archivo"><span class="material-symbols-rounded">cloud_upload</span></button>
                            <button type="button" class="rdm-fileinput--trailing-icon" data-file-clear aria-label="Quitar archivo"><span class="material-symbols-rounded">close</span></button>
                        </div>
                    </div>
                    <div class="rdm-fileinput--support">
                        <span class="rdm-fileinput--support-text" id="fi_foto_perfil_help">JPG o PNG, máx. 2 MB.</span>
                        <span class="rdm-fileinput--support-counter"></span>
                    </div>
                    <input type="file" class="rdm-fileinput--hidden" id="fi_foto_perfil_native" name="foto_perfil" accept="image/jpeg,image/png" data-max-size="2097152">
                    <div class="rdm-fileinput--preview"></div>
                    <img class="rdm-fileinput--image-preview" alt="Vista previa">
                </div>

                <?php if (!empty($datos['foto_perfil'])): ?>
                    <div class="rdm-checkbox--wrapper">
                        <label class="rdm-checkbox--container">
                            <input type="checkbox" class="rdm-checkbox--input" name="eliminar_foto" value="1">
                            <span class="rdm-checkbox--checkmark"></span>
                            <span class="rdm-checkbox--label">Eliminar imagen actual</span>
                        </label>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="rdm-button--fab-position">
            <button class="rdm-button--fab" type="submit" title="Guardar cambios" aria-label="Guardar cambios">
                <div class="rdm-button--container">
                    <div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">check</span></div></div>
                    <div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Guardar cambios</span></div>
                </div>
            </button>
        </div>
    </form>

    <h2 class="rdm-sys-typography--display-small">Seguridad</h2>

    <section class="rdm-card--container">
        <article class="rdm-card--elevated">
            <div class="rdm-card--body">
                <h3 class="rdm-sys-typography--title-large">Cambiar contraseña</h3>
                <p class="rdm-sys-typography--body-large">
                    Actualiza tu contraseña para mantener protegida tu cuenta.
                </p>
            </div>

            <div class="rdm-card--action-left">
                <p>
                    <button
                        class="rdm-button--filled"
                        type="button"
                        onclick="window.location.href='index.php?accion=cambiar-contrasena';"
                    >
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
                </p>
            </div>
        </article>
    </section>
    </main>
</body>
</html>
