<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>RDM 2.0 - ManGo!</title>
	<link rel="stylesheet" href="css/estilos.css">
	<!-- Script que cambia los atributos de la top bar al hacer scroll -->
	<script src="js/topbar_scroll.js"></script>
    <script src="js/theme_toggle.js"></script>
</head>
<body>

<!-- Top bar -->
<header class="rdm-topbar--position">	

	<!-- Top bar container -->
	<div class="rdm-topbar--small-container" id="topbar">

		<!-- Top bar media -->
		<div class="rdm-topbar--media">
			<a href="index.php"><div class="rdm-topbar--leading-navigation-icon"><span class="material-symbols-rounded">arrow_back</span></div></a>
		</div>

		<!-- Top bar body-->
		<div class="rdm-topbar--body">
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Select</div></div>
		</div>

        <!-- Top bar action-->
        <div class="rdm-topbar--action">
            <div class="rdm-topbar--trailing-icon" id="themeToggle" title="Cambiar tema">
                <span class="material-symbols-rounded" id="themeToggleIcon">dark_mode</span>
            </div>
            <div class="rdm-topbar--avatar" style="background-image: url(img/a1.jpg);">
                <div class="rdm-sys-typography--title-medium"></div>
            </div>
        </div>

	</div>
	
</header>

<main class="rdm--contenedor-toolbar">

    <h1 class="rdm-sys-typography--display-medium">Select</h1>

    <!-- Form container -->
    <form class="rdm-form--container" action="#" method="post" target="_self">

        <!-- Form type: outlined -->
        <div class="rdm-form--outlined">

            <!-- Body section -->
            <div class="rdm-form--body">
                
                <h2 class="rdm-sys-typography--title-large">Enabled (empty)</h2>
                <p class="rdm-sys-typography--body-medium">Select sin valor seleccionado</p>
                <!-- Select: Outlined -->
                <div class="rdm-select--wrapper">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <div class="rdm-select--leading-icon">
                                <span class="material-symbols-rounded">category</span>
                            </div>
                            <select id="select_empty" name="categoria" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="1">Opción 1</option>
                                <option value="2">Opción 2</option>
                                <option value="3">Opción 3</option>
                                <option value="4">Opción 4</option>
                            </select>
                            <label class="rdm-select--label" for="select_empty">Selecciona una opción</label>
                            <div class="rdm-select--trailing-icon">
                                <span class="material-symbols-rounded">arrow_drop_down</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-select--support">
                        <span class="rdm-select--support-text">Supporting text</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Enabled (populated)</h2>
                <p class="rdm-sys-typography--body-medium">Select con valor preseleccionado</p>
                <!-- Select: Outlined with value -->
                <div class="rdm-select--wrapper">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <div class="rdm-select--leading-icon">
                                <span class="material-symbols-rounded">location_on</span>
                            </div>
                            <select id="select_populated" name="pais" required>
                                <option value="">Seleccionar...</option>
                                <option value="mx" selected>México</option>
                                <option value="us">Estados Unidos</option>
                                <option value="ca">Canadá</option>
                                <option value="es">España</option>
                                <option value="ar">Argentina</option>
                            </select>
                            <label class="rdm-select--label" for="select_populated">País</label>
                            <div class="rdm-select--trailing-icon">
                                <span class="material-symbols-rounded">arrow_drop_down</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-select--support">
                        <span class="rdm-select--support-text">Selecciona tu país</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Disabled (empty)</h2>
                <!-- Select: Disabled empty -->
                <div class="rdm-select--wrapper">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <div class="rdm-select--leading-icon">
                                <span class="material-symbols-rounded">shopping_cart</span>
                            </div>
                            <select id="select_disabled_empty" name="producto" disabled required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="1">Producto 1</option>
                                <option value="2">Producto 2</option>
                            </select>
                            <label class="rdm-select--label" for="select_disabled_empty">Producto</label>
                            <div class="rdm-select--trailing-icon">
                                <span class="material-symbols-rounded">arrow_drop_down</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-select--support">
                        <span class="rdm-select--support-text">Campo deshabilitado</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Disabled (populated)</h2>
                <!-- Select: Disabled with value -->
                <div class="rdm-select--wrapper">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <div class="rdm-select--leading-icon">
                                <span class="material-symbols-rounded">language</span>
                            </div>
                            <select id="select_disabled_populated" name="idioma" disabled required>
                                <option value="">Seleccionar...</option>
                                <option value="es" selected>Español</option>
                                <option value="en">English</option>
                                <option value="fr">Français</option>
                            </select>
                            <label class="rdm-select--label" for="select_disabled_populated">Idioma</label>
                            <div class="rdm-select--trailing-icon">
                                <span class="material-symbols-rounded">arrow_drop_down</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-select--support">
                        <span class="rdm-select--support-text">Campo deshabilitado con valor</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Focused & Hovered</h2>
                <p class="rdm-sys-typography--body-medium">Haz click para ver el estado focused (borde primary 2px). Pasa el cursor sobre el campo para ver el estado hovered (borde más oscuro).</p>
                <!-- Select: For testing focus and hover -->
                <div class="rdm-select--wrapper">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <select id="select_focus" name="prioridad" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="alta">Alta</option>
                                <option value="media">Media</option>
                                <option value="baja">Baja</option>
                            </select>
                            <label class="rdm-select--label" for="select_focus">Prioridad</label>
                            <div class="rdm-select--trailing-icon">
                                <span class="material-symbols-rounded">arrow_drop_down</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-select--support">
                        <span class="rdm-select--support-text">Prueba los estados hover y focus</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Sin icono leading</h2>
                <!-- Select: Without leading icon -->
                <div class="rdm-select--wrapper">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <select id="select_no_icon" name="estado" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                                <option value="pendiente">Pendiente</option>
                            </select>
                            <label class="rdm-select--label" for="select_no_icon">Estado</label>
                            <div class="rdm-select--trailing-icon">
                                <span class="material-symbols-rounded">arrow_drop_down</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-select--support">
                        <span class="rdm-select--support-text">Select sin icono leading</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Error state</h2>
                <p class="rdm-sys-typography--body-medium">Select con estado de error (clase .is-error en wrapper)</p>
                <!-- Select: Error state -->
                <div class="rdm-select--wrapper is-error">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <div class="rdm-select--leading-icon">
                                <span class="material-symbols-rounded">error</span>
                            </div>
                            <select id="select_error" name="tipo" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="1">Tipo 1</option>
                                <option value="2">Tipo 2</option>
                            </select>
                            <label class="rdm-select--label" for="select_error">Tipo requerido</label>
                            <div class="rdm-select--trailing-icon">
                                <span class="material-symbols-rounded">arrow_drop_down</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-select--support">
                        <span class="rdm-select--support-text">Este campo es requerido</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Select con muchas opciones</h2>
                <!-- Select: Many options -->
                <div class="rdm-select--wrapper">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <div class="rdm-select--leading-icon">
                                <span class="material-symbols-rounded">calendar_month</span>
                            </div>
                            <select id="select_mes" name="mes" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                            </select>
                            <label class="rdm-select--label" for="select_mes">Mes</label>
                            <div class="rdm-select--trailing-icon">
                                <span class="material-symbols-rounded">arrow_drop_down</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-select--support">
                        <span class="rdm-select--support-text">Selecciona un mes del año</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Select con Optgroup</h2>
                <p class="rdm-sys-typography--body-medium">Agrupación de opciones con separadores</p>
                <!-- Select: With optgroup -->
                <div class="rdm-select--wrapper">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <div class="rdm-select--leading-icon">
                                <span class="material-symbols-rounded">devices</span>
                            </div>
                            <select id="select_optgroup" name="dispositivo" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <optgroup label="Móviles">
                                    <option value="iphone">iPhone</option>
                                    <option value="android">Android</option>
                                </optgroup>
                                <optgroup label="Computadoras">
                                    <option value="mac">Mac</option>
                                    <option value="windows">Windows</option>
                                    <option value="linux">Linux</option>
                                </optgroup>
                                <optgroup label="Tablets">
                                    <option value="ipad">iPad</option>
                                    <option value="android_tablet">Tablet Android</option>
                                </optgroup>
                            </select>
                            <label class="rdm-select--label" for="select_optgroup">Dispositivo</label>
                            <div class="rdm-select--trailing-icon">
                                <span class="material-symbols-rounded">arrow_drop_down</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-select--support">
                        <span class="rdm-select--support-text">Opciones agrupadas por categoría</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Validación HTML5 automática</h2>
                <p class="rdm-sys-typography--body-medium">Campo requerido que muestra error automáticamente si no se selecciona (sin clase .is-error)</p>
                <!-- Select: HTML5 validation -->
                <div class="rdm-select--wrapper">
                    <div class="rdm-select--container rdm-select--outlined">
                        <div class="rdm-select--control">
                            <div class="rdm-select--leading-icon">
                                <span class="material-symbols-rounded">star</span>
                            </div>
                            <select id="select_validation" name="rating" required>
                                <option value="" disabled selected>Seleccionar...</option>
                                <option value="5">★★★★★ Excelente</option>
                                <option value="4">★★★★☆ Muy bueno</option>
                                <option value="3">★★★☆☆ Bueno</option>
                                <option value="2">★★☆☆☆ Regular</option>
                                <option value="1">★☆☆☆☆ Malo</option>
                            </select>
                            <label class="rdm-select--label" for="select_validation">Calificación</label>
                            <div class="rdm-select--trailing-icon">
                                <span class="material-symbols-rounded">arrow_drop_down</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-select--support">
                        <span class="rdm-select--support-text">Este campo es requerido (se valida automáticamente)</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Fieldset - Agrupación de selects relacionados</h2>
                <p class="rdm-sys-typography--body-medium">Múltiples selects con espaciado consistente usando fieldset</p>
                <!-- Fieldset: Multiple selects -->
                <fieldset class="rdm-select--fieldset">
                    <legend class="rdm-sys-typography--title-medium">Fecha de nacimiento</legend>
                    
                    <!-- Día -->
                    <div class="rdm-select--wrapper">
                        <div class="rdm-select--container rdm-select--outlined">
                            <div class="rdm-select--control">
                                <select id="select_dia" name="dia" required>
                                    <option value="" disabled selected>Día</option>
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="15">15</option>
                                    <option value="31">31</option>
                                </select>
                                <label class="rdm-select--label" for="select_dia">Día</label>
                                <div class="rdm-select--trailing-icon">
                                    <span class="material-symbols-rounded">arrow_drop_down</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mes -->
                    <div class="rdm-select--wrapper">
                        <div class="rdm-select--container rdm-select--outlined">
                            <div class="rdm-select--control">
                                <select id="select_mes_fieldset" name="mes_fieldset" required>
                                    <option value="" disabled selected>Mes</option>
                                    <option value="01">Enero</option>
                                    <option value="02">Febrero</option>
                                    <option value="03">Marzo</option>
                                    <option value="06">Junio</option>
                                    <option value="12">Diciembre</option>
                                </select>
                                <label class="rdm-select--label" for="select_mes_fieldset">Mes</label>
                                <div class="rdm-select--trailing-icon">
                                    <span class="material-symbols-rounded">arrow_drop_down</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Año -->
                    <div class="rdm-select--wrapper">
                        <div class="rdm-select--container rdm-select--outlined">
                            <div class="rdm-select--control">
                                <select id="select_anio" name="anio" required>
                                    <option value="" disabled selected>Año</option>
                                    <option value="2000">2000</option>
                                    <option value="1995">1995</option>
                                    <option value="1990">1990</option>
                                    <option value="1985">1985</option>
                                    <option value="1980">1980</option>
                                </select>
                                <label class="rdm-select--label" for="select_anio">Año</label>
                                <div class="rdm-select--trailing-icon">
                                    <span class="material-symbols-rounded">arrow_drop_down</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

            </div>

            <!-- Action section aligment: left, center, right -->
            <div class="rdm-form--action-right">
            <p>
                <!-- reset -->
                <button type="reset" class="rdm-button--text">
                <div class="rdm-button--container">
                    <div class="rdm-button--media">
                        <div class="rdm-button--icon"><span class="material-symbols-rounded">refresh</span></div>
                    </div>
                    <div class="rdm-button--body">
                        <span class="rdm-sys-typography--label-large">Limpiar</span>
                    </div>
                </div>
                </button>

                <!-- submit -->
                <button type="submit" class="rdm-button--filled">
                <div class="rdm-button--container">
                    <div class="rdm-button--media">
                        <div class="rdm-button--icon"><span class="material-symbols-rounded">send</span></div>
                    </div>
                    <div class="rdm-button--body">
                        <span class="rdm-sys-typography--label-large">Enviar</span>
                    </div>
                </div>
                </button>
			
            </p> 
            </div>

        </div>
    </form>
    
</main>

</body>
</html>
