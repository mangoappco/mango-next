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
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Tabs</div></div>
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

<h1 class="rdm-sys-typography--display-medium">Tabs</h1>

<!-- tabs -->
<section class="rdm-tabs--container">
    <div class="rdm-tabs--body">

        <!-- Destination -->
        <div class="rdm-tabs--destination">

            <!-- Body -->
            <div class="rdm-tabs--destination-body">
                <span class="rdm-tabs--destination-body-label-text"><span class="rdm-sys-typography--title-small">Label</span></span>
            </div>
        </div>

        <!-- Destination -->
        <div class="rdm-tabs--destination">

            <!-- Media -->
            <div class="rdm-tabs--destination-media">
                    <div class="rdm-badge--container">
                        <div class="rdm-tabs--destination-media-icon"><span class="material-symbols-rounded">shopping_bag</span></div>
                    </div>          
            </div>

            <!-- Body -->
            <div class="rdm-tabs--destination-body">
                <span class="rdm-tabs--destination-body-label-text"><span class="rdm-sys-typography--title-small">Label</span></span>
            </div>
        </div>

    </div>

</section>

</main>

</body>
</html>