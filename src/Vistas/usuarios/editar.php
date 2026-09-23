<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoEdicion(string $valor): string
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
    <title>ManGo! - Editar usuario</title>
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
                <a href="index.php?accion=ver&id=<?= (int) $datos['id'] ?>">
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
        <h1 class="rdm-sys-typography--display-medium">Editar usuario</h1>

    <?php if ($errores !== []): ?>
        <aside class="rdm-alert rdm-alert--error" role="alert" aria-live="assertive">
            <div class="rdm-alert--icon">
                <span class="material-symbols-rounded">error</span>
            </div>
            <div class="rdm-alert--body">
                <?php if (count($errores) === 1): ?>
                    <p class="rdm-sys-typography--body-large"><?= escaparTextoEdicion($errores[0]) ?></p>
                <?php else: ?>
                    <ul class="rdm-sys-typography--body-large">
                        <?php foreach ($errores as $error): ?>
                            <li><?= escaparTextoEdicion($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </aside>
    <?php endif; ?>

    <form class="rdm-form--container rdm-form--stacked" method="post" action="index.php?accion=editar&id=<?= (int) $datos['id'] ?>" enctype="multipart/form-data">
        <div class="rdm-form--elevated">
            <div class="rdm-form--body">
                <input type="hidden" name="token_csrf" value="<?= escaparTextoEdicion($tokenCsrf) ?>">

                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <input
                                type="text"
                                id="nombres"
                                name="nombres"
                                placeholder=" "
                                value="<?= escaparTextoEdicion((string) $datos['nombres']) ?>"
                                autocomplete="given-name"
                                aria-describedby="nombres_support"
                                required
                            >
                            <label class="rdm-textfield--label" for="nombres">Nombres</label>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="nombres_support">Escribe los nombres del usuario.</span>
                    </div>
                </div>

                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <input
                                type="text"
                                id="apellidos"
                                name="apellidos"
                                placeholder=" "
                                value="<?= escaparTextoEdicion((string) $datos['apellidos']) ?>"
                                autocomplete="family-name"
                                aria-describedby="apellidos_support"
                                required
                            >
                            <label class="rdm-textfield--label" for="apellidos">Apellidos</label>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="apellidos_support">Escribe los apellidos del usuario.</span>
                    </div>
                </div>

                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <input
                                type="email"
                                id="correo"
                                name="correo"
                                placeholder=" "
                                value="<?= escaparTextoEdicion((string) $datos['correo']) ?>"
                                autocomplete="email"
                                aria-describedby="correo_support"
                                required
                            >
                            <label class="rdm-textfield--label" for="correo">Correo electrónico</label>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="correo_support">Usa un correo válido.</span>
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
                                autocomplete="new-password"
                                aria-describedby="contrasena_support"
                            >
                            <label class="rdm-textfield--label" for="contrasena">Nueva contraseña</label>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="contrasena_support">Déjalo vacío para conservar la contraseña actual.</span>
                    </div>
                </div>

                <div class="rdm-select--wrapper">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <div class="rdm-select--leading-icon">
                                <span class="material-symbols-rounded">manage_accounts</span>
                            </div>
                            <select id="tipo" name="tipo" required>
                                <option value="usuario"<?= $datos['tipo'] === 'usuario' ? ' selected' : '' ?>>Usuario</option>
                                <option value="admin"<?= $datos['tipo'] === 'admin' ? ' selected' : '' ?>>Administrador</option>
                            </select>
                            <label class="rdm-select--label" for="tipo">Tipo de usuario</label>
                            <div class="rdm-select--trailing-icon">
                                <span class="material-symbols-rounded">arrow_drop_down</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-select--support">
                        <span class="rdm-select--support-text">Selecciona el rol del usuario.</span>
                    </div>
                </div>

            </div>
        </div>

        <h2 class="rdm-sys-typography--display-small">Imagen</h2>

        <div class="rdm-form--elevated">
            <div class="rdm-form--body">
                <p>
                    <img
                        src="<?= escaparTextoEdicion((string) ($datos['foto_perfil'] ?: 'recursos/img/avatar-default.svg')) ?>"
                        alt="Imagen de perfil de <?= escaparTextoEdicion((string) $datos['nombres']) ?>"
                        width="160"
                    >
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
                            <input
                                type="checkbox"
                                class="rdm-checkbox--input"
                                name="eliminar_foto"
                                value="1"
                            >
                            <span class="rdm-checkbox--checkmark"></span>
                            <span class="rdm-checkbox--label">Eliminar imagen actual</span>
                        </label>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if ($esAdministrador && (int) $datos['activo'] === 1): ?>
            <h2 class="rdm-sys-typography--display-small">Desactivar</h2>

            <div class="rdm-form--elevated">
                <div class="rdm-form--body">
                    <h3 class="rdm-sys-typography--title-large">Acción administrativa</h3>
                    <p class="rdm-sys-typography--body-large">
                        El usuario no podrá iniciar sesión mientras permanezca desactivado.
                    </p>
                </div>

                <div class="rdm-form--action-left">
                    <p>
                        <button
                            class="rdm-button--filled"
                            type="button"
                            onclick="window.location.href='index.php?accion=desactivar&id=<?= (int) $datos['id'] ?>';"
                        >
                            <div class="rdm-button--container">
                                <div class="rdm-button--media">
                                    <div class="rdm-button--icon">
                                        <span class="material-symbols-rounded">person_off</span>
                                    </div>
                                </div>
                                <div class="rdm-button--body">
                                    <span class="rdm-sys-typography--label-large">Desactivar</span>
                                </div>
                            </div>
                        </button>
                    </p>
                </div>
            </div>
        <?php elseif ($esAdministrador): ?>
            <h2 class="rdm-sys-typography--display-small">Reactivar</h2>

            <div class="rdm-form--elevated">
                <div class="rdm-form--body">
                    <h3 class="rdm-sys-typography--title-large">Usuario inactivo</h3>
                    <p class="rdm-sys-typography--body-large">
                        El usuario podrá volver a iniciar sesión después de reactivarlo.
                    </p>
                </div>

                <div class="rdm-form--action-left">
                    <p>
                        <button
                            class="rdm-button--filled"
                            type="button"
                            onclick="window.location.href='index.php?accion=reactivar&id=<?= (int) $datos['id'] ?>';"
                        >
                            <div class="rdm-button--container">
                                <div class="rdm-button--media">
                                    <div class="rdm-button--icon">
                                        <span class="material-symbols-rounded">person_add</span>
                                    </div>
                                </div>
                                <div class="rdm-button--body">
                                    <span class="rdm-sys-typography--label-large">Reactivar</span>
                                </div>
                            </div>
                        </button>
                    </p>
                </div>
            </div>
        <?php endif; ?>

        <div class="rdm-button--fab-position">
            <button
                class="rdm-button--fab"
                type="submit"
                title="Guardar cambios"
                aria-label="Guardar cambios"
            >
                <div class="rdm-button--container">
                    <div class="rdm-button--media">
                        <div class="rdm-button--icon">
                            <span class="material-symbols-rounded">check</span>
                        </div>
                    </div>
                    <div class="rdm-button--body">
                        <span class="rdm-sys-typography--label-large">Guardar cambios</span>
                    </div>
                </div>
            </button>
        </div>
    </form>
    </main>
</body>
</html>