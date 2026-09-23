<?php

declare(strict_types=1);

function escaparTextoLocalesCrear(string $valor): string
{
    return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ManGo! - Crear local</title>
    <link rel="stylesheet" href="recursos/componentes/css/estilos.css">
    <script src="recursos/componentes/js/topbar_scroll.js"></script>
    <script src="recursos/componentes/js/theme_toggle.js"></script>
    <script src="recursos/componentes/js/textfield.js"></script>
</head>
<body>
    <header class="rdm-topbar--position">
        <div class="rdm-topbar--small-container" id="topbar">
            <div class="rdm-topbar--media"><a href="index.php?accion=locales"><div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div></a></div>
            <div class="rdm-topbar--body"><div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Locales</div></div></div>
            <div class="rdm-topbar--action"><div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema"><span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span></div></div>
        </div>
    </header>

    <main class="rdm--contenedor-toolbar">
        <h1 class="rdm-sys-typography--display-medium">Nuevo local</h1>

        <?php if ($errores !== []): ?>
            <aside class="rdm-alert rdm-alert--error" role="alert" aria-live="assertive">
                <div class="rdm-alert--icon"><span class="material-symbols-rounded">error</span></div>
                <div class="rdm-alert--body">
                    <?php if (count($errores) === 1): ?>
                        <p class="rdm-sys-typography--body-large"><?= escaparTextoLocalesCrear($errores[0]) ?></p>
                    <?php else: ?>
                        <ul class="rdm-sys-typography--body-large">
                            <?php foreach ($errores as $error): ?><li><?= escaparTextoLocalesCrear($error) ?></li><?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </aside>
        <?php endif; ?>

        <form class="rdm-form--container" method="post" action="index.php?accion=crear-local" enctype="multipart/form-data">
            <div class="rdm-form--elevated">
                <div class="rdm-form--body">
                    <input type="hidden" name="token_csrf" value="<?= escaparTextoLocalesCrear($tokenCsrf) ?>">

                    <div class="rdm-select--wrapper">
                        <div class="rdm-select--container rdm-select--outlined">
                            <div class="rdm-select--control">
                                <div class="rdm-select--leading-icon"><span class="material-symbols-rounded">store</span></div>
                                <select id="marca_id" name="marca_id" required>
                                    <option value="">Selecciona una marca</option>
                                    <?php foreach ($marcas as $marca): ?>
                                        <option value="<?= (int) $marca['id'] ?>"<?= ((int) ($datos['marca_id'] ?? 0) === (int) $marca['id']) ? ' selected' : '' ?>><?= escaparTextoLocalesCrear((string) $marca['nombre']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label class="rdm-select--label" for="marca_id">Marca</label>
                                <div class="rdm-select--trailing-icon"><span class="material-symbols-rounded">arrow_drop_down</span></div>
                            </div>
                        </div>
                        <div class="rdm-select--support"><span class="rdm-select--support-text">Asigna el local a una marca o franquicia.</span></div>
                    </div>

                    <?php $campos = [
                        ['codigo', 'Código', 'Identificador interno del local.'],
                        ['nombre', 'Nombre', 'Nombre comercial del punto de venta.'],
                        ['direccion', 'Dirección', 'Dirección física del local.'],
                        ['telefono', 'Teléfono', 'Número de contacto.'],
                        ['ciudad', 'Ciudad', 'Ciudad donde opera el local.'],
                        ['barrio', 'Barrio', 'Zona o barrio de referencia.'],
                    ]; ?>
                    <?php foreach ($campos as [$campo, $label, $ayuda]): ?>
                        <div class="rdm-textfield--wrapper">
                            <div class="rdm-textfield--container rdm-textfield--outlined">
                                <div class="rdm-textfield--control">
                                    <input type="text" id="<?= $campo ?>" name="<?= $campo ?>" placeholder=" " value="<?= escaparTextoLocalesCrear((string) ($datos[$campo] ?? '')) ?>" aria-describedby="<?= $campo ?>_support"<?= $campo === 'nombre' || $campo === 'direccion' ? ' required' : '' ?>>
                                    <label class="rdm-textfield--label" for="<?= $campo ?>"><?= $label ?></label>
                                </div>
                            </div>
                            <div class="rdm-textfield--support"><span class="rdm-textfield--support-text" id="<?= $campo ?>_support"><?= $ayuda ?></span></div>
                        </div>
                    <?php endforeach; ?>

                    <div class="rdm-select--wrapper">
                        <div class="rdm-select--container rdm-select--outlined">
                            <div class="rdm-select--control">
                                <div class="rdm-select--leading-icon"><span class="material-symbols-rounded">category</span></div>
                                <select id="tipo_local" name="tipo_local" required>
                                    <?php foreach ([
                                        'sucursal' => 'Sucursal',
                                        'bodega' => 'Bodega',
                                        'franquicia' => 'Franquicia',
                                        'punto_venta' => 'Punto de venta',
                                        'otro' => 'Otro',
                                    ] as $valor => $etiqueta): ?>
                                        <option value="<?= $valor ?>"<?= (($datos['tipo_local'] ?? 'sucursal') === $valor) ? ' selected' : '' ?>><?= $etiqueta ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label class="rdm-select--label" for="tipo_local">Tipo de local</label>
                                <div class="rdm-select--trailing-icon"><span class="material-symbols-rounded">arrow_drop_down</span></div>
                            </div>
                        </div>
                        <div class="rdm-select--support"><span class="rdm-select--support-text">Clasifica el punto de venta.</span></div>
                    </div>

                    <div class="rdm-textfield--wrapper">
                        <div class="rdm-textfield--container rdm-textfield--outlined"><div class="rdm-textfield--control"><input type="time" id="apertura" name="apertura" placeholder=" " value="<?= escaparTextoLocalesCrear((string) ($datos['apertura'] ?? '')) ?>"><label class="rdm-textfield--label" for="apertura">Hora de apertura</label></div></div>
                    </div>

                    <div class="rdm-textfield--wrapper">
                        <div class="rdm-textfield--container rdm-textfield--outlined"><div class="rdm-textfield--control"><input type="time" id="cierre" name="cierre" placeholder=" " value="<?= escaparTextoLocalesCrear((string) ($datos['cierre'] ?? '')) ?>"><label class="rdm-textfield--label" for="cierre">Hora de cierre</label></div></div>
                    </div>

                    <div class="rdm-textfield--wrapper">
                        <div class="rdm-textfield--container rdm-textfield--outlined"><div class="rdm-textfield--control"><input type="number" id="propina_porcentaje" name="propina_porcentaje" min="0" max="100" step="0.01" placeholder=" " value="<?= escaparTextoLocalesCrear((string) ($datos['propina_porcentaje'] ?? '0')) ?>"><label class="rdm-textfield--label" for="propina_porcentaje">Propina (%)</label></div></div>
                    </div>

                    <p>
                        <label class="rdm-button--outlined rdm-file-picker" for="imagen">
                            <input type="file" id="imagen" name="imagen" class="rdm-file-picker-input" accept="image/jpeg,image/png">
                            <span class="rdm-button--container">
                                <span class="rdm-button--media"><span class="rdm-button--icon"><span class="material-symbols-rounded">add_a_photo</span></span></span>
                                <span class="rdm-button--body"><span class="rdm-sys-typography--label-large">Seleccionar imagen</span></span>
                            </span>
                        </label>
                    </p>
                </div>
            </div>

            <div class="rdm-button--fab-position"><button class="rdm-button--fab" type="submit" title="Guardar local" aria-label="Guardar local"><div class="rdm-button--container"><div class="rdm-button--media"><div class="rdm-button--icon"><span class="material-symbols-rounded">save</span></div></div><div class="rdm-button--body"><span class="rdm-sys-typography--label-large">Guardar local</span></div></div></button></div>
        </form>
    </main>
</body>
</html>