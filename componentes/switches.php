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
    <script src="js/switch.js"></script>
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
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Switch</div></div>
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

    <!-- Outlined form -->

    <h1 class="rdm-sys-typography--display-medium">Switch</h1>

    <!-- Form container -->
    <form class="rdm-form--container" action="#" method="post" target="_self">

        <!-- Form type: outlined -->
        <div class="rdm-form--outlined">

            

            <!-- Body section -->
            <div class="rdm-form--body">
                
                <!-- SWITCH: Without icons -->
                <h2 class="rdm-sys-typography--title-large">Without icons</h2>
                
                <h3 class="rdm-sys-typography--title-medium">Enabled (unchecked)</h3>
                <div class="rdm-switch--wrapper">
                    <div class="rdm-switch--container">
                        <input type="checkbox" class="rdm-switch--input" id="sw1" name="switch1">
                        <div class="rdm-switch--track">
                            <div class="rdm-switch--handle">
                                <div class="rdm-switch--state-layer"></div>
                            </div>
                        </div>
                    </div>
                    <label class="rdm-switch--label" for="sw1">
                        <span class="rdm-sys-typography--body-large rdm-switch--label-text">Switch sin icono</span>
                    </label>
                </div>

                <h3 class="rdm-sys-typography--title-medium">Enabled (checked)</h3>
                <div class="rdm-switch--wrapper">
                    <div class="rdm-switch--container">
                        <input type="checkbox" class="rdm-switch--input" id="sw2" name="switch2" checked>
                        <div class="rdm-switch--track">
                            <div class="rdm-switch--handle">
                                <div class="rdm-switch--state-layer"></div>
                            </div>
                        </div>
                    </div>
                    <label class="rdm-switch--label" for="sw2">
                        <span class="rdm-sys-typography--body-large rdm-switch--label-text">Switch activado</span>
                    </label>
                </div>

                <!-- SWITCH: Icon on selected -->
                <h2 class="rdm-sys-typography--title-large">Icon on selected switch</h2>
                
                <h3 class="rdm-sys-typography--title-medium">Enabled (unchecked)</h3>
                <div class="rdm-switch--wrapper">
                    <div class="rdm-switch--container with-icon">
                        <input type="checkbox" class="rdm-switch--input" id="sw3" name="switch3">
                        <div class="rdm-switch--track">
                            <div class="rdm-switch--handle">
                                <span class="rdm-switch--icon material-symbols-rounded">check</span>
                                <div class="rdm-switch--state-layer"></div>
                            </div>
                        </div>
                    </div>
                    <label class="rdm-switch--label" for="sw3">
                        <span class="rdm-sys-typography--body-large rdm-switch--label-text">Permission manager</span>
                        <span class="rdm-sys-typography--body-medium rdm-switch--support-text">App has access to your data</span>
                    </label>
                </div>

                <h3 class="rdm-sys-typography--title-medium">Enabled (checked)</h3>
                <div class="rdm-switch--wrapper">
                    <div class="rdm-switch--container with-icon">
                        <input type="checkbox" class="rdm-switch--input" id="sw4" name="switch4" checked>
                        <div class="rdm-switch--track">
                            <div class="rdm-switch--handle">
                                <span class="rdm-switch--icon material-symbols-rounded">check</span>
                                <div class="rdm-switch--state-layer"></div>
                            </div>
                        </div>
                    </div>
                    <label class="rdm-switch--label" for="sw4">
                        <span class="rdm-sys-typography--body-large rdm-switch--label-text">Camera access</span>
                        <span class="rdm-sys-typography--body-medium rdm-switch--support-text">App has access to your camera</span>
                    </label>
                </div>

                <!-- SWITCH: Icon on both states -->
                <h2 class="rdm-sys-typography--title-large">Icon on selected and unselected</h2>
                
                <h3 class="rdm-sys-typography--title-medium">Enabled (unchecked)</h3>
                <div class="rdm-switch--wrapper">
                    <div class="rdm-switch--container with-icon icon-both">
                        <input type="checkbox" class="rdm-switch--input" id="sw5" name="switch5">
                        <div class="rdm-switch--track">
                            <div class="rdm-switch--handle">
                                <span class="rdm-switch--icon material-symbols-rounded">close</span>
                                <div class="rdm-switch--state-layer"></div>
                            </div>
                        </div>
                    </div>
                    <label class="rdm-switch--label" for="sw5">
                        <span class="rdm-sys-typography--body-large rdm-switch--label-text">Show password</span>
                    </label>
                </div>

                <h3 class="rdm-sys-typography--title-medium">Enabled (checked)</h3>
                <div class="rdm-switch--wrapper">
                    <div class="rdm-switch--container with-icon icon-both">
                        <input type="checkbox" class="rdm-switch--input" id="sw6" name="switch6" checked>
                        <div class="rdm-switch--track">
                            <div class="rdm-switch--handle">
                                <span class="rdm-switch--icon material-symbols-rounded">check</span>
                                <div class="rdm-switch--state-layer"></div>
                            </div>
                        </div>
                    </div>
                    <label class="rdm-switch--label" for="sw6">
                        <span class="rdm-sys-typography--body-large rdm-switch--label-text">Notifications enabled</span>
                    </label>
                </div>

                <!-- SWITCH: Disabled states -->
                <h2 class="rdm-sys-typography--title-large">Disabled</h2>
                
                <h3 class="rdm-sys-typography--title-medium">Disabled (unchecked)</h3>
                <div class="rdm-switch--wrapper">
                    <div class="rdm-switch--container">
                        <input type="checkbox" class="rdm-switch--input" id="sw7" name="switch7" disabled>
                        <div class="rdm-switch--track">
                            <div class="rdm-switch--handle">
                                <div class="rdm-switch--state-layer"></div>
                            </div>
                        </div>
                    </div>
                    <label class="rdm-switch--label" for="sw7">
                        <span class="rdm-sys-typography--body-large rdm-switch--label-text">Switch deshabilitado</span>
                    </label>
                </div>

                <h3 class="rdm-sys-typography--title-medium">Disabled (checked)</h3>
                <div class="rdm-switch--wrapper">
                    <div class="rdm-switch--container with-icon">
                        <input type="checkbox" class="rdm-switch--input" id="sw8" name="switch8" checked disabled>
                        <div class="rdm-switch--track">
                            <div class="rdm-switch--handle">
                                <span class="rdm-switch--icon material-symbols-rounded">check</span>
                                <div class="rdm-switch--state-layer"></div>
                            </div>
                        </div>
                    </div>
                    <label class="rdm-switch--label" for="sw8">
                        <span class="rdm-sys-typography--body-large rdm-switch--label-text">Switch deshabilitado activo</span>
                    </label>
                </div>

                <!-- SWITCH: Interactive examples -->
                <h2 class="rdm-sys-typography--title-large">Hover, Focus & Pressed</h2>
                <p class="rdm-sys-typography--body-medium">Haz click en el switch para ver el estado pressed. Pasa el cursor para ver el estado hover. Usa Tab para ver el estado focus.</p>
                
                <div class="rdm-switch--wrapper">
                    <div class="rdm-switch--container with-icon">
                        <input type="checkbox" class="rdm-switch--input" id="sw9" name="switch9">
                        <div class="rdm-switch--track">
                            <div class="rdm-switch--handle">
                                <span class="rdm-switch--icon material-symbols-rounded">check</span>
                                <div class="rdm-switch--state-layer"></div>
                            </div>
                        </div>
                    </div>
                    <label class="rdm-switch--label" for="sw9">
                        <span class="rdm-sys-typography--body-large rdm-switch--label-text">Interactúa con este switch</span>
                        <span class="rdm-sys-typography--body-medium rdm-switch--support-text">Prueba hover, focus y pressed</span>
                    </label>
                </div>

            </div>

            <!-- Action section aligment: left, center, right -->
            <div class="rdm-form--action-left">
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

