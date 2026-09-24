<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>RDM 2.0 - ManGo!</title>
	<link rel="stylesheet" href="css/estilos.css">
	<script src="js/topbar_scroll.js"></script>
    <script src="js/theme_toggle.js"></script>
    <script src="js/search.js"></script>
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
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Search</div></div>
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

    <h1 class="rdm-sys-typography--display-medium">Search</h1>

    <!-- Form container -->
    <form class="rdm-form--container" action="#" method="post" target="_self">

        <!-- Form type: outlined -->
        <div class="rdm-form--outlined">

            <!-- Body section -->
            <div class="rdm-form--body">
                
                <h2 class="rdm-sys-typography--title-large">Config 1: With avatar</h2>
                <p class="rdm-sys-typography--body-medium">Search bar con avatar del usuario</p>
                <!-- Search: With avatar -->
                <div class="rdm-search--wrapper">
                    <div class="rdm-search--container">
                        <div class="rdm-search--bar">
                            <div class="rdm-search--control">
                                <button class="rdm-search--leading-icon" type="button" aria-label="Buscar">
                                    <span class="material-symbols-rounded">search</span>
                                </button>
                                <input type="search" id="search_avatar" name="search_avatar" placeholder="Buscar...">
                                <div class="rdm-search--trailing">
                                    <img class="rdm-search--avatar" src="img/a1.jpg" alt="Avatar usuario">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-search--support">
                        <span>Búsqueda con perfil de usuario</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Config 2: With one trailing icon (search)</h2>
                <p class="rdm-sys-typography--body-medium">Search bar estándar con icono búsqueda</p>
                <!-- Search: With search icon -->
                <div class="rdm-search--wrapper">
                    <div class="rdm-search--container">
                        <div class="rdm-search--bar">
                            <div class="rdm-search--control">
                                <button class="rdm-search--leading-icon" type="button" aria-label="Buscar">
                                    <span class="material-symbols-rounded">search</span>
                                </button>
                                <input type="search" id="search_icon1" name="search_icon1" placeholder="Buscar...">
                                <div class="rdm-search--trailing">
                                    <button class="rdm-search--trailing-icon show" type="button" aria-label="Buscar">
                                        <span class="material-symbols-rounded">search</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-search--support">
                        <span>Buscar con icono de búsqueda</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Config 3: With two trailing icon buttons</h2>
                <p class="rdm-sys-typography--body-medium">Search avanzada con voz + búsqueda</p>
                <!-- Search: With voice and search icons -->
                <div class="rdm-search--wrapper">
                    <div class="rdm-search--container">
                        <div class="rdm-search--bar">
                            <div class="rdm-search--control">
                                <button class="rdm-search--leading-icon" type="button" aria-label="Buscar">
                                    <span class="material-symbols-rounded">search</span>
                                </button>
                                <input type="search" id="search_voice" name="search_voice" placeholder="Buscar o decir...">
                                <div class="rdm-search--trailing">
                                    <button class="rdm-search--trailing-icon show" type="button" aria-label="Búsqueda por voz">
                                        <span class="material-symbols-rounded">mic</span>
                                    </button>
                                    <button class="rdm-search--trailing-icon show" type="button" aria-label="Buscar">
                                        <span class="material-symbols-rounded">search</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-search--support">
                        <span>Búsqueda avanzada (voz + texto)</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Config 4: With avatar and trailing icon</h2>
                <p class="rdm-sys-typography--body-medium">Search bar con búsqueda + perfil</p>
                <!-- Search: With search icon and avatar -->
                <div class="rdm-search--wrapper">
                    <div class="rdm-search--container">
                        <div class="rdm-search--bar">
                            <div class="rdm-search--control">
                                <button class="rdm-search--leading-icon" type="button" aria-label="Buscar">
                                    <span class="material-symbols-rounded">search</span>
                                </button>
                                <input type="search" id="search_combined" name="search_combined" placeholder="Buscar...">
                                <div class="rdm-search--trailing">
                                    <button class="rdm-search--trailing-icon show" type="button" aria-label="Buscar">
                                        <span class="material-symbols-rounded">search</span>
                                    </button>
                                    <img class="rdm-search--avatar" src="img/a1.jpg" alt="Avatar usuario">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-search--support">
                        <span>Búsqueda con búton y perfil</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Enabled (empty)</h2>
                <p class="rdm-sys-typography--body-medium">Barra de búsqueda vacía</p>
                <!-- Search: Empty -->
                <div class="rdm-search--wrapper">
                    <div class="rdm-search--container">
                        <div class="rdm-search--bar">
                            <div class="rdm-search--control">
                                <button class="rdm-search--leading-icon" type="button" aria-label="Buscar">
                                    <span class="material-symbols-rounded">search</span>
                                </button>
                                <input type="search" id="search1" name="search1" placeholder="Buscar...">
                                <div class="rdm-search--trailing">
                                    <button class="rdm-search--trailing-icon" type="button" aria-label="Limpiar búsqueda">
                                        <span class="material-symbols-rounded">close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-search--support">
                        <span>Escribe para buscar</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Enabled (populated)</h2>
                <p class="rdm-sys-typography--body-medium">Con texto, el icono clear se muestra</p>
                <!-- Search: With content -->
                <div class="rdm-search--wrapper">
                    <div class="rdm-search--container">
                        <div class="rdm-search--bar">
                            <div class="rdm-search--control">
                                <button class="rdm-search--leading-icon" type="button" aria-label="Buscar">
                                    <span class="material-symbols-rounded">search</span>
                                </button>
                                <input type="search" id="search2" name="search2" placeholder="Buscar..." value="Material Design">
                                <div class="rdm-search--trailing">
                                    <button class="rdm-search--trailing-icon show" type="button" aria-label="Limpiar búsqueda">
                                        <span class="material-symbols-rounded">close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-search--support">
                        <span>Resultados para "Material Design"</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Focused & Hovered</h2>
                <p class="rdm-sys-typography--body-medium">Haz click para ver elevación aumentada. Pasa el cursor para ver hover.</p>
                <!-- Search: Focus and hover -->
                <div class="rdm-search--wrapper">
                    <div class="rdm-search--container">
                        <div class="rdm-search--bar">
                            <div class="rdm-search--control">
                                <button class="rdm-search--leading-icon" type="button" aria-label="Buscar">
                                    <span class="material-symbols-rounded">search</span>
                                </button>
                                <input type="search" id="search3" name="search3" placeholder="Buscar productos...">
                                <div class="rdm-search--trailing">
                                    <button class="rdm-search--trailing-icon" type="button" aria-label="Limpiar búsqueda">
                                        <span class="material-symbols-rounded">close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Disabled (empty)</h2>
                <!-- Search: Disabled empty -->
                <div class="rdm-search--wrapper">
                    <div class="rdm-search--container">
                        <div class="rdm-search--bar">
                            <div class="rdm-search--control">
                                <button class="rdm-search--leading-icon" type="button" aria-label="Buscar" disabled>
                                    <span class="material-symbols-rounded">search</span>
                                </button>
                                <input type="search" id="search4" name="search4" placeholder="Búsqueda deshabilitada" disabled>
                                <div class="rdm-search--trailing">
                                    <button class="rdm-search--trailing-icon" type="button" aria-label="Limpiar búsqueda" disabled>
                                        <span class="material-symbols-rounded">close</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rdm-search--support">
                        <span>Campo deshabilitado</span>
                    </div>
                </div>

                <h2 class="rdm-sys-typography--title-large">Disabled (populated)</h2>
                <!-- Search: Disabled with content -->
                <div class="rdm-search--wrapper">
                    <div class="rdm-search--container">
                        <div class="rdm-search--bar">
                            <div class="rdm-search--control">
                                <button class="rdm-search--leading-icon" type="button" aria-label="Buscar" disabled>
                                    <span class="material-symbols-rounded">search</span>
                                </button>
                                <input type="search" id="search5" name="search5" placeholder="Buscar..." value="iPhone" disabled>
                                <div class="rdm-search--trailing-icon show">
                                    <span class="material-symbols-rounded">close</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Action section -->
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
                        <div class="rdm-button--icon"><span class="material-symbols-rounded">search</span></div>
                    </div>
                    <div class="rdm-button--body">
                        <span class="rdm-sys-typography--label-large">Buscar</span>
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
