<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoFormulario(string $valor): string
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
    <title>ManGo! - Crear usuario</title>
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
                    <div class="rdm-topbar--leading-navigation-icon">
                        <span class="material-symbols-rounded">arrow_back</span>
                    </div>
                </a>
            </div>
            <div class="rdm-topbar--body">
                <div class="rdm-sys-typography--title-large">
                    <div class="rdm-topbar--body-headline">Usuarios</div>
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
        <h1 class="rdm-sys-typography--display-medium">Nuevo usuario</h1>

    <?php if ($errores !== []): ?>
        <ul>
            <?php foreach ($errores as $error): ?>
                <li><?= escaparTextoFormulario($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form class="rdm-form--container" method="post" action="index.php?accion=crear" enctype="multipart/form-data">
        <div class="rdm-form--elevated">
            <div class="rdm-form--body">
                <input type="hidden" name="token_csrf" value="<?= escaparTextoFormulario($tokenCsrf) ?>">

                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <input
                                type="text"
                                id="nombres"
                                name="nombres"
                                placeholder=" "
                                value="<?= escaparTextoFormulario((string) ($datos['nombres'] ?? '')) ?>"
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
                                value="<?= escaparTextoFormulario((string) ($datos['apellidos'] ?? '')) ?>"
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
                                value="<?= escaparTextoFormulario((string) ($datos['correo'] ?? '')) ?>"
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
                                required
                            >
                            <label class="rdm-textfield--label" for="contrasena">Contraseña</label>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="contrasena_support">Usa una contraseña segura.</span>
                    </div>
                </div>

                <div class="rdm-select--wrapper">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <div class="rdm-select--leading-icon">
                                <span class="material-symbols-rounded">manage_accounts</span>
                            </div>
                            <select id="tipo" name="tipo" required>
                                <option value="usuario"<?= (($datos['tipo'] ?? 'usuario') === 'usuario') ? ' selected' : '' ?>>Usuario</option>
                                <option value="admin"<?= (($datos['tipo'] ?? 'usuario') === 'admin') ? ' selected' : '' ?>>Administrador</option>
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

            </div>
        </div>

        <div class="rdm-button--fab-position">
            <button
                class="rdm-button--fab"
                type="submit"
                title="Guardar usuario"
                aria-label="Guardar usuario"
            >
                <div class="rdm-button--container">
                    <div class="rdm-button--media">
                        <div class="rdm-button--icon">
                            <span class="material-symbols-rounded">save</span>
                        </div>
                    </div>
                    <div class="rdm-button--body">
                        <span class="rdm-sys-typography--label-large">Guardar usuario</span>
                    </div>
                </div>
            </button>
        </div>
    </form>
    </main>
</body>
</html>