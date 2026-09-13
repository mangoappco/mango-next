<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparHtml(string $valor): string
{
    // Evita que los datos de la base de datos se interpreten como HTML.
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo! - Usuarios</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
    <script src="recursos/componentes/js/search.js"></script>
    <script src="recursos/componentes/js/usuarios_search.js"></script>
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media">
                <a href="index.php?accion=bienvenida">
                    <div class="rdm-topbar--leading-navigation-icon">
                        <span class="material-symbols-rounded">arrow_back</span>
                    </div>
                </a>
            </div>

            <div class="rdm-topbar--body">
                <div class="rdm-sys-typography--title-large">
                    <div class="rdm-topbar--body-headline">
                        Usuarios
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
    <?php if ($mensaje !== null): ?>
        <p><?= escaparHtml((string) $mensaje) ?></p>
    <?php endif; ?>

    <form class="rdm-search--wrapper" method="get" action="index.php">
        <div class="rdm-search--container">
            <div class="rdm-search--bar">
                <div class="rdm-search--control">
                    <button class="rdm-search--leading-icon" type="button" aria-label="Buscar usuarios">
                        <span class="material-symbols-rounded">search</span>
                    </button>
                    <input
                        type="search"
                        id="buscar"
                        name="buscar"
                        value="<?= escaparHtml($busqueda) ?>"
                        placeholder="Buscar usuarios..."
                        aria-describedby="buscar_support"
                    >
                    <div class="rdm-search--trailing">
                        <button class="rdm-search--trailing-icon" type="button" aria-label="Limpiar búsqueda">
                            <span class="material-symbols-rounded">close</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php if ($busqueda !== ''): ?>
        <p>
            Resultados para: <?= escaparHtml($busqueda) ?>
        </p>
    <?php endif; ?>

    <?php if ($usuarios === [] && $busqueda === ''): ?>
        <p>No hay usuarios registrados.</p>
    <?php elseif ($usuarios === []): ?>
        <p>No se encontraron usuarios.</p>
    <?php else: ?>
        <section class="rdm-card--container">
            <div class="rdm-card--elevated">
                <?php foreach ($usuarios as $usuario): ?>
                    <a
                        class="rdm-list--container"
                        href="index.php?accion=ver&id=<?= (int) $usuario['id'] ?>"
                        aria-label="Ver detalle del perfil de <?= escaparHtml((string) $usuario['nombres']) ?>"
                    >
                        <div class="rdm-list--media">
                            <div
                                class="rdm-list--avatar"
                                style="background-image: url('<?= escaparHtml((string) ($usuario['foto_perfil'] ?: 'recursos/img/avatar-default.svg')) ?>');"
                                role="img"
                                aria-label="Imagen de <?= escaparHtml((string) $usuario['nombres']) ?>"
                            ></div>
                        </div>

                        <div class="rdm-list--body">
                            <div class="rdm-sys-typography--body-large">
                                <div class="rdm-list--body-headline">
                                    <?= escaparHtml((string) $usuario['nombres']) ?>
                                    <?= escaparHtml((string) $usuario['apellidos']) ?>
                                </div>
                            </div>
                            <div class="rdm-sys-typography--body-medium">
                                <div class="rdm-list--body-suporting-text">
                                    <?= escaparHtml((string) $usuario['tipo']) ?>
                                </div>
                            </div>
                        </div>

                        <div class="rdm-list--action">
                            <div class="rdm-list--trailing-icon" title="Ver detalle del perfil">
                                <span class="material-symbols-rounded">chevron_right</span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($esAdministrador): ?>
        <div class="rdm-button--fab-position">
            <button
                class="rdm-button--fab"
                type="button"
                title="Crear usuario"
                aria-label="Crear usuario"
                onclick="window.location.href='index.php?accion=crear';"
            >
                <div class="rdm-button--container">
                    <div class="rdm-button--media">
                        <div class="rdm-button--icon">
                            <span class="material-symbols-rounded">person_add</span>
                        </div>
                    </div>
                    <div class="rdm-button--body">
                        <span class="rdm-sys-typography--label-large">Crear usuario</span>
                    </div>
                </div>
            </button>
        </div>
    <?php endif; ?>
    </main>
</body>
</html>