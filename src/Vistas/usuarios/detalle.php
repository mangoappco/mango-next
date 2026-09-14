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
                $iconoMensaje = match ($tipoMensaje) {
                    'exito' => 'check_circle',
                    'error' => 'error',
                    'advertencia' => 'warning',
                    default => 'info',
                };
            ?>
            <aside class="rdm-alert rdm-alert--<?= escaparTextoDetalle($tipoMensaje) ?>" role="status" aria-live="polite">
                <div class="rdm-alert--icon">
                    <span class="material-symbols-rounded"><?= $iconoMensaje ?></span>
                </div>
                <div class="rdm-alert--body">
                    <p class="rdm-sys-typography--body-large">
                        <?= escaparTextoDetalle($textoMensaje) ?>
                    </p>
                </div>
            </aside>
        <?php endif; ?>

        <h1 class="rdm-sys-typography--display-medium">Detalle del usuario</h1>

        <section class="rdm-card--container">
            <article class="rdm-card--elevated">
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
                    <p class="rdm-sys-typography--body-large">
                        <strong>Correo:</strong><br>
                        <?= escaparTextoDetalle((string) $usuario['correo']) ?>
                    </p>
                    <p class="rdm-sys-typography--body-large">
                        <strong>Tipo:</strong><br>
                        <?= escaparTextoDetalle((string) $usuario['tipo']) ?>
                    </p>
                    <p class="rdm-sys-typography--body-large">
                        <strong>Estado:</strong><br>
                        <?= (int) $usuario['activo'] === 1 ? 'Activo' : 'Inactivo' ?>
                    </p>
                    <p class="rdm-sys-typography--body-large">
                        <strong>Creado:</strong><br>
                        <?= escaparTextoDetalle((string) $usuario['creado_en']) ?>
                    </p>
                    <p class="rdm-sys-typography--body-large">
                        <strong>Actualizado:</strong><br>
                        <?= escaparTextoDetalle((string) $usuario['actualizado_en']) ?>
                    </p>
                </div>

            </article>
        </section>

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