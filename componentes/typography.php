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
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Typography</div></div>
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

	<!-- Display -->
	<h1 class="rdm-sys-typography--display-large">Display large</h1>
	<h1 class="rdm-sys-typography--display-medium">Display medium</h1>
	<h1 class="rdm-sys-typography--display-small">Display small</h1>

	<!-- Headline -->
	<h2 class="rdm-sys-typography--headline-large">Headline large</h2>
	<h2 class="rdm-sys-typography--headline-medium">Headline medium</h2>
	<h2 class="rdm-sys-typography--headline-small">Headline small</h2>

	<!-- Title -->
	<h3 class="rdm-sys-typography--title-large">Title large</h3>
	<h3 class="rdm-sys-typography--title-medium">Title medium</h3>
	<h3 class="rdm-sys-typography--title-small">Title small</h3>

	<!-- Body -->
	<p class="rdm-sys-typography--body-large">Body large</p>
	<p class="rdm-sys-typography--body-medium">Body medium</p>
	<p class="rdm-sys-typography--body-small">Body small</p>

	<!-- Label -->
	<span class="rdm-sys-typography--label-large">Label large</span>
	<span class="rdm-sys-typography--label-medium">Label medium</span>
	<span class="rdm-sys-typography--label-small">Label small</span>

</main>

</body>
</html>