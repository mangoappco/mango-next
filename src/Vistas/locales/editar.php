<?php

declare(strict_types=1);

function escaparTextoLocalesEditar(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

function formatearHoraLocalesEditar(?string $valor): string
{
    $valor = trim((string) $valor);

    if ($valor === '') {
        return '';
    }

    return strlen($valor) >= 5 ? substr($valor, 0, 5) : $valor;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo! - Editar local</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
    <script src="recursos/componentes/js/textfield.js"></script>
</head>
<body>
    <header class="rdm-topbar--position"><div class="rdm-topbar--small-container" id="topbar"><div class="rdm-topbar--media"><a href="index.php?accion=ver-local&id=<?= (int) $datos['id'] ?>"><div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div></a></div><div class="rdm-topbar--body"><div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Locales</div></div></div><div class="rdm-topbar--action"><div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema"><span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span></div></div></div></header>

    <main class="rdm--contenedor-toolbar">
        <h1 class="rdm-sys-typography--display-medium">Editar local</h1>

        <?php if ($errores !== []): ?>
            <aside class="rdm-alert rdm-alert--error" role="alert" aria-live="assertive">
                <div class="rdm-alert--icon"><span class="material-symbols-rounded">error</span></div>
                <div class="rdm-alert--body">
                    <?php if (count($errores) === 1): ?><p class="rdm-sys-typography--body-large"><?= escaparTextoLocalesEditar($errores[0]) ?></p><?php else: ?><ul class="rdm-sys-typography--body-large"><?php foreach ($errores as $error): ?><li><?= escaparTextoLocalesEditar($error) ?></li><?php endforeach; ?></ul><?php endif; ?>
                </div>
            </aside>
        <?php endif; ?>

        <form class="rdm-form--container rdm-form--stacked" method="post" action="index.php?accion=editar-local&id=<?= (int) $datos['id'] ?>" enctype="multipart/form-data">
            <div class="rdm-form--elevated"><div class="rdm-form--body">
                <input type="hidden" name="token_csrf" value="<?= escaparTextoLocalesEditar($tokenCsrf) ?>">

                <div class="rdm-select--wrapper"><div class="rdm-select--container rdm-select--outlined"><div class="rdm-select--control"><div class="rdm-select--leading-icon"><span class="material-symbols-rounded">store</span></div><select id="marca_id" name="marca_id" required><?php foreach ($marcas as $marca): ?><option value="<?= (int) $marca['id'] ?>"<?= ((int) ($datos['marca_id'] ?? 0) === (int) $marca['id']) ? ' selected' : '' ?>><?= escaparTextoLocalesEditar((string) $marca['nombre']) ?></option><?php endforeach; ?></select><label class="rdm-select--label" for="marca_id">Marca</label><div class="rdm-select--trailing-icon"><span class="material-symbols-rounded">arrow_drop_down</span></div></div></div></div>

                <?php foreach ([['codigo','Código'],['nombre','Nombre'],['direccion','Dirección'],['telefono','Teléfono'],['ciudad','Ciudad'],['barrio','Barrio']] as [$campo,$label]): ?>
                    <div class="rdm-textfield--wrapper"><div class="rdm-textfield--container rdm-textfield--outlined"><div class="rdm-textfield--control"><input type="text" id="<?= $campo ?>" name="<?= $campo ?>" placeholder=" " value="<?= escaparTextoLocalesEditar((string) ($datos[$campo] ?? '')) ?>"<?= $campo === 'nombre' || $campo === 'direccion' ? ' required' : '' ?>><label class="rdm-textfield--label" for="<?= $campo ?>"><?= $label ?></label></div></div></div>
                <?php endforeach; ?>

                <div class="rdm-select--wrapper"><div class="rdm-select--container rdm-select--outlined"><div class="rdm-select--control"><div class="rdm-select--leading-icon"><span class="material-symbols-rounded">category</span></div><select id="tipo_local" name="tipo_local" required><?php foreach (['sucursal'=>'Sucursal','bodega'=>'Bodega','franquicia'=>'Franquicia','punto_venta'=>'Punto de venta','otro'=>'Otro'] as $valor => $etiqueta): ?><option value="<?= $valor ?>"<?= (($datos['tipo_local'] ?? 'sucursal') === $valor) ? ' selected' : '' ?>><?= $etiqueta ?></option><?php endforeach; ?></select><label class="rdm-select--label" for="tipo_local">Tipo de local</label><div class="rdm-select--trailing-icon"><span class="material-symbols-rounded">arrow_drop_down</span></div></div></div></div>

                <div class="rdm-textfield--wrapper"><div class="rdm-textfield--container rdm-textfield--outlined"><div class="rdm-textfield--control"><input type="time" id="apertura" name="apertura" value="<?= escaparTextoLocalesEditar(formatearHoraLocalesEditar($datos['apertura'] ?? null)) ?>"><label class="rdm-textfield--label" for="apertura">Hora de apertura</label></div></div></div>
                <div class="rdm-textfield--wrapper"><div class="rdm-textfield--container rdm-textfield--outlined"><div class="rdm-textfield--control"><input type="time" id="cierre" name="cierre" value="<?= escaparTextoLocalesEditar(formatearHoraLocalesEditar($datos['cierre'] ?? null)) ?>"><label class="rdm-textfield--label" for="cierre">Hora de cierre</label></div></div></div>
                <div class="rdm-textfield--wrapper"><div class="rdm-textfield--container rdm-textfield--outlined"><div class="rdm-textfield--control"><input type="number" id="propina_porcentaje" name="propina_porcentaje" min="0" max="100" step="0.01" placeholder=" " value="<?= escaparTextoLocalesEditar((string) ($datos['propina_porcentaje'] ?? '0')) ?>"><label class="rdm-textfield--label" for="propina_porcentaje">Propina (%)</label></div></div></div>
            </div></div>

            <h2 class="rdm-sys-typography--display-small">Imagen</h2>
            <div class="rdm-form--elevated"><div class="rdm-form--body">
                <p><img src="<?= escaparTextoLocalesEditar((string) ($datos['imagen'] ?: 'recursos/img/avatar-default.svg')) ?>" alt="Imagen del local <?= escaparTextoLocalesEditar((string) $datos['nombre']) ?>" width="160"></p>
                <p>
                    <label class="rdm-button--outlined rdm-file-picker" for="imagen">
                        <input type="file" id="imagen" name="imagen" class="rdm-file-picker-input" accept="image/jpeg,image/png">
                        <span class="rdm-button--container">
                            <span class="rdm-button--media"><span class="rdm-button--icon"><span class="material-symbols-rounded">add_a_photo</span></span></span>
                            <span class="rdm-button--body"><span class="rdm-sys-typography--label-large">Seleccionar imagen</span></span>
                        </span>
                    </label>
                </p>
                <?php if (!empty($datos['imagen'])): ?><div class="rdm-checkbox--wrapper"><label class="rdm-checkbox--container"><input type="checkbox" class="rdm-checkbox--input" name="eliminar_imagen" value="1"><span class="rdm-checkbox--checkmark"></span><span class="rdm-checkbox--label">Eliminar imagen actual</span></label></div><?php endif; ?>
            </div></div>

            <?php if ($esAdministrador && (int) $datos['activo'] === 1): ?>
                <h2 class="rdm-sys-typography--display-small">Desactivar</h2>
                <div class="rdm-form--elevated"><div class="rdm-form--body"><h3 class="rdm-sys-typography--title-large">Acción administrativa</h3><p class="rdm-sys-typography--body-large">El local no aparecerá como activo mientras permanezca desactivado.</p></div><div class="rdm-form--action-left"><p><button class="rdm-button--filled" type="button" onclick="window.location.href='index.php?accion=desactivar-local&id=<?= (int) $datos['id'] ?>';"><div class="rdm-button--container"><div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">block</span></div></div><div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Desactivar</span></div></div></button></p></div></div>
            <?php elseif ($esAdministrador): ?>
                <h2 class="rdm-sys-typography--display-small">Reactivar</h2>
                <div class="rdm-form--elevated"><div class="rdm-form--body"><h3 class="rdm-sys-typography--title-large">Local inactivo</h3><p class="rdm-sys-typography--body-large">El local podrá volver a aparecer en operación después de reactivarlo.</p></div><div class="rdm-form--action-left"><p><button class="rdm-button--filled" type="button" onclick="window.location.href='index.php?accion=reactivar-local&id=<?= (int) $datos['id'] ?>';"><div class="rdm-button--container"><div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">store</span></div></div><div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Reactivar</span></div></div></button></p></div></div>
            <?php endif; ?>

            <div class="rdm-button--fab-position"><button class="rdm-button--fab" type="submit" title="Guardar cambios" aria-label="Guardar cambios"><div class="rdm-button--container"><div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">check</span></div></div><div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Guardar cambios</span></div></div></button></div>
        </form>
    </main>
</body>
</html>