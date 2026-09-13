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
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media">
                <a href="index.php">
                    <div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div>
                </a>
            </div>
            <div class="rdm-topbar--body">
                <div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Editar usuario</div></div>
            </div>
            <div class="rdm-topbar--action">
                <div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema"><span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span></div>
            </div>
        </div>
    </header>

    <main class="rdm--contenedor-toolbar">
        <h1 class="rdm-sys-typography--display-medium">Actualizar información</h1>

    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoEdicion($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form class="rdm-form--container rdm-form--stacked" method="post" action="index.php?accion=editar&id=<?= (int) $datos['id'] ?>" enctype="multipart/form-data">
        <div class="rdm-form--elevated">
            <div class="rdm-form--body">
                <input type="hidden" name="token_csrf" value="<?= escaparTextoEdicion($tokenCsrf) ?>">

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

                <input
                    type="file"
                    id="foto_perfil"
                    name="foto_perfil"
                    accept="image/jpeg,image/png"
                    hidden
                >

                <p>
                    <label class="rdm-button--outlined rdm-file-picker" for="foto_perfil">
                        <span class="rdm-button--container">
                            <span class="rdm-button--media">
                                <span class="rdm-button--icon">
                                    <span class="material-symbols-rounded">add_a_photo</span>
                                </span>
                            </span>
                            <span class="rdm-button--body">
                                <span class="rdm-sys-typography--label-large">Seleccionar imagen</span>
                            </span>
                        </span>
                    </label>
                </p>

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
                            <span class="material-symbols-rounded">save</span>
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