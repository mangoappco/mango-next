<?php

// Activa el modo estricto de tipos para este archivo.
declare(strict_types=1);

// Convierte cualquier valor recibido en texto seguro para HTML.
function escaparTextoDetalle(string $valor): string
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
    <title>ManGo! - Detalle del usuario</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
    <script src="recursos/componentes/js/snackbar.js"></script>
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

        <h1 class="rdm-sys-typography--display-medium">Detalle del usuario</h1>

        <article class="rdm-card--container">
            <div class="rdm-card--elevated rdm-card--list">

                <div
                    class="rdm-card--media"
                    style="background-image: url('<?= escaparTextoDetalle((string) ($usuario['foto_perfil'] ?: 'recursos/img/avatar-default.svg')) ?>');"
                    role="img"
                    aria-label="Imagen de perfil de <?= escaparTextoDetalle((string) $usuario['nombres']) ?>"
                ></div>

                <div class="rdm-card--body">
                    <h2 class="rdm-sys-typography--display-small">
                        <?= escaparTextoDetalle((string) $usuario['nombres']) ?>
                        <?= escaparTextoDetalle((string) $usuario['apellidos']) ?>
                    </h2>

                    <?php
                    // Define los campos del usuario con su ícono, etiqueta y valor a mostrar.
                    $campos = [
                        ['mail', 'Correo', (string) $usuario['correo']],
                        ['manage_accounts', 'Tipo', (string) $usuario['tipo']],
                        ['verified', 'Estado', Mango\Core\Texto::estado((int) $usuario['activo'] === 1)],
                    ];
                    ?>

                    <?php foreach ($campos as [$icono, $etiqueta, $valor]): ?>
                        <div class="rdm-list--container">
                            <div class="rdm-list--media">
                                <div class="rdm-list--leading-icon"><span class="material-symbols-rounded"><?= escaparTextoDetalle($icono) ?></span></div>
                            </div>
                            <div class="rdm-list--body">
                                <div class="rdm-list--body-headline"><?= escaparTextoDetalle($etiqueta) ?></div>
                                <div class="rdm-list--body-suporting-text"><?= escaparTextoDetalle($valor) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="rdm-list--container">
                        <div class="rdm-list--media">
                            <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">schedule</span></div>
                        </div>
                        <div class="rdm-list--body">
                            <div class="rdm-list--body-headline">Creado</div>
                            <div class="rdm-list--body-suporting-text"><?= nl2br(escaparTextoDetalle(Mango\Core\Fechas::relativa((string) $usuario['creado_en']))) ?></div>
                        </div>
                    </div>

                    <div class="rdm-list--container">
                        <div class="rdm-list--media">
                            <div class="rdm-list--leading-icon"><span class="material-symbols-rounded">update</span></div>
                        </div>
                        <div class="rdm-list--body">
                            <div class="rdm-list--body-headline">Actualizado</div>
                            <div class="rdm-list--body-suporting-text"><?= nl2br(escaparTextoDetalle(Mango\Core\Fechas::relativa((string) $usuario['actualizado_en']))) ?></div>
                        </div>
                    </div>

                </div>
            </div>
        </article>

        <?php if ($esAdministrador): ?>
            <div class="rdm-button--fab-position">
                <button
                    class="rdm-button--fab"
                    type="button"
                    title="Editar usuario"
                    aria-label="Editar usuario"
                    onclick="window.location.href='index.php?accion=editar&id=<?= (int) $usuario['id'] ?>';"
                >
                    <div class="rdm-button--container">
                        <div class="rdm-button--media">
                            <div class="rdm-button--icon">
                                <span class="material-symbols-rounded">edit</span>
                            </div>
                        </div>
                        <div class="rdm-button--body">
                            <span class="rdm-sys-typography--label-large">Editar usuario</span>
                        </div>
                    </div>
                </button>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>