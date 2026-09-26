<?php

declare(strict_types=1);

function escaparTextoLocales(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo! - Locales</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
    <script src="recursos/componentes/js/search.js"></script>
    <script src="recursos/componentes/js/locales_search.js"></script>
    <script src="recursos/componentes/js/snackbar.js"></script>
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media">
                <a href="index.php?accion=bienvenida"><div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div></a>
            </div>
            <div class="rdm-topbar--body">
                <div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Locales</div></div>
            </div>
            <div class="rdm-topbar--action">
                <div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema"><span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span></div>
            </div>
        </div>
    </header>

    <main class="rdm--contenedor-toolbar">
        <?php if ($mensaje !== null): ?>
            <?php
                $tipoMensaje = is_array($mensaje) ? (string) ($mensaje['tipo'] ?? 'exito') : 'exito';
                $textoMensaje = is_array($mensaje) ? (string) ($mensaje['texto'] ?? '') : (string) $mensaje;
                $mapaTipos = ['exito' => 'success', 'error' => 'error', 'advertencia' => 'warning', 'info' => 'info', 'success' => 'success', 'warning' => 'warning', 'neutral' => 'neutral'];
                $tipoSnackbar = $mapaTipos[$tipoMensaje] ?? 'neutral';
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    if (window.RDM && RDM.snackbar && typeof RDM.snackbar.show === 'function') {
                        RDM.snackbar.show({
                            message: <?= json_encode($textoMensaje, JSON_UNESCAPED_UNICODE) ?>,
                            type: <?= json_encode($tipoSnackbar, JSON_UNESCAPED_UNICODE) ?>,
                            duration: 4000
                        });
                    }
                });
            </script>
        <?php endif; ?>

        <form class="rdm-search--wrapper" method="get" action="index.php">
            <input type="hidden" name="accion" value="locales">
            <div class="rdm-search--container">
                <div class="rdm-search--bar">
                    <div class="rdm-search--control">
                        <button class="rdm-search--leading-icon" type="button" aria-label="Buscar locales"><span class="material-symbols-rounded">search</span></button>
                        <input type="search" id="buscar" name="buscar" value="<?= escaparTextoLocales($busqueda) ?>" placeholder="Buscar locales..." aria-describedby="buscar_support">
                        <div class="rdm-search--trailing">
                            <button class="rdm-search--trailing-icon" type="button" aria-label="Limpiar búsqueda"><span class="material-symbols-rounded">close</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php if ($busqueda !== '' && $locales !== []): ?>
            <p class="rdm-sys-typography--title-small">Resultados</p>
        <?php endif; ?>

        <?php if ($locales === [] && $busqueda === ''): ?>
            <div class="rdm-empty--container">
                <div class="rdm-empty--icon"><span class="material-symbols-rounded">inbox</span></div>
                <h3 class="rdm-empty--headline rdm-sys-typography--title-large">No hay locales</h3>
                <p class="rdm-empty--support rdm-sys-typography--body-medium">Aún no hay locales registrados.</p>
                <?php if ($esAdministrador): ?>
                <div class="rdm-empty--actions">
                    <button class="rdm-button--filled" type="button" onclick="window.location.href='index.php?accion=crear-local';"><div class="rdm-button--container"><div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">add</span></div></div><div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Crear local</span></div></div></button>
                </div>
                <?php endif; ?>
            </div>
        <?php elseif ($locales === []): ?>
            <div class="rdm-empty--container">
                <div class="rdm-empty--icon"><span class="material-symbols-rounded">search_off</span></div>
                <h3 class="rdm-empty--headline rdm-sys-typography--title-large">Sin resultados para "<?= escaparTextoLocales($busqueda) ?>"</h3>
                <p class="rdm-empty--support rdm-sys-typography--body-medium">Revisa la ortografía o intenta con otro nombre, código o marca.</p>
                <div class="rdm-empty--actions">
                    <button class="rdm-button--text" type="button" onclick="window.location.href='index.php?accion=locales';"><div class="rdm-button--container"><div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Limpiar búsqueda</span></div></div></button>
                </div>
            </div>
        <?php else: ?>
            <section class="rdm-card--container">
                <div class="rdm-card--elevated">
                    <?php foreach ($locales as $local): ?>
                        <a class="rdm-list--container" href="index.php?accion=ver-local&id=<?= (int) $local['id'] ?>" aria-label="Ver detalle de <?= escaparTextoLocales((string) $local['nombre']) ?>">
                            <div class="rdm-list--media">
                                <div class="rdm-list--avatar" style="background-image: url('<?= escaparTextoLocales((string) ($local['imagen'] ?: 'recursos/img/local-default.svg')) ?>');" role="img" aria-label="Imagen de <?= escaparTextoLocales((string) $local['nombre']) ?>"></div>
                            </div>
                            <div class="rdm-list--body">
                                <div class="rdm-sys-typography--body-large"><div class="rdm-list--body-headline"><?= escaparTextoLocales((string) $local['nombre']) ?></div></div>
                                <div class="rdm-sys-typography--body-medium"><div class="rdm-list--body-suporting-text"><?= escaparTextoLocales((string) $local['marca_nombre']) ?> — <?= Mango\Core\Texto::estado((int) $local['activo'] === 1) ?></div></div>
                            </div>
                            <div class="rdm-list--action">
                                <div class="rdm-list--trailing-icon" title="Ver detalle">
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
                <button class="rdm-button--fab" type="button" title="Crear local" aria-label="Crear local" onclick="window.location.href='index.php?accion=crear-local';">
                    <div class="rdm-button--container">
                        <div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">add</span></div></div>
                        <div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Crear local</span></div>
                    </div>
                </button>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>