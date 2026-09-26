<?php

declare(strict_types=1);

function escaparTextoLocalesDetalle(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo! - Detalle del local</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
    <script src="recursos/componentes/js/snackbar.js"></script>
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media">
                <a href="index.php?accion=locales">
                    <div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div>
                </a>
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
            // Transforma el tipo de mensaje interno al vocabulario del snackbar.
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

        <h1 class="rdm-sys-typography--display-medium">Detalle del local</h1>

        <article class="rdm-card--container">
            <div class="rdm-card--elevated rdm-card--list">

                <div class="rdm-card--media" style="background-image: url('<?= escaparTextoLocalesDetalle((string) ($local['imagen'] ?: 'recursos/img/local-default.svg')) ?>');" role="img" aria-label="Imagen del local <?= escaparTextoLocalesDetalle((string) $local['nombre']) ?>"></div>

                <div class="rdm-card--body">
                    <h2 class="rdm-sys-typography--display-small"><?= escaparTextoLocalesDetalle((string) $local['nombre']) ?></h2>

                    <?php
                    // Define los campos del local con su ícono, etiqueta y valor a mostrar.
                    $campos = [
                        ['store', 'Marca', (string) $local['marca_nombre']],
                        ['tag', 'Código', (string) ($local['codigo'] ?? '')],
                        ['location_on', 'Dirección', (string) $local['direccion']],
                        ['phone', 'Teléfono', (string) ($local['telefono'] ?? '')],
                        ['location_city', 'Ciudad', (string) ($local['ciudad'] ?? '')],
                        ['home_work', 'Barrio', (string) ($local['barrio'] ?? '')],
                        ['category', 'Tipo', (string) $local['tipo_local']],
                        ['schedule', 'Horario', (string) ($local['apertura'] ?? '') . ' - ' . (string) ($local['cierre'] ?? '')],
                        ['volunteer_activism', 'Propina', (string) $local['propina_porcentaje'] . '%'],
                        ['verified', 'Estado', Mango\Core\Texto::estado((int) $local['activo'] === 1)],
                    ];
                    ?>

                    <?php foreach ($campos as [$icono, $etiqueta, $valor]): ?>
                        <div class="rdm-list--container">
                            <div class="rdm-list--media">
                                <div class="rdm-list--leading-icon"><span class="material-symbols-rounded"><?= escaparTextoLocalesDetalle($icono) ?></span></div>
                            </div>
                            <div class="rdm-list--body">
                                <div class="rdm-list--body-headline"><?= escaparTextoLocalesDetalle($etiqueta) ?></div>
                                <div class="rdm-list--body-suporting-text"><?= escaparTextoLocalesDetalle($valor) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="rdm-list--container">
                        <div class="rdm-list--media">
                            <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">schedule</span></div>
                        </div>
                        <div class="rdm-list--body">
                            <div class="rdm-list--body-headline">Creado</div>
                            <div class="rdm-list--body-suporting-text"><?= nl2br(escaparTextoLocalesDetalle(Mango\Core\Fechas::relativa((string) $local['creado_en']))) ?></div>
                        </div>
                    </div>

                    <div class="rdm-list--container">
                        <div class="rdm-list--media">
                            <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">update</span></div>
                        </div>
                        <div class="rdm-list--body">
                            <div class="rdm-list--body-headline">Actualizado</div>
                            <div class="rdm-list--body-suporting-text"><?= nl2br(escaparTextoLocalesDetalle(Mango\Core\Fechas::relativa((string) $local['actualizado_en']))) ?></div>
                        </div>
                    </div>

                </div>
            </div>
        </article>

        <?php if ($esAdministrador): ?>
            <div class="rdm-button--fab-position">
                <button class="rdm-button--fab" type="button" title="Editar local" aria-label="Editar local" onclick="window.location.href='index.php?accion=editar-local&id=<?= (int) $local['id'] ?>';">
                    <div class="rdm-button--container">
                        <div class="rdm-button--media">
                            <div class="rdm-button--icon"><span class="material-symbols-rounded">edit</span></div>
                        </div>
                        <div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Editar local</span></div>
                    </div>
                </button>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
