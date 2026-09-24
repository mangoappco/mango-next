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
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Radio Button</div></div>
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

	<h1 class="rdm-sys-typography--display-medium">Radio Button</h1>

	<!-- Form container -->
	<form class="rdm-form--container" action="#" method="post" target="_self">

		<!-- Form type: outlined -->
		<div class="rdm-form--outlined">

			<!-- Body section -->
			<div class="rdm-form--body">
				
				<!-- RADIO: Enabled States -->
				<h2 class="rdm-sys-typography--title-large">Enabled (unselected)</h2>
				<p class="rdm-sys-typography--body-medium">Haz click para ver el estado hover, focus y pressed</p>
			<div class="rdm-radio--wrapper">
				<label class="rdm-radio--container">
					<input type="radio" class="rdm-radio--input" name="radio1" value="1">
					<span class="rdm-radio--icon"></span>
					<span class="rdm-radio--label">Opción sin seleccionar</span>
				</label>
			</div>

			<h2 class="rdm-sys-typography--title-large">Enabled (selected)</h2>
			<div class="rdm-radio--wrapper">
				<label class="rdm-radio--container">
					<input type="radio" class="rdm-radio--input" name="radio2" value="1" checked>
					<span class="rdm-radio--icon"></span>
					<span class="rdm-radio--label">Opción seleccionada</span>
				</label>
			</div>

			<h2 class="rdm-sys-typography--title-large">Disabled (unselected)</h2>
			<div class="rdm-radio--wrapper">
				<label class="rdm-radio--container">
					<input type="radio" class="rdm-radio--input" name="radio3" value="1" disabled>
					<span class="rdm-radio--icon"></span>
					<span class="rdm-radio--label">Opción deshabilitada sin seleccionar</span>
				</label>
			</div>

			<h2 class="rdm-sys-typography--title-large">Disabled (selected)</h2>
			<div class="rdm-radio--wrapper">
				<label class="rdm-radio--container">
					<input type="radio" class="rdm-radio--input" name="radio4" value="1" checked disabled>
					<span class="rdm-radio--icon"></span>
					<span class="rdm-radio--label">Opción deshabilitada seleccionada</span>
				</label>
			</div>

			<!-- RADIO: Error State -->
			<h2 class="rdm-sys-typography--title-large">Error state</h2>
			<div class="rdm-radio--wrapper has-error">
				<label class="rdm-radio--container">
					<input type="radio" class="rdm-radio--input" name="radio_error1" value="1">
					<span class="rdm-radio--icon"></span>
					<span class="rdm-radio--label">Debes aceptar los términos y condiciones</span>
				</label>
				<span class="rdm-radio--support">Este campo es obligatorio</span>
			</div>
			<div class="rdm-radio--wrapper has-error">
				<label class="rdm-radio--container">
					<input type="radio" class="rdm-radio--input" name="radio_error2" value="1" checked>
					<span class="rdm-radio--icon"></span>
					<span class="rdm-radio--label">Error seleccionado</span>
				</label>
				<span class="rdm-radio--support">Revisa esta selección</span>
			</div>

			<!-- RADIO: Option Group -->
			<fieldset class="rdm-radio--fieldset">
				<legend class="rdm-sys-typography--title-large">Grupo de opciones</legend>
				<div class="rdm-radio--wrapper">
					<label class="rdm-radio--container">
						<input type="radio" class="rdm-radio--input" name="language" value="javascript">
						<span class="rdm-radio--icon"></span>
						<span class="rdm-radio--label">JavaScript</span>
					</label>
				</div>
				<div class="rdm-radio--wrapper">
					<label class="rdm-radio--container">
						<input type="radio" class="rdm-radio--input" name="language" value="python">
						<span class="rdm-radio--icon"></span>
						<span class="rdm-radio--label">Python</span>
					</label>
				</div>
				<div class="rdm-radio--wrapper">
					<label class="rdm-radio--container">
						<input type="radio" class="rdm-radio--input" name="language" value="php">
						<span class="rdm-radio--icon"></span>
						<span class="rdm-radio--label">PHP</span>
					</label>
				</div>
			</fieldset>

			<!-- Action section alignment: left, center, right -->
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
