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
    <script src="js/textfield.js"></script>
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
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Text field</div></div>
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


    <h1 class="rdm-sys-typography--display-medium">Text field</h1>

    <!-- Form container -->
    <form class="rdm-form--container" action="#" method="post" target="_self">

        <!-- Form type: filled, elevated, outlined -->
        <div class="rdm-form--outlined">

            <!-- Body section -->
            <div class="rdm-form--body">
                
                <h2 class="rdm-sys-typography--title-large">Enabled (empty)</h2>
                <!-- Text Field: Outlined -->
                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <div class="rdm-textfield--leading-icon">
                                <span class="material-symbols-rounded">search</span>
                            </div>
                            <input id="tf_enabled_empty" type="text" name="enabled_empty" placeholder=" " aria-describedby="tf_enabled_empty_help">
                            <label class="rdm-textfield--label" for="tf_enabled_empty">Label text</label>
                            <div class="rdm-textfield--trailing-icon" data-clear-input="tf_enabled_empty">
                                <span class="material-symbols-rounded">close</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="tf_enabled_empty_help">Supporting text</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Enabled (populated)</h2>
                <!-- Text Field: Outlined with content -->
                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <div class="rdm-textfield--leading-icon">
                                <span class="material-symbols-rounded">search</span>
                            </div>
                            <input id="tf_enabled_populated" type="text" name="enabled_populated" placeholder=" " value="Input text" aria-describedby="tf_enabled_populated_help">
                            <label class="rdm-textfield--label" for="tf_enabled_populated">Label text</label>
                            <div class="rdm-textfield--trailing-icon" data-clear-input="tf_enabled_populated">
                                <span class="material-symbols-rounded">close</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="tf_enabled_populated_help">Supporting text</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Disabled (empty)</h2>
                <!-- Text Field: Disabled empty -->
                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <div class="rdm-textfield--leading-icon">
                                <span class="material-symbols-rounded">search</span>
                            </div>
                            <input id="tf_disabled_empty" type="text" name="disabled_empty" placeholder=" " disabled aria-describedby="tf_disabled_empty_help">
                            <label class="rdm-textfield--label" for="tf_disabled_empty">Label text</label>
                            <div class="rdm-textfield--trailing-icon" data-clear-input="tf_disabled_empty">
                                <span class="material-symbols-rounded">close</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="tf_disabled_empty_help">Supporting text</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Disabled (populated)</h2>
                <!-- Text Field: Disabled with content -->
                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <div class="rdm-textfield--leading-icon">
                                <span class="material-symbols-rounded">search</span>
                            </div>
                            <input id="tf_disabled_populated" type="text" name="disabled_populated" placeholder=" " value="Input text" disabled aria-describedby="tf_disabled_populated_help">
                            <label class="rdm-textfield--label" for="tf_disabled_populated">Label text</label>
                            <div class="rdm-textfield--trailing-icon" data-clear-input="tf_disabled_populated">
                                <span class="material-symbols-rounded">close</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="tf_disabled_populated_help">Supporting text</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Focused & Hovered</h2>
                <p class="rdm-sys-typography--body-medium">Haz click en el campo para ver el estado focused (borde primary 2px). Pasa el cursor sobre el campo para ver el estado hovered (borde más oscuro).</p>

                <!-- Text Field: Outlined -->
                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <div class="rdm-textfield--leading-icon">
                                <span class="material-symbols-rounded">search</span>
                            </div>
                            <input id="tf_nombre" type="text" name="nombre" placeholder=" " aria-describedby="tf_nombre_help" autocomplete="name">
                            <label class="rdm-textfield--label" for="tf_nombre">Nombre</label>
                            <div class="rdm-textfield--trailing-icon" data-clear-input="tf_nombre">
                                <span class="material-symbols-rounded">close</span>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="tf_nombre_help">Ingresa tu nombre completo</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Sin iconos</h2>
                <!-- Text Field: Outlined without icons -->
                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <input id="tf_correo" type="email" name="correo" placeholder=" " aria-describedby="tf_correo_help" autocomplete="email">
                            <label class="rdm-textfield--label" for="tf_correo">Correo electrónico</label>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="tf_correo_help">Usa un correo válido</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Input con contador de caracteres</h2>
                <!-- Text Field: Input with character counter -->
                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <input id="tf_username" type="text" name="username" placeholder=" " maxlength="20" aria-describedby="tf_username_help">
                            <label class="rdm-textfield--label" for="tf_username">Username</label>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="tf_username_help">Elige tu nombre de usuario</span>
                        <span class="rdm-textfield--support-counter" data-counter-for="tf_username">0/20</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Textarea</h2>
                <!-- Text Area: Outlined -->
                <div class="rdm-textfield--wrapper">
                    <div class="rdm-textfield--container rdm-textfield--outlined">
                        <div class="rdm-textfield--control">
                            <textarea id="tf_mensaje" name="mensaje" placeholder=" " aria-describedby="tf_mensaje_help" maxlength="500"></textarea>
                            <label class="rdm-textfield--label" for="tf_mensaje">Mensaje</label>
                        </div>
                    </div>
                    <div class="rdm-textfield--support">
                        <span class="rdm-textfield--support-text" id="tf_mensaje_help">Máximo 500 caracteres</span>
                        <span class="rdm-textfield--support-counter" data-counter-for="tf_mensaje">0/500</span>
                    </div>
                </div>

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

