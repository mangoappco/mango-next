<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>RDM 2.0 - ManGo!</title>
	<link rel="stylesheet" href="css/estilos.css">
	<script src="js/topbar_scroll.js"></script>
	<script src="js/theme_toggle.js"></script>
	<script src="js/dialog.js"></script>
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
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Dialogs</div></div>
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

	<h1 class="rdm-sys-typography--display-medium">Dialogs</h1>
	<p class="rdm-sys-typography--body-large">
		Los diálogos informan a los usuarios sobre una tarea específica y pueden contener información crítica, requerir decisiones o involucrar múltiples tareas. Siguen la especificación de Material Design 3.
	</p>

	<!-- Config 1: Basic Dialog -->
	<!-- Card container -->
	<article class="rdm-card--container">

		<!-- Card type: filled, elevated, outlined -->
		<div class="rdm-card--outlined">

			<!-- Body section -->
			<div class="rdm-card--body">
				<h2 class="rdm-sys-typography--title-large">1. Basic Alert Dialog</h2>
				<p class="rdm-sys-typography--body-large">
					Diálogo básico para confirmación simple o mensajes importantes sin icono de cabecera.
				</p>
			</div>

			<!-- Action section aligment: left, center, right -->
			<div class="rdm-card--action-left">
				<p>
					<!-- button -->
					<button type="button" class="rdm-button--filled" data-dialog-target="#dialog-basic">
						<div class="rdm-button--container">
							<div class="rdm-button--body">
								<span class="rdm-sys-typography--label-large">Abrir Basic Dialog</span>
							</div>
						</div>
					</button>
				</p>
			</div>

		</div>
	</article>

	<!-- Config 2: Dialog con Icono (Hero Icon) -->
	<!-- Card container -->
	<article class="rdm-card--container">

		<!-- Card type: filled, elevated, outlined -->
		<div class="rdm-card--outlined">

			<!-- Body section -->
			<div class="rdm-card--body">
				<h2 class="rdm-sys-typography--title-large">2. Dialog con Icono (Hero Icon)</h2>
				<p class="rdm-sys-typography--body-large">
					Diálogo con icono superior centrado para alertas o acciones destructivas/críticas.
				</p>
			</div>

			<!-- Action section aligment: left, center, right -->
			<div class="rdm-card--action-left">
				<p>
					<!-- button -->
					<button type="button" class="rdm-button--filled" data-dialog-target="#dialog-icon">
						<div class="rdm-button--container">
							<div class="rdm-button--media">
								<div class="rdm-button--icon"><span class="material-symbols-rounded">delete</span></div>
							</div>
							<div class="rdm-button--body">
								<span class="rdm-sys-typography--label-large">Abrir Dialog con Icono</span>
							</div>
						</div>
					</button>
				</p>
			</div>

		</div>
	</article>

	<!-- Config 3: Confirmation Dialog con Selección -->
	<!-- Card container -->
	<article class="rdm-card--container">

		<!-- Card type: filled, elevated, outlined -->
		<div class="rdm-card--outlined">

			<!-- Body section -->
			<div class="rdm-card--body">
				<h2 class="rdm-sys-typography--title-large">3. Confirmation Dialog con Opciones</h2>
				<p class="rdm-sys-typography--body-large">
					Diálogo para seleccionar una opción entre múltiples alternativas con lista desplazable.
				</p>
			</div>

			<!-- Action section aligment: left, center, right -->
			<div class="rdm-card--action-left">
				<p>
					<!-- button -->
					<button type="button" class="rdm-button--filled" data-dialog-target="#dialog-selection">
						<div class="rdm-button--container">
							<div class="rdm-button--media">
								<div class="rdm-button--icon"><span class="material-symbols-rounded">tune</span></div>
							</div>
							<div class="rdm-button--body">
								<span class="rdm-sys-typography--label-large">Abrir Diálogo de Selección</span>
							</div>
						</div>
					</button>
				</p>
			</div>

		</div>
	</article>

	<!-- Config 4: Full-screen Dialog -->
	<!-- Card container -->
	<article class="rdm-card--container">

		<!-- Card type: filled, elevated, outlined -->
		<div class="rdm-card--outlined">

			<!-- Body section -->
			<div class="rdm-card--body">
				<h2 class="rdm-sys-typography--title-large">4. Full-screen Dialog</h2>
				<p class="rdm-sys-typography--body-large">
					Diálogo que ocupa toda la pantalla para flujos complejos, edición o formularios extensos.
				</p>
			</div>

			<!-- Action section aligment: left, center, right -->
			<div class="rdm-card--action-left">
				<p>
					<!-- button -->
					<button type="button" class="rdm-button--outlined" data-dialog-target="#dialog-fullscreen">
						<div class="rdm-button--container">
							<div class="rdm-button--media">
								<div class="rdm-button--icon"><span class="material-symbols-rounded">fullscreen</span></div>
							</div>
							<div class="rdm-button--body">
								<span class="rdm-sys-typography--label-large">Abrir Full-screen Dialog</span>
							</div>
						</div>
					</button>
				</p>
			</div>

		</div>
	</article>

</main>


<!-- ========================================== -->
<!-- COMPONENTES DIALOG (MODALES)              -->
<!-- ========================================== -->

<!-- 1. Basic Alert Dialog -->
<dialog class="rdm-dialog" id="dialog-basic" aria-labelledby="dialog-basic-title">
	<div class="rdm-dialog--container">
		<div class="rdm-dialog--headline">
			<h2 class="rdm-sys-typography--headline-small" id="dialog-basic-title">¿Restablecer configuración?</h2>
		</div>
		<div class="rdm-dialog--content">
			<p class="rdm-sys-typography--body-medium">
				Esta acción devolverá todos los ajustes del punto de venta a sus valores predeterminados. Los datos de tus ventas no se perderán.
			</p>
		</div>
		<div class="rdm-dialog--actions">
			<button type="button" class="rdm-button--text" data-dialog-close>
				<div class="rdm-button--container">
					<div class="rdm-button--body">
						<span class="rdm-sys-typography--label-large">Cancelar</span>
					</div>
				</div>
			</button>
			<button type="button" class="rdm-button--text" data-dialog-close>
				<div class="rdm-button--container">
					<div class="rdm-button--body">
						<span class="rdm-sys-typography--label-large">Aceptar</span>
					</div>
				</div>
			</button>
		</div>
	</div>
</dialog>

<!-- 2. Dialog con Icono (Advertencia/Destructivo) -->
<dialog class="rdm-dialog" id="dialog-icon" aria-labelledby="dialog-icon-title">
	<div class="rdm-dialog--container">
		<div class="rdm-dialog--icon is-error">
			<span class="material-symbols-rounded">delete</span>
		</div>
		<div class="rdm-dialog--headline is-centered">
			<h2 class="rdm-sys-typography--headline-small" id="dialog-icon-title">¿Eliminar producto?</h2>
		</div>
		<div class="rdm-dialog--content is-centered">
			<p class="rdm-sys-typography--body-medium">
				¿Estás seguro de que deseas eliminar permanentemente este producto del catálogo? Esta acción no se puede deshacer.
			</p>
		</div>
		<div class="rdm-dialog--actions">
			<button type="button" class="rdm-button--text" data-dialog-close>
				<div class="rdm-button--container">
					<div class="rdm-button--body">
						<span class="rdm-sys-typography--label-large">Cancelar</span>
					</div>
				</div>
			</button>
			<button type="button" class="rdm-button--filled" data-dialog-close>
				<div class="rdm-button--container">
					<div class="rdm-button--body">
						<span class="rdm-sys-typography--label-large">Eliminar</span>
					</div>
				</div>
			</button>
		</div>
	</div>
</dialog>

<!-- 3. Confirmation Dialog con Opciones -->
<dialog class="rdm-dialog" id="dialog-selection" aria-labelledby="dialog-selection-title">
	<div class="rdm-dialog--container">
		<div class="rdm-dialog--headline">
			<h2 class="rdm-sys-typography--headline-small" id="dialog-selection-title">Método de pago predeterminado</h2>
		</div>
		<div class="rdm-dialog--content rdm-dialog--content-scrollable">
			<div class="rdm-radio--wrapper">
				<label class="rdm-radio--container">
					<input type="radio" class="rdm-radio--input" name="payment_method" value="cash" checked>
					<span class="rdm-radio--icon"></span>
					<span class="rdm-radio--label">Efectivo en caja</span>
				</label>
			</div>
			<div class="rdm-radio--wrapper">
				<label class="rdm-radio--container">
					<input type="radio" class="rdm-radio--input" name="payment_method" value="card">
					<span class="rdm-radio--icon"></span>
					<span class="rdm-radio--label">Tarjeta de crédito / débito</span>
				</label>
			</div>
			<div class="rdm-radio--wrapper">
				<label class="rdm-radio--container">
					<input type="radio" class="rdm-radio--input" name="payment_method" value="transfer">
					<span class="rdm-radio--icon"></span>
					<span class="rdm-radio--label">Transferencia electrónica</span>
				</label>
			</div>
			<div class="rdm-radio--wrapper">
				<label class="rdm-radio--container">
					<input type="radio" class="rdm-radio--input" name="payment_method" value="credit">
					<span class="rdm-radio--icon"></span>
					<span class="rdm-radio--label">Crédito a cliente</span>
				</label>
			</div>
		</div>
		<div class="rdm-dialog--actions">
			<button type="button" class="rdm-button--text" data-dialog-close>
				<div class="rdm-button--container">
					<div class="rdm-button--body">
						<span class="rdm-sys-typography--label-large">Cancelar</span>
					</div>
				</div>
			</button>
			<button type="button" class="rdm-button--text" data-dialog-close>
				<div class="rdm-button--container">
					<div class="rdm-button--body">
						<span class="rdm-sys-typography--label-large">Guardar</span>
					</div>
				</div>
			</button>
		</div>
	</div>
</dialog>

<!-- 4. Full-screen Dialog -->
<dialog class="rdm-dialog rdm-dialog--fullscreen" id="dialog-fullscreen" aria-labelledby="dialog-fullscreen-title">
	<div class="rdm-dialog--container">
		<div class="rdm-dialog--fullscreen-header">
			<button type="button" class="rdm-button--text" data-dialog-close aria-label="Cerrar">
				<div class="rdm-button--container">
					<div class="rdm-button--body">
						<span class="material-symbols-rounded">close</span>
					</div>
				</div>
			</button>
			<div class="rdm-dialog--fullscreen-header-title">
				<h2 class="rdm-sys-typography--title-large" id="dialog-fullscreen-title">Nuevo Producto</h2>
			</div>
			<button type="button" class="rdm-button--filled" data-dialog-close>
				<div class="rdm-button--container">
					<div class="rdm-button--body">
						<span class="rdm-sys-typography--label-large">Guardar</span>
					</div>
				</div>
			</button>
		</div>
		<div class="rdm-dialog--fullscreen-body">
			<p class="rdm-sys-typography--body-large">
				Completa los datos para registrar un nuevo producto o servicio en tu inventario de ManGo!.
			</p>
			<br>
			<div class="rdm-card--container">
				<div class="rdm-card--filled">
					<div class="rdm-card--body">
						<h3 class="rdm-sys-typography--title-medium">Información General</h3>
						<p class="rdm-sys-typography--body-medium">
							Este diálogo de pantalla completa es ideal para flujos que requieren múltiples pasos o formularios extensos en dispositivos móviles y de escritorio.
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</dialog>

</body>
</html>
