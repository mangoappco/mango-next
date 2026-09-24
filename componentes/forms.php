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
			<div class="rdm-sys-typography--title-large"><div class="rdm-topbar--body-headline">Forms</div></div>
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


    <h1 class="rdm-sys-typography--display-medium">Filled form</h1>

    <!-- Form container -->
    <form class="rdm-form--container" action="#" method="post" target="_self">

        <!-- Form type: filled, elevated, outlined -->
        <div class="rdm-form--filled">

            <!-- Body section -->
            <div class="rdm-form--body">
                <h2 class="rdm-sys-typography--display-small">Headline</h2>
                <h3 class="rdm-sys-typography--title-large">Subhead</h3>
                <p class="rdm-sys-typography--body-large">Body large. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum voluptates ullam sunt explicabo et veniam consequuntur eius dolore. Quisquam fuga ipsam optio quibusdam expedita sunt tempora odit totam ab aperiam.</p>
            </div>

            <!-- Action section aligment: left, center, right -->
            <div class="rdm-form--action-left">
            <p>
                <!-- button con tanaño correcto -->
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
			
            </p> 
            </div>

        </div>
    </form>

    <!-- Elevated form -->

    <h1 class="rdm-sys-typography--display-medium">Elevated form</h1>

    <!-- Form container -->
    <form class="rdm-form--container" action="#" method="post" target="_self">

        <!-- Form type: elevated -->
        <div class="rdm-form--elevated">

            <!-- Media section -->
            <div class="rdm-form--media" style="background-image: url(img/1.jpg);">
                <h1 class="rdm-sys-typography--display-medium">Display</h1>
            </div>

            <!-- Body section -->
            <div class="rdm-form--body">
                <h2 class="rdm-sys-typography--display-small">Headline</h2>
                <h3 class="rdm-sys-typography--title-large">Subhead</h3>
                <p class="rdm-sys-typography--body-large">Body large. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum voluptates ullam sunt explicabo et veniam consequuntur eius dolore. Quisquam fuga ipsam optio quibusdam expedita sunt tempora odit totam ab aperiam.</p>
            </div>

            <!-- Action section aligment: left, center, right -->
            <div class="rdm-form--action-right">
            <p>
                <!-- button con tanaño correcto -->
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
			
            </p> 
            </div>
            
        </div>
    </form>

    <!-- Outlined form -->

    <h1 class="rdm-sys-typography--display-medium">Outlined form</h1>

    <!-- Form container -->
    <form class="rdm-form--container" action="#" method="post" target="_self">

        <!-- Form type: outlined -->
        <div class="rdm-form--outlined">

            <!-- Media section -->
            <div class="rdm-form--media" style="background-image: url(img/1.jpg);">
                <h1 class="rdm-sys-typography--display-medium">Display</h1>
            </div>

            <!-- Body section -->
            <div class="rdm-form--body">
                <h2 class="rdm-sys-typography--display-small">Headline</h2>
                <h3 class="rdm-sys-typography--title-large">Subhead</h3>
                <p class="rdm-sys-typography--body-large">Body large. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum voluptates ullam sunt explicabo et veniam consequuntur eius dolore. Quisquam fuga ipsam optio quibusdam expedita sunt tempora odit totam ab aperiam.</p>
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

    <!-- Flat form (sin borde ni sombra) -->

    <h1 class="rdm-sys-typography--display-medium">Flat form</h1>

    <!-- Form container -->
    <form class="rdm-form--container" action="#" method="post" target="_self">

        <!-- Form type: flat -->
        <div class="rdm-form--flat">

            <!-- Media section -->
            <div class="rdm-form--media" style="background-image: url(img/1.jpg);">
                <h1 class="rdm-sys-typography--display-medium">Display</h1>
            </div>

            <!-- Body section -->
            <div class="rdm-form--body">
                <h2 class="rdm-sys-typography--display-small">Headline</h2>
                <h3 class="rdm-sys-typography--title-large">Subhead</h3>
                <p class="rdm-sys-typography--body-large">Body large. Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum voluptates ullam sunt explicabo et veniam consequuntur eius dolore. Quisquam fuga ipsam optio quibusdam expedita sunt tempora odit totam ab aperiam.</p>
            </div>

            <!-- Action section aligment: left, center, right -->
            <div class="rdm-form--action-left">
            <p>
                <!-- button con tanaño correcto -->
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
			
            </p> 
            </div>
			
        </div>
    </form>
    
</main>

</body>
</html>

