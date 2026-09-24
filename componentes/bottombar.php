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
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Bottom app bar</div></div>
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

<h1 class="rdm-sys-typography--display-medium">Bottom bar app</h1>

<div style="height: 100vh;"></div>

</main>








<!-- bottom bar -->
<footer class="rdm-bottombar--position">	

	<!-- bottom bar container -->
	<div class="rdm-bottombar--small-container">

		<!-- bottom bar media -->
		<div class="rdm-bottombar--media">
            <a href="#"><div class="rdm-bottombar--leading-navigation-icon"><span class="material-symbols-rounded">search</span></div></a>
			<a href="#"><div class="rdm-bottombar--leading-navigation-icon"><span class="material-symbols-rounded">delete</span></div></a>
			<a href="#"><div class="rdm-bottombar--leading-navigation-icon"><span class="material-symbols-rounded">archive</span></div></a>
			<a href="#"><div class="rdm-bottombar--leading-navigation-icon"><span class="material-symbols-rounded">forward</span></div></a>
		</div>		
		

		<!-- bottom bar action-->
		<div class="rdm-bottombar--action">			
		
			<div class="rdm-button--fab-position">

				<!-- button -->

				<button class="rdm-button--fab">
					<div class="rdm-button--container">
						<div class="rdm-button--fab-media">
							<div class="rdm-button--icon"><span class="material-symbols-rounded">edit</span></div>
						</div>
					</div>
				</button>

			</div> 
		</div>

	</div>
	
</footer>



</body>
</html>