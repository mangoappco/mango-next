<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>RDM 2.0 - ManGo!</title>
	<link rel="stylesheet" href="css/estilos.css">
	<script src="js/topbar_scroll.js"></script>
	<script src="js/theme_toggle.js"></script>
	<script src="js/snackbar.js"></script>
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
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Snackbars</div></div>
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

	<h1 class="rdm-sys-typography--display-medium">Snackbars</h1>
	<p class="rdm-sys-typography--body-large">
		Los snackbars proporcionan mensajes breves sobre los procesos de la aplicación en la parte inferior de la pantalla. Informan a los usuarios sobre una operación realizada y pueden incluir una acción rápida.
	</p>

	<!-- Config 1: Neutral Snackbar -->
	<!-- Card container -->
	<article class="rdm-card--container">

		<!-- Card type: filled, elevated, outlined -->
		<div class="rdm-card--outlined">

			<!-- Body section -->
			<div class="rdm-card--body">
				<h2 class="rdm-sys-typography--title-large">1. Mensaje Neutral / Informativo</h2>
				<p class="rdm-sys-typography--body-large">
					Notificación estándar sobre operaciones cotidianas sin carga de error ni éxito crítico.
				</p>
			</div>

			<!-- Action section aligment: left, center, right -->
			<div class="rdm-card--action-left">
				<p>
					<!-- button -->
					<button type="button" class="rdm-button--filled" data-snackbar-message="Copia de seguridad en curso..." data-snackbar-type="neutral">
						<div class="rdm-button--container">
							<div class="rdm-button--media">
								<div class="rdm-button--icon"><span class="material-symbols-rounded">info</span></div>
							</div>
							<div class="rdm-button--body">
								<span class="rdm-sys-typography--label-large">Mostrar Snackbar Neutral</span>
							</div>
						</div>
					</button>
				</p>
			</div>

		</div>
	</article>

	<!-- Config 2: Success Snackbar -->
	<!-- Card container -->
	<article class="rdm-card--container">

		<!-- Card type: filled, elevated, outlined -->
		<div class="rdm-card--outlined">

			<!-- Body section -->
			<div class="rdm-card--body">
				<h2 class="rdm-sys-typography--title-large">2. Mensaje de Éxito (Success)</h2>
				<p class="rdm-sys-typography--body-large">
					Confirma que una acción se completó satisfactoriamente (guardar, actualizar, sincronizar).
				</p>
			</div>

			<!-- Action section aligment: left, center, right -->
			<div class="rdm-card--action-left">
				<p>
					<!-- button -->
					<button type="button" class="rdm-button--filled" data-snackbar-message="Producto guardado correctamente en el inventario" data-snackbar-type="success">
						<div class="rdm-button--container">
							<div class="rdm-button--media">
								<div class="rdm-button--icon"><span class="material-symbols-rounded">check_circle</span></div>
							</div>
							<div class="rdm-button--body">
								<span class="rdm-sys-typography--label-large">Mostrar Éxito</span>
							</div>
						</div>
					</button>
				</p>
			</div>

		</div>
	</article>

	<!-- Config 3: Error Snackbar -->
	<!-- Card container -->
	<article class="rdm-card--container">

		<!-- Card type: filled, elevated, outlined -->
		<div class="rdm-card--outlined">

			<!-- Body section -->
			<div class="rdm-card--body">
				<h2 class="rdm-sys-typography--title-large">3. Mensaje de Error (Error)</h2>
				<p class="rdm-sys-typography--body-large">
					Alerta sobre fallas de conexión, operaciones no autorizadas o validaciones incorrectas.
				</p>
			</div>

			<!-- Action section aligment: left, center, right -->
			<div class="rdm-card--action-left">
				<p>
					<!-- button -->
					<button type="button" class="rdm-button--filled" data-snackbar-message="Error de conexión: no fue posible sincronizar las ventas" data-snackbar-type="error">
						<div class="rdm-button--container">
							<div class="rdm-button--media">
								<div class="rdm-button--icon"><span class="material-symbols-rounded">error</span></div>
							</div>
							<div class="rdm-button--body">
								<span class="rdm-sys-typography--label-large">Mostrar Error</span>
							</div>
						</div>
					</button>
				</p>
			</div>

		</div>
	</article>

	<!-- Config 4: Warning Snackbar -->
	<!-- Card container -->
	<article class="rdm-card--container">

		<!-- Card type: filled, elevated, outlined -->
		<div class="rdm-card--outlined">

			<!-- Body section -->
			<div class="rdm-card--body">
				<h2 class="rdm-sys-typography--title-large">4. Mensaje de Advertencia (Warning)</h2>
				<p class="rdm-sys-typography--body-large">
					Informa sobre situaciones que requieren atención previa (stock bajo, batería o espacio).
				</p>
			</div>

			<!-- Action section aligment: left, center, right -->
			<div class="rdm-card--action-left">
				<p>
					<!-- button -->
					<button type="button" class="rdm-button--filled" data-snackbar-message="Advertencia: solo quedan 2 unidades disponibles en caja" data-snackbar-type="warning">
						<div class="rdm-button--container">
							<div class="rdm-button--media">
								<div class="rdm-button--icon"><span class="material-symbols-rounded">warning</span></div>
							</div>
							<div class="rdm-button--body">
								<span class="rdm-sys-typography--label-large">Mostrar Advertencia</span>
							</div>
						</div>
					</button>
				</p>
			</div>

		</div>
	</article>

	<!-- Config 5: Action Snackbar -->
	<!-- Card container -->
	<article class="rdm-card--container">

		<!-- Card type: filled, elevated, outlined -->
		<div class="rdm-card--outlined">

			<!-- Body section -->
			<div class="rdm-card--body">
				<h2 class="rdm-sys-typography--title-large">5. Con Botón de Acción (Undo / Deshacer)</h2>
				<p class="rdm-sys-typography--body-large">
					Permite a los usuarios revertir o reintentar una acción directamente desde la notificación.
				</p>
			</div>

			<!-- Action section aligment: left, center, right -->
			<div class="rdm-card--action-left">
				<p>
					<!-- button -->
					<button type="button" class="rdm-button--filled" data-snackbar-message="Elemento eliminado permanentemente" data-snackbar-type="neutral" data-snackbar-action="Deshacer" data-snackbar-duration="6000">
						<div class="rdm-button--container">
							<div class="rdm-button--media">
								<div class="rdm-button--icon"><span class="material-symbols-rounded">undo</span></div>
							</div>
							<div class="rdm-button--body">
								<span class="rdm-sys-typography--label-large">Mostrar con Acción Deshacer</span>
							</div>
						</div>
					</button>
				</p>
			</div>

		</div>
	</article>

</main>

</body>
</html>
